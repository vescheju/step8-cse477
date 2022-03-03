Expand for CasesControllerTest.php

<?php

/** @file
 * Unit tests for the class CasesController
 * @cond
 */
class CasesControllerTest extends \PHPUnit\Framework\TestCase
{
    public function test_add() {
        $site = new Felis\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize($site);
        }

        $post = ['add' => "Add"];
        $controller = new Felis\CasesController($site, $post);
        $this->assertContains("step8/newcase.php", $controller->getRedirect());
    }
}

/// @endcond