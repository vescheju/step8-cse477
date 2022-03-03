<?php


namespace Felis;


class CasesController
{
    public function __construct(Site $site, array $post) {
        $root = $site->getRoot();
        $this->redirect = $root;
        if(isset($post['add'])) {
            $this->redirect = "$root/newcase.php";
        }
        if(isset($post['delete'])) {
            $this->redirect = "$root/deletecase.php";
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