<?php

use Mockery\Adapter\Phpunit\MockeryTestCase;

class TestMathClass extends MockeryTestCase {

	public function setUp() {
		
	}
	
	public function testCanInstantiateMathClass(){
		$math = new MathClass();
		$this->assertInstanceOf('MathClass',$math,'$math is not of type MathClass');
		return $math;
	}
	
	/**
	 * test that the add function works
	 * @depends testCanInstantiateMathClass
	 */
	public function testCanAdd($math){
		$expected = 52;
		$answer = $math->add(48,4);
		$this->assertEquals($expected,$answer,'Answer does not match the expected');
	}
	
	/**
	 * test that the add function works
	 * @depends testCanInstantiateMathClass
	 */
	public function testCanSubtract($math){
		$expected = 3;
		$answer = $math->subtract(48,45);
		$this->assertEquals($expected,$answer,'Subtraction did not work');
	}
	
	/**
	 * test that the add function works
	 * @depends testCanInstantiateMathClass
	 */
	public function testCanMultiply($math){
		$expected = 36;
		$answer = $math->multiply(12,3);
		$this->assertEquals($expected,$answer,'Answer does not match the expected');
	}
	
	/**
	 * test that the add function works
	 * @depends testCanInstantiateMathClass
	 */
	public function testCanDivide($math){
		$expected = 4;
		$answer = $math->divide(12,3);
		$this->assertEquals($expected,$answer,'Answer does not match the expected');
	}
	
	/**
	 * test that the add function works
	 * @depends testCanInstantiateMathClass
	 */
	public function testCannotDivideZero($math){
		$answer = $math->divide(48,0);
		$this->assertFalse($answer,'Answer does not match the expected');
	}
}