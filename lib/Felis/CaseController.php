<?php


namespace Felis;


class CaseController
{
    public function __construct(Site $site, array $post) {
        $root = $site->getRoot();
        $cases = new Cases($site);
        if(isset($post['update'])){
            $isError = $cases->update($post['id'],$post['number'],$post['summary'],$post['agent'],$post['status']);
            if(!$isError) {
                $id = $post['id'];
                $this->redirect = "$root/case.php?id=$id";
            } else{
                $this->redirect = "$root/cases.php";
            }
        }else{
            $id = $post['id'];
            $this->redirect = "$root/case.php?=$id";
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