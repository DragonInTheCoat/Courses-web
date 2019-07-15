<?php
$a = $_GET['a'];
$k = 0;
while($a > 0)
{
	if ($a%10 == 5)
		++$k;
	$a = floor($a/10);
}

echo $k;
?>