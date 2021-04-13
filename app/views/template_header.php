<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title><?php echo PAGE_TITLE; ?></title>
		<link rel="icon" type="image/png" href="<?php echo BASEURL; ?>/public/img/favicon.png"/>
		<link rel="stylesheet" href="<?php echo BASEURL; ?>/public/css/normalize.css">
		<link rel="stylesheet" href="<?php echo BASEURL; ?>/public/css/skeleton.css">
		<link rel="stylesheet" href="<?php echo BASEURL; ?>/public/font-awesome/css/all.min.css">
		<link rel="stylesheet" href="<?php echo BASEURL; ?>/public/css/template.css">
		<?php if (defined('CUSTOM_CSS')) { ?>
			<link rel="stylesheet" href="<?php echo BASEURL; ?>/public/css/<?php echo CUSTOM_CSS; ?>">
		<?php } ?>
	</head>
	<body>
		<header>
			<nav class="nav-show">
				<div class="container">
					<ul>
						<li><a id="logo" href="<?php echo BASEURL; ?>"><img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/slmo.png" alt="logo"> Sri Lanka Maths Olympiad </a></li>
						<li><a href="<?php echo BASEURL; ?>/competitions/view"> Competitions </a></li>
						<li><a href="<?php echo BASEURL; ?>/news/view"> News </a></li>
						<li><a href="<?php echo BASEURL; ?>/gallery/view"> Gallery </a></li>
						<li>
							<a href="#"> Learn </a>
							<ul>
								<li><a href="<?php echo BASEURL; ?>/forum/view"> Forum </a></li>
								<li><a href="<?php echo BASEURL; ?>/quizzes/view"> Quizzes </a></li>
								<li><a href="<?php echo BASEURL; ?>/learn/resources"> Resources </a></li>
							</ul>
						</li>
						<li>
							<a href="#"> About </a>
							<ul>
								<li><a href="<?php echo BASEURL; ?>/about/foundation"> Foundation </a></li>
								<li><a href="<?php echo BASEURL; ?>/about/staff"> Staff </a></li>
								<li><a href="<?php echo BASEURL; ?>/about/science"> Science & CT </a></li>
								<li><a href="<?php echo BASEURL; ?>/about/contact"> Contact </a></li>
							</ul>
						</li>

						<?php if (isset($_SESSION['user'])) { ?>
						<li>
							<a href="#"> My Account </a>
							<ul>
								<li><a href="<?php echo BASEURL; ?>/account/notifications"> Notifications <i class="fas fa-bell u-pull-right"></i></a></li>
								<li><a href="<?php echo BASEURL; ?>/account/dashboard"> Dashboard <i class="fas fa-columns u-pull-right"></i></a></li>
								<li><a href="<?php echo BASEURL; ?>/account/settings"> Settings <i class="fas fa-cog u-pull-right"></i></a></li>
								<li><a href="<?php echo BASEURL; ?>/account/logout"> Logout <i class="fas fa-sign-out-alt u-pull-right"></i></a></li>
							</ul>
						</li>
						<?php } else { ?>
						<li class="u-pull-right"><a href="<?php echo BASEURL; ?>/account/register">Register</a></li>
						<li class="u-pull-right"><a href="<?php echo BASEURL; ?>/account/login">Login</a></li>
						<?php } ?>
						
						<!-- For mobile navigation -->
						<li id="hambug">
							<a href="javascript:void(0);" onclick="toggleMobileNav();">&#9776;</a>
						</li>
					</ul>
				</div>
			</nav>
			<!-- Start mobile side navigation bar -->
			<div id="sidenav">
				<div class="container">
					<ul>
						<?php if (isset($_SESSION['user'])) { ?>
						<li><a href="#"> My Account </a></li>
						<ul>
							<li><a href="<?php echo BASEURL; ?>/account/notifications"> - Notifications <i class="fas fa-bell"></i></a></li>
							<li><a href="<?php echo BASEURL; ?>/account/dashboard"> - Dashboard <i class="fas fa-columns"></i></a></li>
							<li><a href="<?php echo BASEURL; ?>/account/settings"> - Settings <i class="fas fa-cog"></i></a></li>
							<li><a href="<?php echo BASEURL; ?>/account/logout"> - Logout <i class="fas fa-sign-out-alt"></i></a></li>
						</ul>
						<?php } else { ?>
						<li><a href="<?php echo BASEURL; ?>/account/login"> Login </a></li>
						<li><a href="<?php echo BASEURL; ?>/account/register"> Register </a></li>
						<?php } ?>

						<li><a href="<?php echo BASEURL; ?>/competitions/view"> Competitions </a></li>
						<li><a href="<?php echo BASEURL; ?>/news/view"> News </a></li>
						<li><a href="<?php echo BASEURL; ?>/gallery/view"> Gallery </a></li>
						<li><a href="#"> Learn </a></li>
						<ul>
							<li><a href="<?php echo BASEURL; ?>/forum/view"> - Forum </a></li>
							<li><a href="<?php echo BASEURL; ?>/quizzes/view"> - Quizzes </a></li>
							<li><a href="<?php echo BASEURL; ?>/learn/resources"> - Resources </a></li>
						</ul>
						<li><a href="#"> About </a></li>
						<ul>
							<li><a href="<?php echo BASEURL; ?>/about/foundation"> - Foundation </a></li>
							<li><a href="<?php echo BASEURL; ?>/about/staff"> - Staff </a></li>
							<li><a href="<?php echo BASEURL; ?>/about/science"> - Science &amp; CT </a></li>
						</ul>
						<li><a href="<?php echo BASEURL; ?>/about/contact"> Contact Us </a></li>
					</ul>
				</div>
			</div>
			<script src="<?php echo BASEURL; ?>/public/js/jquery-3.5.1.min.js"></script>
			<script src="<?php echo BASEURL; ?>/public/js/template.js"></script>
		</header>
		<main>
			<?php if (isset($_SESSION['alert_msg'])) { ?>
				<div class="container" style="margin: 0;">
					<div id="alert" data-type="<?php echo $_SESSION['alert_type']; ?>">
						<div id="alert-msg" class="u-full-width">
							<?php echo $_SESSION['alert_msg']; ?>
						</div>
						<span id="alert-close" class="u-pull-right" onclick="this.parentElement.style.display='none';">&times;</span>
					</div>
				</div>
				<?php unset($_SESSION['alert_msg']); ?>
			<?php } ?>