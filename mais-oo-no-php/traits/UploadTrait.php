<?php

trait UploadTrait
{
	public function doUpload($file)
	{
		return true;
	}
}

class Product
{
	use UploadTrait;
}

class Profile
{
	use UploadTrait;
}

$p = new Product();
print $p->doUpload('arquivo...');

print '<br>';

$pr = new Profile();
print $pr->doUpload('arquivo...');
