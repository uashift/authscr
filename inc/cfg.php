<?php
session_name('SID');
session_start();
define('DB_HOST', 'localhost'); //DATABASE HOST
define('DB_USER', 'adm'); // DATABASE USER
define('DB_PASS', 'adm'); // DATABASE PASSWORD
define('DB_NAME', 'vote'); // DATABASE NAME
define('DB_PRE', ''); // DATABASE TABLE PREFIX
define('SITE_LNG', 'ru'); // LANGUAGE FILE
define('CFG_COPY', 'SHiFT'); // COPY
##### ESTABLISHED
define('C_DATE', '2012'); // COPY
if(C_DATE == date('Y'))
{
	define('CFG_DATE', date('Y')); // COPY DATE
}
else
{
	define('CFG_DATE', C_DATE.' - '.date('Y')); // COPY DATE
}
##### DB CONNECT
$db_connect = mysql_connect(DB_HOST,DB_USER,DB_PASS);
if(!$db_connect) die('Error connecting to db :(');
else mysql_select_db(DB_NAME);
// LANGUAGES
$lng = json_decode(file_get_contents('inc/'.SITE_LNG.'.lng'), true);
foreach($lng as $k => $v)
{
define('LNG_'.$k, $v);
}
// MySQL INSERT FUNCTION
function mysql_insert($table, $inserts)
{
	$values = array_map('mysql_real_escape_string', array_values($inserts));
	$keys = array_keys($inserts);
	return mysql_query('INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')');
}
// GENERATE CODE FUNCTION
  function genC($length=6) { 
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789"; 
    $code = ""; 
    $clen = strlen($chars) - 1;   
    while (strlen($code) < $length) { 
        $code .= $chars[mt_rand(0,$clen)];   
    } 
    return $code; 
  }
if(!empty($_SESSION['login']))
{
	$squ = mysql_query("
	SELECT *
	FROM `user`
	WHERE `login` = '".$_SESSION['login']."'");
	if(!$squ) die(mysql_error());
	else {$data = mysql_fetch_assoc($squ);}
}
$sqall = mysql_query("
	SELECT *
	FROM user");
$news = mysql_query("
	SELECT *
	FROM news
	ORDER BY added_d,added_t");
$all_registered = mysql_num_rows($sqall);
