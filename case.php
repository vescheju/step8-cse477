<?php
require 'lib/site.inc.php';
$view = new Felis\CaseView($site);
if(!$view->protect($site, $user)) {
    header("location: " . $view->getProtectRedirect());
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="case">
    <?php echo $view->header(); ?>
    <?php echo $view->present(); ?>


    <footer>
        <?php echo $view->footer(); ?>
    </footer>


</div>

</body>
</html>
