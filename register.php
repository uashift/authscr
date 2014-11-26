<?php
include_once('inc/cfg.php');
?>
<a href="./"><b><?=LNG_S_LOGO?></b></a><br>
<?php
if(!isset($_GET['process'])) $_GET['process'] = '';
else
{
	$lfu = mysql_query("
		SELECT *
		FROM user
		WHERE login='".$_POST['login']."'");
	if(empty($_POST['sex'])) $_POST['sex'] = 'other';
	if(empty($_POST['login']) OR strlen($_POST['login']) < 3)
	{
		echo LNG_LOGIN_SHORT.'<br>';
	}
	elseif(mysql_num_rows($lfu) !== 0)
	{
		echo LNG_LOGIN_EXISTS.'<br>';
	}
	elseif(empty($_POST['password']) OR strlen($_POST['password']) < 6)
	{
		echo LNG_PASSWORD_SHORT.'<br>';
	}
	elseif($_POST['password'] !== $_POST['passwordagain'])
	{
		echo LNG_PASSWORD_NOT_MATCH.'<br>';
	}
	elseif(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
	{
		echo LNG_MAIL_WRONG.'<br>';
	}
	else
	{
		$mreg = mysql_query("
			INSERT INTO `user`
			(`login`, `phash`, `mail`, `sex`, `rdate`, `rtime`, `ip`)
			VALUES(
			'".addslashes($_POST['login'])."',
			'".md5($_POST['password'])."',
			'".addslashes($_POST['mail'])."',
			'".addslashes($_POST['sex'])."',
			'".date('d,m,Y')."',
			'".date('H:i:s')."',
			'".$_SERVER['REMOTE_ADDR']."')");
		if(!$mreg)
		{
			echo mysql_error().'<br>';
		}
		else
		{
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['password'] = md5($_POST['password']);
			echo '<script>location="index.php";</script>';
		}
	}
}
?>
<form method="post" action="register.php?process">
<input type="text" name="login" placeholder="<?=LNG_LOGIN?>"><br>
<input type="password" name="password" placeholder="<?=LNG_PASSWORD?>"><br>
<input type="password" name="passwordagain" placeholder="<?=LNG_PASSWORD_AGAIN?>"><br>
<input type="text" name="mail" placeholder="<?=LNG_MAIL?>"><br>
<input type="radio" name="sex" value="man"><b><?=LNG_MAN?></b><br>
<input type="radio" name="sex" value="woman"><b><?=LNG_WOMAN?></b><br>
<input type="submit" class="submit" value="<?=LNG_REGISTER?>"><br>
</form>
<?=LNG_REG_DESC?><br>
<small>&copy; <?=CFG_COPY?> <?=CFG_DATE?></small>
</body>
</html>
