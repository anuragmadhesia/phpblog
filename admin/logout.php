<?php
require_once('../includes/config.php');
$user->logout();
header('location:login.php');
?>