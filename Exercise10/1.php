<?php
$pass = 'firedragon';
$arr = array(array('md5', 0), array('sha1',0), array('crypt',0), array('password_hash PASSWORD_DEFAULT',0));


$time1 = microtime(true);
echo md5($pass).'<br>';
$time2 = microtime(true);
echo 'md5 '.($time2 - $time1).'<br><br>';
$arr[0][1] = $time2 - $time1;

$time1 = microtime(true);
echo password_hash($pass, PASSWORD_DEFAULT).'<br>';
$time2 = microtime(true);
echo 'password_hash PASSWORD_DEFAULT '.($time2 - $time1).'<br><br>';
$arr[1][1] = $time2 - $time1;

$time1 = microtime(true);
echo sha1($pass).'<br>';
$time2 = microtime(true);
echo 'sha1 '.($time2 - $time1).'<br><br>';
$arr[2][1] = $time2 - $time1;

$time1 = microtime(true);
echo crypt($pass, 'head').'<br>';
$time2 = microtime(true);
echo 'crypt '.($time2 - $time1).'<br><br>';
$arr[3][1] = $time2 - $time1;

print_r($arr);
echo '<br>';
function cmp($a, $b)
{
     if ($a[1] == $b[1]) {
        return 0;
    }
    return ($a[1] < $b[1]) ? -1 : 1;
}

usort($arr, 'cmp');
print_r($arr);
?>