<?php


namespace Felis;


class NewCaseController{
    public function __construct(Site $site, $user, array $post) {
        $root = $site->getRoot();
        if(!isset($post['ok'])) {
            $this->redirect = "$root/cases.php";
            return;
        }
        $cases = new Cases($site);
        $id = $cases->insert(strip_tags($post['client']),
            $user->getId(),
            strip_tags($post['number']));

        if($id === null) {
            $this->redirect = "$root/newcase.php?e";
        } else {
            $this->redirect = "$root/case.php?id=$id";
        }

    }

    /**
     * @return string
     */
    public function getRedirect(): string
    {
        return $this->redirect;
    }



    private $redirect;

}