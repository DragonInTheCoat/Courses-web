<pre>
<?php
include_once '7.php';
class MessClass extends SessionMessages
{
	public function printByType($type)
	{
		$this->printArr($this->getMessages($type));
	}
}
echo '====================='.PHP_EOL;
$myclass = new MessClass();
$myclass->setMessage('pony', 'Pinky Pie');
$myclass->setMessage('pony', 'Rarity');
$myclass->setMessage('pony', 'Rainbow Dash');
$myclass->setMessage('parrot', 'Tiki');
$myclass->setMessage('parrot', 'Chack');
$myclass->setMessage('parrot', 'Loff');
$myclass->setMessage('cat', 'mur');
$myclass->setMessage('cat', 'nya');
echo $myclass->hasMessage('cat').PHP_EOL;
$myclass->printArr($myclass->getArr());
$myclass->printByType('cat');
echo $myclass->hasMessage('cat').PHP_EOL;
$myclass->printArr($myclass->getArr());
?>
</pre>