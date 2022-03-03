<?php


namespace Felis;


class UsersController {
    public function __construct(Site $site, User $user, array $post) {
        $root = $site->getRoot();
        $this->redirect = "$root/user.php";

        if(isset($post['edit'])){
            if(isset($post['user'])){
                $id = $post['user'];
                $this->redirect = "$root/user.php?id=$id";
            }else{
                $this->redirect = "$root/users.php";
            }
        }
    }

    /**
     * @return mixed
     */
    public function getRedirect() {
        return $this->redirect;
    }


    private $redirect;	///< Page we will redirect the user to.
}