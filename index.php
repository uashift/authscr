<?php
include_once('inc/cfg.php');
?>
<a href="./"><b><?=LNG_S_LOGO?></b></a><br>
<?php
if(!isset($_GET['error'])) $_GET['error'] = '';
else
{
	if($_GET['error'] == 'notfound')
	{
		echo LNG_LOGIN_WRONG.'<br>';
	}
	if($_GET['error'] == 'wrongpass')
	{
		echo LNG_PASSWORD_WRONG.'<br>';
	}
}
if(empty($_SESSION['login']))
{
	?>
	<form class="form" method="post" action="login.php">
	<input type="text" name="login" placeholder="<?=LNG_LOGIN?>"><br>
	<input type="password" name="password" placeholder="<?=LNG_PASSWORD?>"><br>
	<input type="submit" class="submit" value="<?=LNG_ENTER?>"><br>
	</form>
	<form class="form" action="register.php">
	<input type="submit" class="submit" value="<?=LNG_REGISTER?>">
	</form>
	<?php
}
else
{
	echo LNG_HELLO.' '.$_SESSION['login'].'<a style="float:right;" href="logout.php">'.LNG_EXIT.'</a><br>';
}
?>
<small>&copy; <?=CFG_COPY?> <?=CFG_DATE?></small>
</body>
</html>
