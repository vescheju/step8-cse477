<?php


namespace Felis;


class UserView extends View{
    /**
     * Constructor
     * Sets the page title and any other settings.
     * @param Site $site The Site object
     */
    public function __construct(Site $site) {
        $this->site = $site;

        $this->setTitle("Felis Investigations User");
        $this->addLink("staff.php", "Staff");
        $this->addLink("post/logout.php", "Log out");


    }

    public function present() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $users = new Users($this->site);
            $user = $users->get($id);
            $email = $user->getEmail();
            $name = $user->getName();
            $phone = $user->getPhone();
            $address = $user->getAddress();
            $notes = $user->getNotes();

            $html = <<<HTML
<form method="post" action="post/user.php">
<fieldset>
<input type="hidden" name="id" value="$id">                
		<legend>User</legend>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email" value="$email">
		</p>
		<p>
			<label for="name">Name</label><br>
			<input type="text" id="name" name="name" placeholder="Name" value="$name">
		</p>
		<p>
			<label for="phone">Phone</label><br>
			<input type="text" id="phone" name="phone" placeholder="Phone" value="$phone">
		</p>
		<p>
			<label for="address">Address</label><br>
			<textarea id="address" name="address" placeholder="Address"">$address</textarea>
		</p>
		<p>
			<label for="notes">Notes</label><br>
			<textarea id="notes" name="notes" placeholder="Notes">$notes</textarea>
		</p>
		<p>
			<label for="role">Role: </label>
			<select id="role" name="role">
				<option value="admin">Admin</option>
				<option value="staff">Staff</option>
				<option value="client">Client</option>
			</select>
		</p>
		<p>
			<input type="submit" name="ok" id="ok" value="OK"> <input type="submit" name="cancel" id="cancel" value="Cancel">
		</p>

	</fieldset>
</form>
HTML;


        }else{
            $html = <<<HTML
<form method="post" action="post/user.php">
<fieldset>              
		<legend>User</legend>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="name">Name</label><br>
			<input type="text" id="name" name="name" placeholder="Name">
		</p>
		<p>
			<label for="phone">Phone</label><br>
			<input type="text" id="phone" name="phone" placeholder="Phone">
		</p>
		<p>
			<label for="address">Address</label><br>
			<textarea id="address" name="address" placeholder="Address"></textarea>
		</p>
		<p>
			<label for="notes">Notes</label><br>
			<textarea id="notes" name="notes" placeholder="Notes"></textarea>
		</p>
		<p>
			<label for="role">Role: </label>
			<select id="role" name="role">
				<option value="admin">Admin</option>
				<option value="staff">Staff</option>
				<option value="client">Client</option>
			</select>
		</p>
		<p>
			<input type="submit" name="ok" id="ok" value="OK"> <input type="submit" name="cancel" id="cancel" value="Cancel">
		</p>

	</fieldset>
</form>
HTML;


        }




        return $html;
    }

    private $site;



}