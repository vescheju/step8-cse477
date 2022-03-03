<?php


class SiteTest extends \PHPUnit\Framework\TestCase {


    public function test_localize() {
        $site = new Felis\Site();
        $localize = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize($site);
        }
        $this->assertEquals('test8_', $site->getTablePrefix());
    }
    public function test_site() {
        $site = new Felis\Site();

        $site->setEmail("cat@gmail.com");
        $this->assertEquals("cat@gmail.com",$site->getEmail());

        $site->setRoot("root");
        $this->assertEquals("root",$site->getRoot());

        $site->dbConfigure("me","dog","123","table");
        $this->assertEquals("table",$site->getTablePrefix());


    }

}