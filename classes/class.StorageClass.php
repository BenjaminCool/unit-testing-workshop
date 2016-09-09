<?php

class StorageClass {
	private $pdo;
	
	public function __construct(PDO $pdo){
		$this->pdo = $pdo;
	}
	
	public function get($question){
		$stmt = $this->pdo->prepare("select answer from question_answer where question=:question;");
		try {
			$stmt->execute(array(":question"=>$question));
			$rows = $stmt->fetchAll();
			if(count($rows) > 0){
				$answer = $rows[0];
				return $answer[0];
			}
			else{
				return false;
			}
		}
		catch( PDOException $e ) {
			return false;
		}
	}
	
	public function save($question,$answer){
		$stmt = $this->pdo->prepare("INSERT INTO question_answer VALUES (:question,:answer)");
		try {
			$stmt->bindParam(":question",$question,PDO::PARAM_STR);
			$stmt->bindParam(":answer",$answer,PDO::PARAM_STR);
			$stmt->execute();
		}
		catch( PDOException $e ) {
			return false;
		}
		return true;
	}
}