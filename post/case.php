<?php
require '../lib/site.inc.php';

$controller = new Felis\CaseController($site, $_POST);
header("location: " . $controller->getRedirect());