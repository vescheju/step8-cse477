<?php
require '../lib/site.inc.php';

unset($_SESSION[Felis\User::SESSION_NAME]);
header("location: ". $site->getRoot() . "/");