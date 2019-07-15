<?php
$A = 100;
$n = $A - 1;
$s = '';

for ($i = 0; $i < $A; $i++)
{
	for ($j = 0; $j <= $n + $i; $j++)
		$s = ($j < $n - $i) ? $s . ' ': $s . '*';
	$s = $s . '\r\n';
}
echo("<script>console.log('".$s."');</script>");

?>