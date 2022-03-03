<?php


namespace Felis;


class StaffView extends View {
    public function __construct() {
        $this->setTitle("Felis Investigations Staff");
        $this->addLink("post/logout.php", "Log out");
    }

}