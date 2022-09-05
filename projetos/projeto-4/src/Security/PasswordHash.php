<?php
namespace Code\Security;


class PasswordHash
{
	public static function hash($string)
	{
		return password_hash($string, PASSWORD_ARGON2I);
	}

	public static function check($string, $passwordHashed)
	{
		return password_verify($string, $passwordHashed);
	}
}