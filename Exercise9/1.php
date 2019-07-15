<pre>
<?php
class MyClass {
	private const a = 4;
	private $v;
	public function getA()
	{
		return self::a;
	}
	public function getVar()
	{
		return $this->v;
	}
	public function __construct($var)
	{
		$this->v = $var;
    }
}

class MyClass2 extends MyClass{
}

$newClass = new MyClass2(5);
echo $newClass->getA().PHP_EOL;
echo $newClass->getVar().PHP_EOL;
?>
</pre>