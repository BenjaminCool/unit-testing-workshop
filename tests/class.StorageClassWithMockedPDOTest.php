<?php

use Mockery\Adapter\Phpunit\MockeryTestCase;
class StorageClassWithMockedPDOTest extends MockeryTestCase {
	
	public function setUp(){
		$stmt = null;
		$pdo = null;
	}
	
	public function testCanSaveAnswerToQuestion() {
		$stmt = \mockery::mock('PDOStatement');
		$stmt->shouldReceive('bindParam')->with(":question","2+2",PDO::PARAM_STR)->once()->andReturn(true);
		$stmt->shouldReceive('bindParam')->with(":answer",4,PDO::PARAM_STR)->once()->andReturn(true);
		$stmt->shouldReceive('execute')->once()->andReturn(true);
		$pdo = \Mockery::mock('PDO');
		$pdo->shouldReceive('prepare')->with("INSERT INTO question_answer VALUES (:question,:answer)")->once()->andReturn($stmt);
		$storage = new StorageClass($pdo);
		$good = $storage->save("2+2",4);
		$this->assertTrue($good,"pdo did not return as expected");
	}
	
	public function testCanGetAnswer() {
		$stmt = \mockery::mock('PDOStatement');
		$stmt->shouldReceive('execute')->with(array(":question"=>"1+1"))->once()->andReturn(true);
		$stmt->shouldReceive('fetchAll')->once()->andReturn(array(array(2)));
		$pdo = \Mockery::mock('PDO');
		$pdo->shouldReceive('prepare')->with("select answer from question_answer where question=:question;")->once()->andReturn($stmt);
		$storage = new StorageClass($pdo);
		$answer = $storage->get("1+1");
		$this->assertEquals(2,$answer,"answer was not expected to be $answer");
	}
	
	
	
	public function testCanGetFalseWhenAnswerNotFound() {
		$stmt = \mockery::mock('PDOStatement');
		$stmt->shouldReceive('execute')->with(array(":question"=>"2+2"))->once()->andReturn(true);
		$stmt->shouldReceive('fetchAll')->once()->andReturn(array());
		$pdo = \Mockery::mock('PDO');
		$pdo->shouldReceive('prepare')->with("select answer from question_answer where question=:question;")->once()->andReturn($stmt);
		$storage = new StorageClass($pdo);
		$answer = $storage->get("2+2");
		$this->assertFalse($answer,"answer was not false");
	}
	
}

