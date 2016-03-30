<!DOCTYPE html>
<html>
<head>
	<title><?=$titre?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="inc/style.inc.css">
</head>
<body>
<header class="container">
	<div class="row">
	<nav>
		<h1>lokiSalle</h1>
		<h2>Slogan</h2>
	</nav>
		<?php
			include_once 'menu.inc.php';
		?>
	</div>
</header>
<?= (!empty($msg)) ? $msg : '' ?>