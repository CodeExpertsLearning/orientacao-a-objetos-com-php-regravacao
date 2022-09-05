<?php
namespace Code\Security\Validator;


class Validator
{
	public static function validateRequiredFields(array $data): bool
	{
		foreach($data as $key => $value) {
			if(is_null($data[$key])) {
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
}