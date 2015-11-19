<div class="col-xs-12 col-sm-offset-2 col-sm-8">
	<div class="jumbotron">
		<div class="container">
			<h1>Tiene mensajes de:</h1>
			<?php foreach ($users as $user) { ?>
				<p>
					<strong><?php echo htmlspecialchars($user->name); ?></strong> |
					<small><?php echo htmlspecialchars($user->username); ?></small>
					<a class="btn btn-primary pull-right" href="<?php echo LINK_GLOBAL; ?>index.php/message/view?id=<?php echo $user->id; ?>">Ver Mensajes</a>
				</p>
			<?php } ?>
		</div>
	</div>
</div>