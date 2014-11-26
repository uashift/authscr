<?php
session_name('SID');
session_start();
include_once('/inc/cfg.php');
$l = addslashes($_POST['login']);
$p = md5($_POST['password']);

$result = mysql_query("
			SELECT login, phash
			FROM   user
			WHERE  login = '$l'");

if (!$result) {
    echo '<b>MYSQL ERROR</b>: <pre>'. mysql_error().'</pre>';
    exit;
}

if (mysql_num_rows($result) == 0) {
	echo '<script>location = "index.php?error=notfound";</script>';
    exit;
}

$row = mysql_fetch_assoc($result);

	if($row['phash'] == $p)
	{
		$_SESSION['login'] = $row['login'];
		$_SESSION['password'] = $row['phash'];
		echo '<script>location = "index.php";</script>';
	}
	else
	echo '<script>location = "index.php?error=wrongpass";</script>';

?>
