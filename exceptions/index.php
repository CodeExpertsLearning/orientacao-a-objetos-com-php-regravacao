<?php

use Code\Sum;

require __DIR__ . '/vendor/autoload.php';

try{

	$sum = new Sum();
	print $sum->doSum(10, 10); //30

} catch(\Error $e) {
	print_r($e->getTrace());
}catch (\Code\Exceptions\MyCustomException $e) {
	print $e->getMessage();
} finally {
	print 'Finally...';
}