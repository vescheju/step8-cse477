<?php
require 'lib/site.inc.php';
$view = new Felis\UserView($site);
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
<div class="user">
    <?php
    echo $view->header();
    echo $view->present();
    ?>

	<p>
		Admin users have complete management of the system. Staff users are able to view and make
		reports for any client, but cannot edit the users. Clients can only view the cases
		they have contracted for.
	</p>
    <footer>
        <?php echo $view->footer(); ?>
    </footer>

</div>

</body>
</html>
