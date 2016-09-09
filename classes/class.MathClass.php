<?php

class MathClass {
	
	public function add($first,$second)	{
		return $first+$second;
	}
	
	public function subtract($first,$second)	{
		return $first-$second;
	}
	
	public function multiply($first,$second)	{
		return $first*$second;
	}
	
	public function divide($first,$second)	{
		if($second == 0){
			return false;
		}
		return $first/$second;
	}
	
}