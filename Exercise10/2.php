<?php
class Log
{
	private $f;
	public function __construct($prefix = 'test')
	{
		if(!file_exists('../log'))
			mkdir('../log');
		$this->f = '../log/' . $prefix . '_' . date('Ymd') . '.log';
		if(!file_exists($this->f))
		{
			$handle = fopen($this->f, 'w');
			fclose($handle);
		}
	}
	
	public function writeLog($str)
	{
		file_put_contents($this->f, $str . PHP_EOL, FILE_APPEND);
	}
}

$a = new Log('Log1');
$a->writeLog('some information');
?>