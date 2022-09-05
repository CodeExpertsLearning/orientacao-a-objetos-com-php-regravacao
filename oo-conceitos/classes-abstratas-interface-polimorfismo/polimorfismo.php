<?php

abstract class Printer
{
	public function toPrint()
	{
		return "Printing data...";
	}
}

class HpPrinter extends Printer
{
	public function toPrint()
	{
		return "HP printing data...";
	}
}

class EpsonPrinter extends Printer
{
	public function toPrint()
	{
		return "Epson printing data...";
	}
}

$printer = new EpsonPrinter();
print $printer->toPrint();