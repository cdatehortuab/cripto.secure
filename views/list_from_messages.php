<div class="col-xs-12 col-sm-offset-2 col-sm-8">
	<div class="jumbotron">
		<div class="container">
		<h1>Mensajes de:</h1>
		<p>
			<strong><?php echo htmlspecialchars($from_user->name); ?></strong> |
			<small><?php echo htmlspecialchars($from_user->username); ?></small>
		</p>
		<?php foreach ($messages as $message) { ?>
			<p>
				<?php echo htmlspecialchars($message->subject); ?>
				<a class="btn btn-primary pull-right" href="<?php echo LINK_GLOBAL; ?>index.php/message/viewOne?id=<?php echo $message->id; ?>">Ver Mensaje</a>
			</p>
		<?php } ?>
		</div>
	</div>
</div>