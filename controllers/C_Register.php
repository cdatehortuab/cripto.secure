<?php

class C_Register extends AbstractController {

	public function index() {
		$this->assign('title', "Registrase | Mi Aplicación");

		$this->display('header', $this->auxView, 'register', 'footer');
	}

	public function register() {
		if ($this->files->image['error'] != 0) {
			$this->post->image = NULL;
			$this->auxView = 'message';
			$this->assign('type_msg', 'warning');
			$this->assign('message', "No especificó una imagen u ocurrió un error. Se usa imagen por defecto");
		} else {
			if ($this->files->image['type'] != "image/jpeg" && $this->files->image['type'] != "image/png") {
				$this->post->image = NULL;
				$this->auxView = 'message';
				$this->assign('type_msg', 'warning');
				$this->assign('message', "Tipo de archivo inválido. Se usa imagen por defecto");
			} else {
				$file = 'images/'.$this->post->username.'_'.basename($this->files->image['name']);
				if (move_uploaded_file($this->files->image['tmp_name'], PATH_GLOBAL.$file)) {
					$this->post->image = $file;
				} else {
					$this->post->image = NULL;
					$this->auxView = 'message';
					$this->assign('type_msg', 'warning');
					$this->assign('message', "Ocurrió un error. Se usa imagen por defecto");
				}
			}
		}

		$user = new User($this->post);
		if (empty($this->post->password2) || $user->password != $this->post->password2) {
			$this->assign('user', $user);
			$this->auxView = 'message';
			$this->assign('type_msg', 'danger');
			$this->assign('message', "Las contraseñas no coinciden");
		} else {
			$val = $user->validate();
			if ($val['status']) {
				$user->insert();
				if ($this->auxView != 'message') {
					$this->auxView = 'message';
					$this->assign('type_msg', 'success');
					$this->assign('message', "Usuario registrado correctamente");
				}
			} else {
				$this->assign('user', $user);
				$this->auxView = 'message';
				$this->assign('type_msg', 'danger');
				$this->assign('message', $val['message']);
			}
		}
		
		$this->index();
	}
}