<pre>
<?php
if(!file_exists('../tree'))
	mkdir('../tree');

function fun($path, $n)
{
	$dir = dir($path);
	//echo $path.PHP_EOL;
	while (false !== ($entry = $dir->read()))
	{
		echo $entry.PHP_EOL;
		if(is_dir($path.'/'.$entry)&&$entry != '.'&&$entry != '..')
			fun($path.'/'.$entry,$n + 1);
	}
	$r = rand(0,100);
	echo $r;
	if($r <=70)
	{
		while(file_exists($path."/folder".$n))
			$n++;
		mkdir($path."/folder".$n);
	}
	$dir->close();
	echo 'finish';
}
fun('../tree', 0);
?>
</pre>