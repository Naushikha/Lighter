<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo PAGE_TITLE; ?></title>
	<link rel="icon" type="image/png" href="<?php echo BASEURL; ?>/public/img/favicon.svg" />
	<link rel="stylesheet" href="<?php echo BASEURL; ?>/public/css/normalize.css">
	<link rel="stylesheet" href="<?php echo BASEURL; ?>/public/css/skeleton.css">
	<!-- Lighter template CSS -->
	<link rel="stylesheet" href="<?php echo BASEURL; ?>/public/css/lighter_template.css">
	<!-- Lighter custom CSS -->
	<?php if (defined('CUSTOM_CSS')) { ?>
		<link rel="stylesheet" href="<?php echo BASEURL; ?>/public/css/<?php echo CUSTOM_CSS; ?>">
	<?php } ?>
</head>

<body>
	<header>
		<nav class="nav-show">
			<div class="container">
				<ul>
					<li><a id="logo" href="<?php echo BASEURL; ?>"><img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/favicon.svg" alt="logo">lighter </a></li>
					<li><a href="<?php echo BASEURL; ?>/#"> Menu Item 1 </a></li>
					<li><a href="<?php echo BASEURL; ?>/#"> Menu Item 2 </a></li>
					<li><a href="<?php echo BASEURL; ?>/#"> Menu Item 3 </a></li>
					<li>
						<a href="#"> Menu Item 4 </a>
						<ul>
							<li><a href="<?php echo BASEURL; ?>/#"> List Item 1 </a></li>
							<li><a href="<?php echo BASEURL; ?>/#"> List Item 2 </a></li>
							<li><a href="<?php echo BASEURL; ?>/#"> List Item 3 </a></li>
						</ul>
					</li>

					<li class="u-pull-right"><a href="<?php echo BASEURL; ?>/account/register">Register</a></li>
					<li class="u-pull-right"><a href="<?php echo BASEURL; ?>/account/login">Login</a></li>

					<!-- For Lighter mobile navigation -->
					<li id="hambug">
						<a href="javascript:void(0);" onclick="toggleMobileNav();">&#9776;</a>
					</li>
				</ul>
			</div>
		</nav>
		<!-- Start Lighter mobile side navigation bar -->
		<div id="sidenav">
			<div class="container">
				<ul>
					<li><a href="<?php echo BASEURL; ?>/account/login"> Login </a></li>
					<li><a href="<?php echo BASEURL; ?>/account/register"> Register </a></li>

					<li><a href="<?php echo BASEURL; ?>/#"> Menu Item 1 </a></li>
					<li><a href="<?php echo BASEURL; ?>/#"> Menu Item 2 </a></li>
					<li><a href="<?php echo BASEURL; ?>/#"> Menu Item 3 </a></li>
					<li><a href="#"> Menu Item 4 </a></li>
					<ul>
						<li><a href="<?php echo BASEURL; ?>/#"> - List Item 1 </a></li>
						<li><a href="<?php echo BASEURL; ?>/#"> - List Item 2 </a></li>
						<li><a href="<?php echo BASEURL; ?>/#"> - List Item 3 </a></li>
					</ul>

				</ul>
			</div>
		</div>
		<!-- End Lighter mobile side navigation bar -->
		<script src="<?php echo BASEURL; ?>/public/js/jquery-3.5.1.min.js"></script>
		<!-- Lighter template JS -->
		<script src="<?php echo BASEURL; ?>/public/js/lighter_template.js"></script>
	</header>
	<main>
		<!-- Lighter alert support -->
		<?php if (isset($_SESSION['LIGHTER_ALERTS'])) { ?>
			<?php $id = 0; ?>
			<?php foreach ($_SESSION['LIGHTER_ALERTS'] as $alert) { ?>
				<div id="alert<?php echo $id; ?>" class="container alert <?php echo $alert['type']; ?>">
					<div class="row">
						<div class="eleven columns">
							<div class="alert-msg">
								<?php echo $alert['msg']; ?>
							</div>
						</div>
						<div class="one column">
							<span class="alert-close" onclick="$('#alert<?php echo $id++; ?>').fadeOut('fast');">&times;</span>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php unset($_SESSION['LIGHTER_ALERTS']); ?>
		<?php } ?>