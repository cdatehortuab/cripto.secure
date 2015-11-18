<div class="col-xs-12 col-sm-offset-2 col-sm-8">
	<div class="jumbotron">
		<div class="container">
			<h1 style="text-align:center;">Enviar Mensaje</h1>
			<?php if (isset($msg)) $bool = true; else $bool = false; ?>
			<form role="form" class="form-horizontal" action="<?php echo LINK_GLOBAL; ?>index.php/message/sendMessage" method="post">
				<div class="form-group">
					<label for="to_user" class="form-label col-sm-3">Para: (*)</label>
					<div class="col-sm-9">
						<input id="to_user" class="form-control" type="text" name="to_user" placeholder="johndoe" required value="<?php if ($bool) echo $msg->to_user;?>" >
					</div>
				</div>
				<div class="form-group">
					<label for="subject" class="form-label col-sm-3">Asunto: (*)</label>
					<div class="col-sm-9">
						<input id="subject" class="form-control" type="text" name="subject" placeholder="Asunto" required value="<?php if ($bool) echo $msg->subject;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="message" class="form-label col-sm-3">Mensaje: (*)</label>
					<div class="col-sm-9">
						<textarea id="message" class="form-control" type="text" name="message" placeholder="Tu mensaje..." rows="10" required><?php if ($bool) echo $msg->message;?></textarea>
					</div>
				</div>
				<div class="pull-right">
					<button class="btn btn-primary" type="sumbit">Enviar</button>
				</div>
			</form>
		</div>
	</div>
</div>