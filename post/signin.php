<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
echo "<script>window.alert('잘못된 접근입니다.');window.location.href='/';</script>";

session_start(); ob_start();
require_once('conn.php');

$user_id= $_POST["email"];
$pw= $_POST["pw"];

if(isset($_SESSION['tokn']) && $_POST['tokn'] == $_SESSION['tokn']) {
	
	if(!$user_id){
		Error("아이디를 입력하세요.");
	}


	if(!$pw){
		 Error("비밀번호를 입력하세요.");
	}
	
	
	// 나의 정보 데이터 가지고 오기
	
	$db = new PDO('mysql:host=localhost;dbname=website;', 'root', '');
	$sql = $db->prepare('SELECT * FROM `member` WHERE `user_id`=:str');
	$sql->bindParam(":str", $user_id);
	$sql->execute();
	$result = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count = $sql->fetchColumn();
	
	if (count($result) == 0) {
		echo "<script>window.alert('가입하지 않은 아이디이거나, 잘못된 비밀번호입니다.');window.location.href='/member/signin';</script>";
	} else {
		foreach($result as $member) {
			if($member["user_id"] == $user_id){
				if (password_verify($pw, $member["pw"])){
					$tmp=$member["user_id"]."//".$member["pw"];
					setcookie("members",$tmp,time()+60*60*2,"/" );  //2시간동안 유효
					$_SESSION["user_id"] = $member["user_id"];
					$_SESSION["id"] = $member["id"];
					$_SESSION["id"] = $member["verify"];
				} else {
					echo "<script>window.alert('가입하지 않은 아이디이거나, 잘못된 비밀번호입니다.');window.location.href='/member/signin';</script>";
					}
			} else {
				echo "<script>window.alert('가입하지 않은 아이디이거나, 잘못된 비밀번호입니다.');window.location.href='/member/signin';</script>";
			}
		}
	}
} else {
	echo "<script>window.alert('잘못된 접근입니다.');window.location.href='/';</script>";
}

?>

<script>
location.href='/admin';
</script>
