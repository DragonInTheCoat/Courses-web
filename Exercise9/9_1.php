<pre>
<?php
include_once '9.php';
class Cinema extends Hall implements IEntertainment
{
	private $isOpened;
	public function __construct($name, $chairsCount)
	{
		$this->chairsCount = $chairsCount;
		$this->name = $name;
	}
	public function open()
	{
		$isOpened = true;
	}
	public function close()
	{
		$isOpened = false;
	}
	public function status()
	{
		if($isOpened)
			echo 'открыто';
		else
			echo 'закрыто';
	}
	
	public function getTicketPrice($showID)
	{
		if(isset($this->arrShows[$showID]))
			return $this->arrShows[$showID]->price;
	}

	public function getShow($showID)
	{
		if(isset($this->arrShows[$showID]))
			return $this->arrShows[$showID];
	}

}
//=====================================
$hall = new Cinema('name1',400);
$hall->setShow('0','bird', 10, 20, 100);
$hall->setShow('1','bird1', 30, 40, 100);
$hall->setShow('2','bird2', 50, 60, 100);
$hall->setShow('3','bird3', 70, 80, 100);
$hall->setShow('4','bird4', 10, 20, 100);

$hall->showInfo();

?>
</pre>