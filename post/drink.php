<?php

error_reporting(E_ALL^ E_WARNING); 
session_start(); ob_start();
require_once('conn.php');

$gcard=gcard();

$hakbun=$_POST["get_hakbun"];
$name=$_POST["get_name"];
$or_card=$gcard["card"];
$method=$_POST["method"];

if ($method !== 'POST') {
echo "<script>window.alert('잘못된 접근입니다.');window.location.href='/';</script>";
exit;}

if(isset($_SESSION['tokn']) && $_POST['tokn'] == $_SESSION['tokn']) {
	
	if(!$hakbun){
		Error("학번을 입력해주세요.");
	}


	if ($gcard["card"]-4 <= -1) {
		echo  "<script>window.alert('카드 갯수가 부족합니다.');window.location.href='/admin/gifts';</script>";
		exit;
	} else {
		$card=$gcard["card"]-4;
	}

	$sql=" select * from register where hakbun='$hakbun'";
	$result= mysqli_query($connect,$sql);
	$member= mysqli_fetch_assoc($result);

	if (empty($member)) {
	  echo  "<script>window.alert('존재하지 않는 학번입니다.');window.location.href='/admin/gifts';</script>";
	} else {
	$sql="UPDATE `register` SET `card` = $card WHERE `hakbun`=$hakbun";
	$sql1="INSERT INTO `logs` (`to`, `from`, `kind`, `amount`, `back`, `after`) VALUES ('$hakbun', '$name', '상품교환(음료수)', '4', '$or_card', '$card')";
	mysqli_query($connect,$sql1);
	mysqli_query($connect,$sql);
	 echo  "<script>window.alert('상품교환(음료수)을 완료 했습니다.');window.location.href='/admin/gifts';</script>";
	}
} else {
}

?>