<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo LINK_GLOBAL; ?>css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo LINK_GLOBAL; ?>css/bootstrap-theme.css">

	<script type="text/javascript" src="<?php echo LINK_GLOBAL; ?>js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="<?php echo LINK_GLOBAL; ?>js/bootstrap.js"></script>
</head>
<body>
	<header class="navbar navbar-inverse">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Mi Aplicacion</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo LINK_GLOBAL; ?>">Home <span class="sr-only">(current)</span></a></li>
					<?php if (isset($session['user'])) { ?>
					<li><a href="<?php echo LINK_GLOBAL; ?>index.php/index/logout">Logout</a></li>
					<?php } else { ?>
					<li><a href="<?php echo LINK_GLOBAL; ?>index.php">Login</a></li>
					<li><a href="<?php echo LINK_GLOBAL; ?>index.php/register">Registrarse</a></li> 
					<?php } ?>
				</ul>
				<?php if (isset($session['user'])) { ?>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<p class="navbar-text">
						<strong><?php echo htmlspecialchars($session['user']['name']); ?></strong> |
						<small><?php echo htmlspecialchars($session['user']['username']); ?></small>
						</p>
					</li>
					<li>
						<img src="<?php echo LINK_GLOBAL.$session['user']['image']; ?>" height="50px" width="50px" />
					</li>
				</ul>
				<?php } ?>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</header>
	<div class="container">