<?php 
session_start();

// session_unset('username');
// session_unset('logged_in');

session_destroy();

$id = "EMP001";
$arr = explode('EMP', $id);
// var_dump($arr);
echo ($arr[1]);

// header('location: login.php');
 ?>
