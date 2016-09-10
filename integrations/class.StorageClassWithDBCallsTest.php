<?php


class TestStorageClassWithDBCalls extends PHPUnit_Extensions_Database_TestCase {
	
	private $pdo;
	
	/**
	 * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
	 */
	public function getConnection()
	{
		if (null === $this->pdo) {
			$this->pdo = new PDO('sqlite::memory:');
			$this->pdo->exec("
				CREATE TABLE question_answer (
					`question` TEXT PRIMARY KEY,
					`answer` FLOAT
				);");
			
		}
		return $this->createDefaultDBConnection($this->pdo, ':memory:');
	}

    /**
	 * @return PHPUnit_Extensions_Database_DataSet_IDataSet
	 */
	public function getDataSet()
	{
		$dataSet = new PHPUnit_Extensions_Database_Dataset_CsvDataSet();
		$dataSet->addTable("question_answer", __DIR__ . "/data.csv");
		return $dataSet;
	}
	
	public function setUp () {
		parent::setUp();
		$pdo = $this->getConnection()->getConnection();
	}
	
	public function testCanGetAnswer(){
		$storage = new StorageClass($this->pdo);
		$answer = $storage->get("1+1");
		$this->assertEquals(2,$answer,"answer was not expected to be $answer");
	}
	
	public function testCanSaveAnswerToQuestion(){
		$storage = new StorageClass($this->pdo);
		$storage->save("2+2",4);
		$answer = $storage->get("2+2");
		$this->assertEquals(4,$answer,"answer was not expected to be $answer");
	}
	
	public function testCanGetFalseWhenAnswerNotFound(){
		$storage = new StorageClass($this->pdo);
		$answer = $storage->get("2+2");
		$this->assertFalse($answer,"answer was not false");
	}
	
}

