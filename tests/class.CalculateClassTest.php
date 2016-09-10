<?php

use Mockery\Adapter\Phpunit\MockeryTestCase;

class TestCalculateClass extends MockeryTestCase {
	private $expected;
	
	public function setUp() {
		$this->expected = array(
			"first"=>"1",
			"operator"=>"+",
			"second"=>"1",
			0=> "1+1",
			1=>"1",
			2=>"+",
			3=>"1"
		);
	}
	
	public function testCanParseProblem(){
		$math = \Mockery::mock('MathClass');
		$math->shouldIgnoreMissing();
		$calculate = new CalculateClass($math);
		$params = $calculate->parse_problem("1+1");
		
		$this->assertEquals($this->expected,$params,"could not parse problem");
		
	}
	
	public function testCanParseMultiply(){
		$math = \Mockery::mock('MathClass');
		$math->shouldIgnoreMissing();
		
		$calculate = new CalculateClass($math);
		$params = $calculate->parse_problem("10*1");
		$this->expected = array(
			"first"=>"10",
			"operator"=>"*",
			"second"=>"1",
			0=> "10*1",
			1=>"10",
			2=>"*",
			3=>"1"
		);
		$this->assertEquals($this->expected,$params,"could not parse problem");
	
	}
	
	
	
}