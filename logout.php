<?php
session_name('SID');
session_start();
session_unset();
session_destroy();
header('Location:index.php');
?>
