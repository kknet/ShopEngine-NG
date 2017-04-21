<?php
namespace mpdf;

class config{
	/**
	 * [$_config массив с настройками]
	 * @var array
	 */
	static private $_config = [
		"blackberry" => [
			"site" => "blackberry-russia",
			"apiKey" => "25f2b3fe06b5539c12e57ad04d462cc1",
			"apiPass" => "db23aec8886996f5281a348accb42021",
		],
		"poterpite" => [
			"site" => "poterpite",
			"apiKey" => "116eaacd3f359afcb7803c2b0aace273",
			"apiPass" => "c743a8baf1f2f3d220d31f7865a5b082",
		],
		"brandport" => [
			"site" => "brandport",
			"apiKey" => "197e56bb7a05ddf2bafed0834d1b8566",
			"apiPass" => "375c56518b0d4577d53efa62203420f9",
		],
	];

	public static function get($site, $name){
		return self::$_config[$site][$name];
	}
}
?>