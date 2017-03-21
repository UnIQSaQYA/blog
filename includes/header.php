<?php 
require_once "core/init.php";

$user = new User();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

<?php
if($user->isLoggedIn()) {
?>
<nav class="navbar navbar-toggleable-md navbar-light bg-faded cyan-A700 primary-nav">
	<div class="container">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand text-white" href="#">Blog</a>
		<div class="collapse navbar-collapse justify-content-end" id="navbarText">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Features</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Pricing</a>
				</li>
			</ul>
		</div>
	</div>
</nav>


<?php
}
?>

