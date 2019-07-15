<pre>
<?php
$res;
$time1 = microtime(true);
for ($i = 0; $i < 100; $i++)
{
	$res[$i][0] = $i + 1;
	for ($j = 1; $j < 100; $j++)
		$res[$i][$j] = ($i+1)*($j+1);
}

//print_r ($res);
echo microtime(true) - $time1;
//$date = date_create('2000-01-01');

//echo date_format($date, 'Y-m-d H:i:s:u');
?>
</pre>