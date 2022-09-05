<?php

class Html
{
	public static $mainTag = '<html>';

	const END_TAG = '</html>';

	public static function openTagHtml()
	{
		return self::$mainTag;
	}

	public static function endTagHtml()
	{
		return self::END_TAG;
	}
}

print Html::openTagHtml();
print "\n";
print Html::endTagHtml();
print "\n";
print Html::$mainTag;
print "\n";
print Html::END_TAG;