<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
echo "<script>window.alert('잘못된 접근입니다.');window.location.href='/';</script>";

error_reporting(E_ALL^ E_WARNING); 
session_start(); ob_start();
require_once('conn.php');

$ac_name=$_POST["accept_name"];
$hakbun=$_POST["hakbun"];
$name=$_POST["name"];
$email=$_POST["user_id"];
$date=$gcard["regdate"];

if(isset($_SESSION['tokn']) && $_POST['tokn'] == $_SESSION['tokn']) {

	$sql="DELETE FROM `member` WHERE `user_id`='$email'";
	$sql1="INSERT INTO `logs_reg` (`to`, `to_email`,`from`, `kind`) VALUES ('$hakbun', '$email', '$ac_name', '가입 거절')";
	mysqli_query($connect,$sql1);
	mysqli_query($connect,$sql);
	 echo  "<script>window.alert('가입신청을 거절했습니다.');window.location.href='/admin/regwait';</script>";
} else {
}


?>