<pre>
<?php
$res = 0;
$days = 365;
$date = strtotime('2019-01-01 first Sunday');
echo date('d-M-Y',$date).PHP_EOL;
if(date('L',$date) != '1')
	$days = 366;
$res = floor(($days - date('d',$date))/7) + 1;
echo $res.PHP_EOL;
?>
</pre>