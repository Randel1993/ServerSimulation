<?php
class Server {
	private $sources;
	private $destinations;

	function __construct($sources, $destinations) {
		$this->sources = $sources;
		$this->destinations = $destinations;
	}

	function check_destination($source, $destination) {

		$groups = array_map(function($val){return $val->get_id();}, $source->get_groups());
		$excluded = array_map(function($val){return $val->get_id();},  $destination->get_exclusions());
		$included = array_map(function($val){return $val->get_id();},  $destination->get_inclusions());

		return empty(array_intersect($groups, $excluded)) && !empty(array_intersect($groups, $included));
	}
	
	function get_sources($destination) {
		$excluded = array_map(function($val){return $val->get_id();},  $destination->get_exclusions());
		$included = array_map(function($val){return $val->get_id();},  $destination->get_inclusions());

		$inc = array();
		$exc = array();

		foreach ($this->sources as $source) {
			$groups = array_map(function($val){return $val->get_id();}, $source->get_groups());
			if(!empty(array_intersect($groups, $included))) {
				array_push($inc, $source);
			}

			if(!empty(array_intersect($groups, $excluded))) {
				array_push($exc, $source);
			}
		}
		return ['included' => count($inc), 'excluded' => count($exc)];
	}

	function get_best_destination($source) {

		$retval = null;

		foreach ($this->destinations as $destination) {
			// check if valid destination
			if($this->check_destination($source, $destination)) {
				// initial value
				if(is_null($retval)) {
					$retval = $destination;
				} else {
					// check if new destination has less inclusions
					if(count($retval->get_inclusions()) > count($destination->get_inclusions())) {
						$retval = $destination;
					// check if equal, need to check for exclusions
					} else if (count($retval->get_inclusions()) == count($destination->get_inclusions())) {
						// check exclusions
						if(count($retval->get_exclusions()) < count($destination->get_exclusions())) {
							$retval = $destination;
						}
					}
				}
			}
		}

		return $retval;
	}
}
?>