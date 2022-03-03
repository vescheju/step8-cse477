<?php


namespace Felis;


class Cases extends Table {
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "case");
    }

    /**
     * Get a case by id
     * @param $id The case by ID
     * @return Object that represents the case if successful,
     *  null otherwise.
     */
    public function get($id) {
        $users = new Users($this->site);

        $usersTable = $users->getTableName();

        $sql = <<<SQL
SELECT c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
from $this->tableName c,
     $usersTable client,
     $usersTable agent
where c.client = client.id and
      c.agent=agent.id and
      c.id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }
        return new ClientCase($statement->fetch(\PDO::FETCH_ASSOC));

    }

    public function insert($client, $agent, $number) {
        $sql = <<<SQL
insert into $this->tableName(client, agent, number, summary, status)
values(?, ?, ?, "", ?)
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute([$client,
                        $agent,
                        $number,
                        ClientCase::STATUS_OPEN]
                ) === false) {
                return null;
            }
        } catch(\PDOException $e) {
            return null;
        }

        return $pdo->lastInsertId();
    }

    public function getCases(){
        $users = new Users($this->site);

        $usersTable = $users->getTableName();

        $sql = <<<SQL
select c.id as id, client, u.name as clientName, agent, us.name as agentName, number, summary, status
from $this->tableName as c
inner join $usersTable as u
on c.client = u.id
inner join $usersTable as us
on c.agent = us.id
order by status DESC, number


SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute();

        $array = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $collection = array();
        foreach ($array as $val){
            $client = new ClientCase($val);
            $collection[] = $client;
        }
        return $collection;
    }

    public function update($id,$number,$summary,$agent,$status){
        $ret = true;

        $sql =<<<SQL
UPDATE $this->tableName
set agent=?, number=?, summary=?, status=?
where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            $ret = $statement->execute(array($agent,$number,$summary,$status,$id));
        } catch(\PDOException $e) {
            return false;
        }

        if($statement->rowCount() === 0) {
            return false;
        }

        return $ret;

    }





}