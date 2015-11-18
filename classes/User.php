<?php

class User extends AbstractObject {
	
	protected $id;
	protected $name;
	protected $username;
	protected $password;
	protected $email;
	protected $image;
	protected $birthday;

	public function jsonSerialize() {
		return array(
			'id' => $this->id,
			'name' => $this->name,
			'username' => $this->username,
			'password' => $this->password,
			'email' => $this->email,
			'image' => $this->image,
			'birthday' => $this->birthday
			);
	}

	public function validate() {

		function validateDate($date, $format = 'Y-m-d') {
			$d = DateTime::createFromFormat($format, $date);
			return $d && $d->format($format) == $date;
		}

		$ret = array();
		if (empty($this->name) || empty($this->username) || empty($this->password) || empty($this->email) || empty($this->birthday)){
			$ret['status'] = false;
			$ret['message'] = "Hay campos obligatorios incompletos";
			return $ret;
		}

		if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			$ret['status'] = false;
			$ret['message'] = "No es un email válido";
			return $ret;
		}

		if (!validateDate($this->birthday)) {
			$ret['status'] = false;
			$ret['message'] = "No es una fecha válida";
			return $ret;
		}

		$ret['status'] = true;
		return $ret;
	}
}

?>