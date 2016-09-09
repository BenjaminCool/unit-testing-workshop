<?php

require_once 'vendor/autoload.php';
function test_classes_autoload ($classname) {
	$filename = __DIR__."/class.{$classname}.php";
	if(file_exists($filename)) {
		require_once $filename;
	}	
}
spl_autoload_register('test_classes_autoload');