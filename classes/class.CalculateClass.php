<?php


class CalculateClass {
	
	private $math;
	
	/**
	 * Instantiate
	 * @param WPMath $math
	 */
	public function __construct(MathClass $math){
		$this->math = $math;
	}
	
	/**
	 * calculate all the things
	 * calculate an array of math problems in string form
	 * 
	 * @param array $problems
	 * @return array associative array of results keyed on problem string
	 */
	public function calculate_all_the_things($problems){
		$results = array();
		foreach($problems as $problem){
			if($params = $this->parse_problem($problem)){
				if(!($results[$problem] = $this->calculate($params['first'],$params['operator'],$params['second']))){
					$results[$problem] = 'Could not calculate this problem';
				}
			}
			else{
				$results[$problem] = 'could not parse the problem';
			}
		}
	}
	
	/**
	 * turn a string into an array for use with this calculator
	 * 
	 * @param string $problem
	 * @return array
	 */
	public function parse_problem($problem){
		$regex = '/(?P<first>[0-9]+)\s*(?P<operator>[+-\/\*])\s*(?P<second>[0-9]+)/';
		if(preg_match($regex,$problem,$matches) !== false){
			if(isset($matches['first']) && isset($matches['operator']) && isset($matches['second'])){
				return $matches;
			}
		}
		return false;
	}
	
	
	/**
	 * use the WCMath class to calculate a problem
	 * @param int $first
	 * @param string $operator
	 * @param int second
	 * @return mixed
	 */
	public function calculate($first, $operator, $second){
		switch($operator){
			case '*': return $this->math->multiply($first,$second);
			case '+': return $this->math->add($first,$second);
			case '-': return $this->math->subtract($first,$second);
			case '/': return $this->math->divide($first,$second);
			default: return false;
		}
	}
	
}