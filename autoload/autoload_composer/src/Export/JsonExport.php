<?php
namespace Code\Export;

use Code\Export\Contract\Export;

class JsonExport implements Export
{
	public function doExport()
	{
		return 'Json Exported';
	}
}