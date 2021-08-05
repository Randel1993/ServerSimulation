<?php
class Group {
	private $id;
	private $description;

	function __construct($id, $description) {
		$this->id = $id;
		$this->description = $description;;
	}
	
	function get_id() {
		return $this->id;
	}

	function get_description() {
		return $this->description;
	}
}
?>