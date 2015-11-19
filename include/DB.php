<?php

require (PATH_GLOBAL.'include/phpass/PasswordHash.php');

class DB {
	private static $instance = NULL;

	private $cn;

	private function __construct() {
		$this->cn = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DBNAME, MYSQL_PORT);
		$this->cn->query('SET NAMES utf8');
	}

	private function get_data($operation) {	
		$data = array(); 
		$result = mysqli_query($this->cn, $operation) or die(mysqli_error($this->cn));
		while ($row = mysqli_fetch_object($result)) {
			array_push($data, $row);
		}
		return $data;
	}

	private function do_operation($operation, $class = NULL) {
		$result = mysqli_query($this->cn, $operation) ;
		if(!$result) {$this->throw_sql_exception($class);}	
	}

	private function escape_string(&$data) {
		if(is_object($data)) {
			foreach ($data->jsonSerialize() as $key => $attribute) {
				$data->$key = mysqli_real_escape_string($this->cn, $data->$key);
			}
		} else if(is_array($data)) {
			foreach ($data as $key => $value) {
				$this->escape_string($data[$key]);
			}
		} else {
			$data = mysqli_real_escape_string($this->cn, $data);
		}
	}

	private function throw_sql_exception($class) {
		$errno = mysqli_errno($this->cn);
		$error = mysqli_error($this->cn);		
		/*if ($errno == 1452) { //No se satisface la clave foránea
			
		} else if ($errno == 1062) { //No se satisface la clave primaria
			
		} else {*/
			$msg = $error."<br /><br /><b>Error number:</b> ".$errno;
		// }
        throw new Exception($msg);
    }

	public function select($class, $case, $data = NULL) {
		$query = NULL;
		$this->escape_string($data);
		switch ($class) {
			
			case "User":
			switch ($case) {
				
				case "all":
					$query = "SELECT * FROM user";
					break;

				case "one":
					$id = $data['id'];
					$query = "SELECT * FROM user WHERE id = '$id'";
					break;

				case "login":
					$username = $data['username'];
					$password = $data['password'];
					$query = "SELECT * FROM user WHERE username = '$username'";
					$result = $this->get_data($query);
					$hasher = new PasswordHash(8, FALSE);
					if (empty($result) || !($hasher->CheckPassword($password, $result[0]->password))) {
						$query = "SELECT *  FROM user WHERE 1 != 1";
					}
					unset($hasher);
					break;
				
				case 'with_message':
					$to_user = $data['to_user'];
					$query = "SELECT * FROM user u WHERE u.id IN (SELECT from_user FROM message WHERE to_user = '$to_user')";
					break;

				default:
					break;
			}
			break;

			case "Message":
			switch ($case) {
				
				case 'one':
					$id = $data['id'];
					$query = "SELECT m.subject, m.message, u.username as from_user FROM message m, user u WHERE m.id = '$id' AND u.id = m.from_user";
					break;

				case 'from_to':
					$from_user = $data['from_user'];
					$to_user = $data['to_user'];
					$query = "SELECT * FROM message WHERE from_user='$from_user' AND to_user='$to_user'";
					break;
				
				default:
					break;
			}
			break;
		}
		return $this->get_data($query);
	}

	public function insert($case, $object) {
		$query = NULL;
		$class = get_class($object);
		$this->escape_string($object);
		switch ($class) {
			
			case "User":
			switch ($case) {
				
				case "normal":
					$name = $object->name;
					$username = $object->username;
					$password = $object->password;
					$email = $object->email;
					$image = $object->image;
					$birthday = $object->birthday;
					$hasher = new PasswordHash(8, FALSE);
					$password = $hasher->HashPassword($password);
					unset($hasher);
					if ($image == NULL)
						$query = "INSERT INTO user (name, username, password, email, birthday) VALUES ('$name', '$username', '$password', '$email', '$birthday');";
					else
						$query = "INSERT INTO user (name, username, password, email, birthday, image) VALUES ('$name', '$username', '$password', '$email', '$birthday', '$image');";
					break;
				
				default:
					break;
			}
			break;

			case "Message":
			switch ($case) {
				case 'normal':
					$from_user = $object->from_user;
					$to_user = $object->to_user;
					$subject = $object->subject;
					$message = $object->message;
					$query = "INSERT INTO message (from_user, to_user, subject, message) SELECT '$from_user', u.id, '$subject', '$message' FROM user u WHERE u.username='$to_user';";
					break;
				
				default:
					break;
			}
			break;
		}
		$this->do_operation($query, $class);
	}

	public function delete($case, $object) {
		$query = NULL;
		$class = get_class($object);
		$this->escape_string($object);
		switch ($class) {
			
			case "User":
			switch ($case) {
				
				case "normal":
					$id = $object->id;
					$query = "DELETE FROM user WHERE id = '$id';";
					break;
				
				default:
					break;
			}
		}
		$this->do_operation($query, $class);
	}

	public function update($case, $object) {
		$query = NULL;
		$class = get_class($object);
		$this->escape_string($object);
		switch ($class) {
			
			case "User":
			switch ($case) {
				
				case "normal":
					$id = $object->id;
					$name = $object->name;
					$username = $object->username;
					$password = $object->password;
					$email = $object->email;
					$birthday = $object->birthday;
					$query = "UPDATE user SET name = '$name', username = '$username', password = '$password', email = '$email', birthday = '$birthday' WHERE id = '$id';";
					break;
				
				default:
					break;
			}
		}
		$this->do_operation($query, $class);
	}

	public static function getInstance() {
		if (self::$instance == NULL) {
			self::$instance = new DB();
		}
		return self::$instance;
	}
}