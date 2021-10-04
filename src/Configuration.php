<?php
namespace Plott\JWT;

final class Configuration
{
	public function __construct(){}
	public static function builder()
	{
		return new Token\Builder();
	}

}