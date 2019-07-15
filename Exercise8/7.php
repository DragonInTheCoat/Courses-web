<pre>
<?php
if(!file_exists('../tree'))
	mkdir('../tree');

function fun($path)
{
	$dir = dir($path);
	$file;
	//echo $path.PHP_EOL;
	while (false !== ($entry = $dir->read()))
	{
		//echo $entry.PHP_EOL;
		if(is_dir($path.'/'.$entry)&&$entry != '.'&&$entry != '..')
			fun($path.'/'.$entry);
	}

	/*while(file_exists($path."/folder".$n))
		$n++;*/
	//echo $path;
	$file = tempnam($path , 'file');
	$date = time();
	chmod($file, 0777);
	$handle = fopen($file, "w+");
	fwrite($handle , date('d-M-Y H:i:s', $date).PHP_EOL);
	fwrite($handle , substr(str_replace('/',', ',$file), 2));
	echo $file.PHP_EOL;
	//mkdir($path."/folder".$n);
	fclose($handle);
	$dir->close();
	//echo 'finish'.PHP_EOL;
}
fun('../tree');
?>
</pre>