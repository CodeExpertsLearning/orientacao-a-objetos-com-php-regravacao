<?php
namespace Code\Security\Validator;


class Validator
{
	public static function validateRequiredFields(array $data): bool
	{
		foreach($data as $key => $value) {
			if(!$data[$key]) {
				return false;
				break;
			}
		}
		return true;
	}

	public static function validatePasswordConfirm($password, $confirmPassword): bool
	{
		return $password == $confirmPassword;
	}

	public static function validatePasswordMinStringLenght($string): bool
	{
		return strlen($string) >= 6;
	}

	public static function validateImagesFile($files = []): bool
	{
		  $isValideImages = true;
		  $allowedImagesFile = ['image/jpeg', 'image/png', 'image/jpg'];

		  for($i = 0; $i < count($files['type']); $i++) {
		  	if(!in_array($files['type'][$i], $allowedImagesFile)) {
		  		$isValideImages = false;
		    }
		  }

		  return $isValideImages;
	}
}