<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
	<div class="jumbotron">
		<div class="container">
			<?php if (!isset($session['user'])) { ?>
				<h1><a name="login"></a>Login</h1>
				<form action="<?php echo LINK_GLOBAL; ?>index.php/index/login" method="post" role="form">
					<div class="form-group">
						<label class="sr-only" for="username">Username</label>
						<input class="form-control" id="username" type="text" name="username" placeholder="Username" required>
					</div>
					<div class="form-group">
						<label class="sr-only" for="password">Password</label>
						<input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
					</div>
					<button class="btn btn-primary btn-lg" type="submit">Login</button>
					<a class="btn btn-primary btn-lg" href="<?php echo LINK_GLOBAL; ?>index.php/register" role="button">Registrar</a>
				</form>
				<?php } else { ?>
					<div style="text-align:center;">
						<a class="btn btn-primary" href="<?php echo LINK_GLOBAL; ?>index.php/message/send">Enviar Mensaje</a>
						<a class="btn btn-primary" href="<?php echo LINK_GLOBAL; ?>index.php/message">Ver Mensajes</a>
					</div>
				</ul>
				<?php } ?>
		</div>
	</div>
</div>