<div class="col-xs-12 col-sm-offset-2 col-sm-8">
	<div class="jumbotron">
		<div class="container">
			<h1>Mensaje</h1>
			<div class="row">
				<strong class="col-xs-2">De:</strong>
				<span class="col-xs-10"><?php echo htmlspecialchars($message->from_user); ?></span>
			</div>
			<div class="row">
				<strong class="col-xs-2">Asunto:</strong>
				<span class="col-xs-10"><?php echo htmlspecialchars($message->subject); ?></span>
			</div>
			<div class="row">
				<strong class="col-xs-2">Mensaje:</strong>
				<span class="col-xs-10"><?php echo htmlspecialchars($message->message); ?></span>
			</div>
		</div>
	</div>
</div>