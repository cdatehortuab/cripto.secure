<?php
require(PATH_GLOBAL."include/DB.php");

abstract class AbstractObject implements JsonSerializable {

	public function __construct(stdClass $data = NULL) {
		if ($data != NULL) {
			$object_vars = get_object_vars($data);
			if ($object_vars != NULL) {
				foreach ($object_vars as $key => $value) {
					$this->$key = $data->$key;
				}
			}
		}
	}

	public function __get($attr) {
		return $this->$attr;
	}

	public function __set($attr, $value) {
		$this->$attr = $value;
	}

	public function __toString() {
		return json_encode($this);
	}

	public abstract function jsonSerialize();

	public function get_all() {
		return $this->get("all");
	}

	public function get($case, array $params = array()) {
		$objects = array();
		$class = get_class($this);
		$db = DB::getInstance();
		$data = $db->select($class, $case, $params);
		foreach ($data as $value) {
			array_push($objects, new $class($value));
		}
		return $objects;
	}

	public function insert($case = "normal") {
		$db = DB::getInstance();
		$db->insert($case, $this);
	}

	public function delete($case = "normal") {
		$db = DB::getInstance();
		$db->update($case, $this);
	}

	public function update($case = "normal") {
		$db = DB::getInstance();
		$db->delete($case, $this);
	}

}