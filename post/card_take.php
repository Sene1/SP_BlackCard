<?php
error_reporting(E_ALL^ E_WARNING); 
session_start(); ob_start();
require_once('conn.php');
$tcard=tcard();

$hakbun=$_POST["take_hakbun"];
$number=$_POST["take_number"];
$or_num=$_POST["take_number"];
$name=$_POST["take_name"];
$card=$tcard["card"];
$method=$_POST["method"];

if ($method !== 'POST') {
echo "<script>window.alert('잘못된 접근입니다.');window.location.href='/';</script>";
exit;}

if(isset($_SESSION['tokn']) && $_POST['tokn'] == $_SESSION['tokn']) {
	
	if(empty($number)) {
		$number=$tcard["card"]-1;
		$or_num=1;
	} elseif ($number <= -1 ) {
		echo "<script>window.alert('자연수로 입력해주세요.');window.location.href='/admin/get';</script>";
		exit;
	} elseif ($number == 0 ) {
		echo "<script>window.alert('자연수로 입력해주세요.');window.location.href='/admin/get';</script>";
		exit;
	} else {
		$number=$tcard["card"]-$_POST["take_number"];
	}

	if ($number <= 0) {
		$number=0;
	} else {
		$number=$tcard["card"]-$_POST["take_number"];
	}

	//학번 입력
	if(!$hakbun)Error('학번을 입력해주세요.');

		  $sql=" select * from register where hakbun='$hakbun'";
		  $result= mysqli_query($connect,$sql);
		  $member= mysqli_fetch_assoc($result);
		  
		  if (empty($member)) {
			  echo  "<script>window.alert('존재하지 않는 학번입니다.');window.location.href='/admin/get';</script>";
		  } else {
			$sql="UPDATE `register` SET `card` = $number WHERE `hakbun`=$hakbun";
			$sql1="INSERT INTO `logs` (`to`, `from`, `kind`, `amount`, `back`, `after`) VALUES ('$hakbun', '$name', '카드 회수', '$or_num', '$card', '$number')";
			mysqli_query($connect,$sql1);
			mysqli_query($connect,$sql);
			 echo  "<script>window.alert('카드를 회수했습니다.');window.location.href='/admin/get';</script>";
		  }
} else {
}


?>