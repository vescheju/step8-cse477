<?php


namespace Felis;


class Users extends Table {

    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "user");
    }

    /**
     * Test for a valid login.
     * @param $email User email
     * @param $password Password credential
     * @return User object if successful, null otherwise.
     */
    public function login($email, $password) {
        $sql =<<<SQL
SELECT * from $this->tableName
where email=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute([$email]);
        if($statement->rowCount() === 0) {
            return null;
        }

        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        // Get the encrypted password and salt from the record
        $hash = $row['password'];
        $salt = $row['salt'];

        // Ensure it is correct
        if($hash !== hash("sha256", $password . $salt)) {
            return null;
        }

        return new User($row);


    }

    /**
     * Get a user based on the id
     * @param $id ID of the user
     * @return User object if successful, null otherwise.
     */
    public function get($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
where id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));


    }

    /**
     * Modify a user record based on the contents of a User object
     * @param User $user User object for object with modified data
     * @return true if successful, false if failed or user does not exist
     */
    public function update(User $user)
    {
        $id = $user->getId();
        $email = $user->getEmail();
        $name = $user->getName();
        $phone = $user->getPhone();
        $address = $user->getAddress();
        $notes = $user->getNotes();
        $role = $user->getRole();
        $ret = true;

        $sql =<<<SQL
UPDATE $this->tableName
set email=?, name=?, phone=?, address=?, notes=?, role=?
where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            $ret = $statement->execute(array($email,$name,$phone,$address,$notes,$role,$id));
        } catch(\PDOException $e) {
            return false;
        }

        if($statement->rowCount() === 0) {
            return false;
        }

        return $ret;

    }


    public function getClients(){
        $role = "C";
        $sql =<<<SQL
        SELECT name, id
        from $this->tableName
        where role=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($role));
        return $statement->fetchAll(\PDO::FETCH_ASSOC);


    }

    public function getAgents(){
        $role1 = "S";
        $role2 = "A";
        $sql =<<<SQL
        SELECT name, id
        from $this->tableName
        where role=? or role=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($role1,$role2));
        return $statement->fetchAll(\PDO::FETCH_ASSOC);


    }

    /**
     * Determine if a user exists in the system.
     * @param $email An email address.
     * @return true if $email is an existing email address
     */
    public function exists($email) {

        $sql =<<<SQL
SELECT * from $this->tableName
where email=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute([$email]);
        if($statement->rowCount() === 0) {
            return false;
        }

        return true;

    }

    /**
     * Create a new user.
     * @param User $user The new user data
     * @param Email $mailer An Email object to use
     * @return null on success or error message if failure
     */
    public function add(User $user, Email $mailer) {
        // Ensure we have no duplicate email address
        if($this->exists($user->getEmail())) {
            return "Email address already exists.";
        }

        // Add a record to the user table
        $sql = <<<SQL
INSERT INTO $this->tableName(email, name, phone, address, notes, joined, role)
values(?, ?, ?, ?, ?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute([
            $user->getEmail(), $user->getName(), $user->getPhone(), $user->getAddress(),
            $user->getNotes(), date("Y-m-d H:i:s"), $user->getRole()
        ]);
        $id = $this->pdo()->lastInsertId();

        // Create a validator and add to the validator table
        $validators = new Validators($this->site);
        $validator = $validators->newValidator($id);

        // Send email with the validator in it
        $link = "http://webdev.cse.msu.edu"  . $this->site->getRoot() .
            '/password-validate.php?v=' . $validator;

        $from = $this->site->getEmail();
        $name = $user->getName();

        $subject = "Confirm your email";
        $message = <<<MSG
<html>
<p>Greetings, $name,</p>

<p>Welcome to Felis. In order to complete your registration,
please verify your email address by visiting the following link:</p>

<p><a href="$link">$link</a></p>
</html>
MSG;
        $headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso=8859-1\r\nFrom: $from\r\n";
        $mailer->mail($user->getEmail(), $subject, $message, $headers);
    }


    /**
     * Generate a random salt string of characters for password salting
     * @param $len Length to generate, default is 16
     * @return Salt string
     */
    public static function randomSalt($len = 16) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }



    /**
     * Set the password for a user
     * @param $userid The ID for the user
     * @param $password New password to set
     */
    public function setPassword($userid, $password) {
        $salt = self::randomSalt();
        $hash = hash("sha256", $password . $salt);
        $sql =<<<SQL
UPDATE $this->tableName
set password=?, salt=?
where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            $ret = $statement->execute(array($hash,$salt,$userid));
        } catch(\PDOException $e) {
            return;
        }


    }


    public function getUsers(){
        $sql =<<<SQL
        SELECT name, id, email, role
        from $this->tableName
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);


    }


}