<?php
class Destination {
	private $id;
	private $description;
	private $excluded;
	private $included;

	function __construct($id, $description) {
		$this->id = $id;
		$this->description = $description;;
		$this->excluded = array();
		$this->included = array();
	}

	function add_exclusion($data) {
		array_push($this->excluded, $data);
	}

	function add_inclusion($data) {
		array_push($this->included, $data);
	}

	function get_id() {
		return $this->id;
	}

	function get_description() {
		return $this->description;
	}

	function get_exclusions() {
		return $this->excluded;
	}

	function get_inclusions() {
		return $this->included;
	}
}
?>