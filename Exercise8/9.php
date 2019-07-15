<pre>
<?php
if(!file_exists('../tree'))
	mkdir('../tree');

function fun($path)
{
	echo '<li>'.'&#128194;'.basename($path).'<ul>';
	$dir = scandir($path);
	
	foreach ($dir as $val)
	{
		if(is_dir($path.'/'.$val)&&$val != '.'&&$val != '..')
		{
			fun($path.'/'.$val);
		}
		else if(!is_dir($path.'/'.$val))
			echo '<li>'.$val.'</li>';
	}
	echo '</ul>'.'</li>';
}

echo '<ul>';
fun('../tree', 0);
echo '</ul>';

?>
</pre>