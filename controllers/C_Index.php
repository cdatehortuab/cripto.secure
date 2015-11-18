<?php

class C_Index extends AbstractController {

	public function index() {
		$this->assign('title', "Home | Mi aplicación");
		$this->display('header', $this->auxView, 'index', 'footer');
	}

	public function login() {
		if (empty($this->post->username) || empty($this->post->password)) {
			$this->assign('type_msg', 'danger');
			$this->assign('message', 'Falta usuario y/o contraseña');
			$this->auxView = 'message';
			$this->index();	
		} else {
			$user = new User($this->post);
			$user = $user->get("login", array("username" => $user->username, "password" => $user->password));

			if (empty($user)) {
				$this->assign('type_msg', 'danger');
				$this->assign('message', 'Nombre de usuario o contraseña incorrecta');
				$this->auxView = 'message';
				$this->index();
			} else {
				$this->session['user'] = $user[0]->jsonSerialize();
				$this->index();
			}
		}
	}

	public function logout() {
		session_destroy();
		$_SESSION = array();
		$this->index();
	}
}

?>