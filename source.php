<?php
class Source {
	private $id;
	private $description;
	private $groups;

	function __construct($id, $description) {
		$this->id = $id;
		$this->description = $description;
		$this->groups = array();
	}

	function add_group($data) {
		array_push($this->groups, $data);
	}

	function get_id() {
		return $this->id;
	}

	function get_description() {
		return $this->description;
	}

	function get_groups() {
		return $this->groups;
	}
}
?>