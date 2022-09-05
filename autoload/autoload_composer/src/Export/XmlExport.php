<?php
namespace Code\Export;

use Code\Export\Contract\Export;

class XmlExport implements Export
{
	public function doExport()
	{
		return 'Xml exported!';
	}
}