<?php
$a = $_GET['a'];
$k = $a%10;
while($a>0)
{
	$a = floor($a/10);
	if($k<$a%10)
		$k=$a%10;
}
echo $k;
?>