<?php
//require __DIR__ . '/class/JsonExport.php';
//require __DIR__ . '/class/XmlExport.php';

function autoload($class)
{
	require __DIR__ . '/class/'. $class .'.php';
}

spl_autoload_register('autoload');

if($_GET['export'] == 'xml')
	print (new XmlExport())->doExport();

if($_GET['export'] == 'json')
	print (new JsonExport())->doExport();

