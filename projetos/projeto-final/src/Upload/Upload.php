<?php
namespace Code\Upload;


class Upload
{
	private $folder = '';

	public function setFolder($folder)
	{
		if(!is_dir($folder)) {
			mkdir($folder, 0777, true);
		}

		$this->folder = $folder;
	}

	public function doUpload($files = [])
	{
		$arrImagesName = [];
		for($i = 0; $i < count($files['name']); $i++) {
			$extension = strrchr( $files['name'][$i], '.');

			$newImageName = $this->renameImage($files['name'][$i]) . $extension;

			if(move_uploaded_file($files['tmp_name'][$i], $this->folder . $newImageName)) {
				$arrImagesName[] = $newImageName;
			}
		}

		return $arrImagesName;
 	}

	private function renameImage($imgName)
	{
		return sha1($imgName . uniqid() . time());
	}
}