<?php
$open = true;
require 'lib/site.inc.php';
$view = new Felis\HomeView();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="mainpage">
    <?php echo $view->header(); ?>
<!--<nav>
	<ul class="left">
		<li><a href="./">The Felis Agency</a></li>
	</ul>

	<ul class="right">
		<li><a href="login.php">Log in</a></li>
	</ul>
</nav>

<header class="main">
	<h1><img src="images/comfortable.png" alt="Felis Mascot"> Felis Investigations
		<img src="images/comfortable.png" alt="Felis Mascot"></h1>
	<p>Welcome to Felis Investigations!</p>
	<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
		and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
		Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
	<p><a href="">Learn more</a></p>
</header>-->

    <?php

    $view->addTestimonial('Found out that fluffy was fluffing someone else on the side.
Found me a new top cat.', 'Anonymous');
    $view->addTestimonial('Thanks for ensuring me that Garfield was only interested in
Lasagna and not chasing after that mangy cat that lives behind the Italian
restaurant.', 'Jon');
    $view->addTestimonial('They told me nobody could beat the Hidden Paw, but you
brought Macavity to justice. Thank you so much.', 'Anonymous');
    $view->addTestimonial('Thank you so much for finding grandma Grizabella. We thought
we would never see her again.', 'Valerie Eliot');

    echo $view->testimonials();
    ?>

<form class="request">
	<fieldset>
		<legend>Request a free case evaluation!</legend>
		<p>
			<label for="name">Name</label><br>
			<input type="text" id="name" name="name" placeholder="Name">
		</p>
		<p>
			<label for="email">E-Mail</label><br>
			<input type="email" id="email" name="email" placeholder="Email Address">
		</p>
		<p>
			<label for="message">Message</label><br>
			<textarea id="message" name="message" placeholder="Message"></textarea>
		</p>
		<p>
			<input type="submit" value="Send">
		</p>

	</fieldset>
</form>

<footer>
    <?php echo $view->footer(); ?>
</footer>

</div>

</body>
</html>
