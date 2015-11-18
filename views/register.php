<div class="col-xs-12 col-sm-offset-2 col-sm-8">
	<div class="jumbotron">
		<div class="container">
			<h1 style="text-align:center;">Registrarse</h1>
			<div class="row">
				<?php if (isset($user)) $bool = true; else $bool = false; ?>
				<form role="form" class="form-horizontal" action="<?php echo LINK_GLOBAL; ?>index.php/register/register" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name" class="form-label col-sm-4">Nombre:</label>
						<div class="col-sm-8">
							<input id="name" class="form-control" type="text" name="name" placeholder="John Doe" required value="<?php if ($bool) echo $user->name;?>">
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="form-label col-sm-4">Nombre de Usuario:</label>
						<div class="col-sm-8">
							<input id="username" class="form-control" type="text" name="username" placeholder="johndoe" required value="<?php if ($bool) echo $user->username;?>">
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="form-label col-sm-4">Contraseña:</label>
						<div class="col-sm-8">
							<input id="password" class="form-control" type="password" name="password" placeholder="Contraseña" required>
						</div>
					</div>
					<div class="form-group">
						<label for="password2" class="form-label col-sm-4">Repetir Contraseña:</label>
						<div class="col-sm-8">
							<input id="password2" class="form-control" type="password" name="password2" placeholder="Contraseña" required>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="form-label col-sm-4">Email:</label>
						<div class="col-sm-8">
							<input id="email" class="form-control" type="email" name="email" placeholder="johndoe@example.com" required value="<?php if ($bool) echo $user->email;?>">
						</div>
					</div>
					<div class="form-group">
						<label for="birthday" class="form-label col-sm-4">Fecha de Nacimiento:</label>
						<div class="col-sm-8">
							<input id="birthday" class="form-control" type="date" name="birthday" placeholder="aaaa-mm-dd" required value="<?php if ($bool) echo $user->birthday;?>">
						</div>
					</div>
					<div class="form-group">
						<label for="image" class="form-label col-sm-4">Imagen:</label>
						<div class="col-sm-8">
							<input id="image" type="file" name="image" accept="image/*">
						</div>
					</div>
					<div class="pull-right">
						<button class="btn btn-primary" type="sumbit">Registrarse</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>