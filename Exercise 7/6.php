<form action="6.php">
   <input name="param_name" />
   <button type="submit">Send</button>
</form>
<?php
$month = $_GET['param_name'];
if(!isSet($month))
	exit;
switch ($month)
{
case 12:
case 1:
case 2:
	echo("Это зима.");
break;
case 3:
case 4:
case 5:
	echo("Это весна.");
break;
case 6:
case 7:
case 8:
	echo("Это лето.");
break;
case 9:
case 10:
case 11:
	echo("Это осень.");
break;
default:
	echo("Такого месяца не существует");
break;
}
?>