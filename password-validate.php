<?php
$open = true;
require 'lib/site.inc.php';
$view = new Felis\PasswordValidateView($site, $_GET);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="password">

    <?php
    echo $view->header();
    echo $view->present();
    ?>

    <footer>
        <?php echo $view->footer(); ?>
    </footer>

</div>

</body>
</html>