<pre>
<?php
interface IEntertainment
{
	public function open();
	public function close();
	public function getTicketPrice($show);
	public function status();
}
abstract class Hall
{
	private $chairsCount;
	private $name;
	protected $arrShows = array();
	public function showInfo()
	{
		print_r($this->arrShows);
	}
	public function getChairsCount()
	{
		return $this->chairsCount;
	}
	public function getName()
	{
		return $this->name;
	}
	public function setShow($showID,$name, $start, $end, $price)
	{
		echo $name.PHP_EOL;
		if($this->checkShowTime($start, $end))
			$this->arrShows[$showID] = new Show($name, $start, $end, $price);
		else
			$this->arrShows[$showID] = new Show($name, '', '', $price);
	}
	public function checkShowTime($start, $end)
	{
		foreach($this->arrShows as $v)
		{
			if($v->getBegin() >= $start && $v->getEnd() <= $end)
			{
				echo 'Выбрано неподходящее время'.PHP_EOL;
				return false;
			}
		}
		return true;
	}
}

class Show
{
	private $timeBegin;
	private $timeEnd;
	private $kind;
	private $price;
	public $name;

	public function setPrice($n)
	{
		if(is_numeric($n) && $n > 0)
			$this->price = $n;
	}
	public function getInfo()
	{
		echo $this->name . PHP_EOL;
		echo $this->getBegin().PHP_EOL;
		echo $this->getEnd().PHP_EOL;
		echo $this->getPrice().PHP_EOL;
	}
	public function getPrice()
	{
		return $this->price;
	}
	public function  __construct($name, $start, $end, $price)
	{
		$this->name = $name;
		$this->setBegin($start);
		$this->setEnd($end);
		$this->setPrice($price);
		//$this->numberHall = this->setHall($nhall);
	}
	public function setBegin($timeBegin)
	{
		if(is_numeric($timeBegin) && $timeBegin > 0)
			$this->timeBegin = $timeBegin;
		else 'Некорректное время начала'.PHP_EOL;
	}
	public function setEnd($timeEnd)
	{
		if(is_numeric($timeEnd) && $this->timeBegin < $timeEnd)
			$this->timeEnd = $timeEnd;
		else 'Некорректное время окончания'.PHP_EOL;
	}
	public function getBegin()
	{
		return $this->timeBegin;
	}
	public function getEnd()
	{
		return $this->timeEnd;
	}
	public function setKind($var)
	{
		$this->kind = $var;
	}
	public function getKind()
	{
		return $this->kind;
	}
}

?>
</pre>