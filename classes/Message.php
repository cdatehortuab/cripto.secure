<?php

class Message extends AbstractObject {
	
	protected $id;
	protected $subject;
	protected $message;
	protected $from_user;
	protected $to_user;

	public function jsonSerialize() {
		return array(
			'id' => $this->id,
			'subject' => $this->subject,
			'message' => $this->message,
			'from_user' => $this->from_user,
			'to_user' => $this->to_user
			);
	}

	public function validate() {
		if (empty($this->subject) || empty($this->message) || empty($this->to_user) || empty($this->from_user)) {
			return array('status' => false, 'message' => "Hay campos obligatorios incompletos");
		}
		return array('status'=> true);
	}
}

?>