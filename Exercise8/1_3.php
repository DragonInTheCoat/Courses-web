<?php
if (!empty($_GET['a'])
	exit();
$a = $_GET['a'];
$k = 0;
while($a>0)
{
	$k = $a%10 + $k*10;
	$a = floor($a/10);
}
echo $k;
?>