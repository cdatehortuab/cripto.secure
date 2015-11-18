<?php

class C_Message extends AbstractController {

	public function index() {
		$users = (new User())->get('with_message', array('to_user' => $this->session['user']['id']));
		$this->assign('users', $users);

		$this->assign('title', "Mensajes | Mi Aplicación");

		$this->display('header', $this->auxView, 'list_messages', 'footer');
	}

	public function sendMessage() {
		$this->post->from_user = $this->session['user']['id'];
		$message = new Message($this->post);
		$val = $message->validate();
		if ($val['status']) {
			$message->insert();
			$this->auxView = 'message';
			$this->assign('type_msg', 'success');
			$this->assign('message', "Mensaje Enviado");
			$this->index();
		} else {
			$this->assign('msg', $message);
			$this->auxView = 'message';
			$this->assign('type_msg', 'danger');
			$this->assign('message', $val['message']);
			$this->send();
		}
	}

	public function send() {
		$this->assign('title', "Enviar Mensaje | Mi Aplicación");
		$this->display('header', $this->auxView, 'send_message', 'footer');
	}

	public function view() {
		$messages = (new Message())->get("from_to", array('from_user' => $this->get->id, 'to_user' => $this->session['user']['id']));
		$from_user = (new User())->get('one', array('id' => $this->get->id));
		
		$this->assign('from_user', $from_user[0]);
		$this->assign('messages', $messages);

		$this->assign('title', "Mensajes de {$from_user[0]->username} | Mi Aplicación");

		$this->display('header', $this->auxView, 'list_from_messages', 'footer');
	}

	public function viewOne() {
		$message = (new Message())->get("one", array('id' => $this->get->id));
		$this->assign('message', $message[0]);

		$this->assign('title', "Mensaje | Mi Aplicación");

		$this->display('header', $this->auxView, 'one_message', 'footer');
	}
}

?>