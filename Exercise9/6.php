<pre>
<?php
interface IMove
{
	public function getStatus();
	public function start();
	public function stop();
}

class Turtle implements IMove
{
	private $status;
	private $slp;
	public $ages;
	public function getStatus()
	{
		return $this->status==true? 'Движется':'Не движется';
	}
	public function start()
	{
		echo 'Черепаха пошла'.PHP_EOL;
		if($this->slp == true)
			sleeping();
		$status = true;

	}
	public function stop()
	{
		echo 'Черепаха встала'.PHP_EOL;
		if($this->slp == false)
			sleeping();
		$status = false;
	}
	public function sleeping()
	{
		$this->slp = !$this->slp;
		if($this->slp)
			echo 'Черепаха проснулась'.PHP_EOL;
		else
			echo 'Черепаха заснула'.PHP_EOL;
	}
}
abstract class Wings implements IMove{
	private $flying;
	private $status;
	public function getStatus()
	{
		return $this->status==true? 'Движется':'Не движется';
	}
	public function start()
	{
		$this->flying = true;
		$this->status = true;
		echo $this->getStatus().PHP_EOL;
	}
	public function stop()
	{
		$this->flying = false;
		$this->status = false;
		echo $this->getStatus().PHP_EOL;
	}
	public function TakeOff()
	{
		if($this->flying == false)
		{
			$this->flying = true;
			$this->status = true;
			echo "Взлетает".PHP_EOL;
		}
	}
	public function Land()
	{
		if($this->flying == true)
		{
			$this->flying = false;
			$this->status = false;
			echo "Садится".PHP_EOL;
		}
	}
	public function isFlying()
	{
		if($this->flying)
			echo "Летит".PHP_EOL;
		else
			echo "Стоит".PHP_EOL;
	}
}

class Airplane extends Wings
{
	private $name;
	public function getName()
	{
		return $this->name;
	}
		public function __construct($var)
	{
		$this->name = $var;
    }
}

class Bus implements IMove{
	private $status;
	public function getStatus()
	{
		return $this->status==true? 'Движется':'Не движется';
	}
	public function start()
	{
		echo 'Автобус поехал'.PHP_EOL;
		$this->status = true;
	}
	public function stop()
	{
		echo 'Автобус остановился'.PHP_EOL;
		$this->status = false;
	}
}
$myBus = new Bus();
echo $myBus->getStatus().PHP_EOL;
$myBus->start();
echo $myBus->getStatus().PHP_EOL;
$myBus->stop();
echo $myBus->getStatus().PHP_EOL;

$myPlane = new Airplane('истребитель844');
echo $myPlane->getName().PHP_EOL;
echo $myPlane->getStatus().PHP_EOL;
$myPlane->start();
echo $myPlane->getStatus().PHP_EOL;
$myPlane->stop();
$myPlane->isFlying();
$myPlane->Land();
$myPlane->TakeOff();
echo $myPlane->getStatus().PHP_EOL;


?>
</pre>