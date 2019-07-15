<pre>
<?php
trait Printer
{
	public function printArr($arr)
	{
		print_r($arr);
	}
}
class SessionMessages {
	private $mesArr;
	use Printer;
	public function __construct()
	{
		session_start();
    }
	public function getMessages($type)
	{
		$tmpArr = $this->mesArr;
		unset($this->mesArr[$type]);
		return $tmpArr[$type];
	}
	public function getArr()
	{
		return $this->mesArr;
	}
	public function	setMessage($type, $message)
	{
		$this->mesArr[$type][] = $message;
	}
	public function hasMessage($type)
	{
		return isset($this->mesArr[$type])?'true':'false';
	}
}

?>
</pre>