<pre>
<?php
$res = '';

for ($i = 1; $i < 10; $i++)
{
	$res .= ' '.$i;
	for ($j = 2, $k = $i*$j; $j < 11; $j++, $k = $i*$j)
		$res .= (floor($k / 10) == 0) ? '   ' . $k: '  ' . $k;
	$res = $res . PHP_EOL;
}

$res .= 10;
for ($i = 2; $i < 10; $i++)
	$res .= '  ' . $i*10;
	
$res .= ' ' . 100;

echo ($res);

?>
</pre>