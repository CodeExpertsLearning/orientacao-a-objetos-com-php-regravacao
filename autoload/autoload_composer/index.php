<?php
//require __DIR__ . '/class/JsonExport.php';
//require __DIR__ . '/class/XmlExport.php';

use Code\Export\{
	JsonExport,
	XmlExport
};

require __DIR__ . '/vendor/autoload.php';

//function autoload($class)
//{
//	$baseFolder = __DIR__ .'/src/';
//
//	$class = str_replace('\\', '/', $class);
//	require $baseFolder . $class . '.php';
//}

//spl_autoload_register('autoload');

if($_GET['export'] == 'xml')
	print (new XmlExport())->doExport();

if($_GET['export'] == 'json')
	print (new JsonExport())->doExport();

