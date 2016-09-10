<?php

class FactoryClass {

	public function MathClass(){
		return new MathClass();
	}
	
	public function CalculateClass($mathclass){
		return new CalculateClass($mathclass);
	}

}