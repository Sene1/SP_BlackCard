<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
echo "<script>window.alert('잘못된 접근입니다.');window.location.href='/';</script>";

error_reporting(E_ALL^ E_WARNING); 
session_start(); ob_start();
require_once('conn.php');

$check=$_POST["check"];
$hakbun=$_POST["hakbun"];
$user_id=$_POST["email"];
$pw=$_POST["pw"];
$pw_2=$_POST["pw_2"];
$name=$_POST["name"];

if(isset($_SESSION['tokn']) && $_POST['tokn'] == $_SESSION['tokn']) {
	
	
	
	//개인정보 처리방침 동의 확인
	if(!$check)Error('개인정보 처리방침에 동의 해야합니다.');
	//아이디 입력
	if(!$user_id)Error("아이디를 입력하세요.");


	if(!$pw)Error('비밀번호를 입력하세요');
	if(!$pw_2)Error('비밀번호를 한번더 입력하세요');

	if($pw!=$pw_2){
		Error("비밀번호가 서로 같지않습니다.");
	}


	 // 비밀번호 최초/최대길이값 (영문 숫자 허용)////
	if(!preg_match('/^[0-9A-Za-z~!@#$%^&*]{6,20}$/', $pw)) {
	   Error("비밀번호는 6~20자 까지 가능합니다.");
	}

	//이름 입력 채크
	if(!$name)Error('이름을 입력하세요');

	$name_1=$name;
	$name_2=$name;

	//이름입력시 최소길이 (한국어)2자부터;
	if(!$name_1 = substr($name,'4')){
		Error("이름은 한글2자~5자 까지입력하세요.");
	}


	//이름입력시 최대길이(한국어)5자까지;
	if($name_2 = substr($name,'15')){
		Error("이름은 한글2자~5자 까지입력하세요.");
	}

	//학번과 이름 확인
	$sql3 = "select * from `register` where name = '$name'";
	$result3 = mysqli_query($connect,$sql3);
	$row3=mysqli_fetch_assoc($result3);
	if($hakbun !== $row3['hakbun']){
		Error("이름과 학번을 다시 확인해주세요.");
	}

	//이미 가입된 학번인지 확인
	$sql4 = "select * from `member` where hakbun = '$hakbun'";
	$result4 = mysqli_query($connect,$sql4);
	$row4=mysqli_fetch_assoc($result4);
	if($hakbun == $row4['hakbun']){
		Error("이미 해당 정보로 가입된 계정이 있습니다.");
	}

	// 회원아이디 중복검사
		  $sql=" select * from member where user_id='$user_id'";
		  $result= mysqli_query($connect,$sql);
		  $member= mysqli_fetch_assoc($result);
		  if($user_id==$member["user_id"])Error('이미 가입된 이메일입니다.');

	$pw_hash=password_hash($pw, PASSWORD_DEFAULT);
	 
	$sql="insert into member(user_id,  pw, name, hakbun, regdate)
	values('$user_id', '$pw_hash', '$name', '$hakbun', now())";

	mysqli_query($connect,$sql);

	$_SESSION["user_id"]=$user_id;
} else {
	echo "<script>window.alert('잘못된 접근입니다.');window.location.href='/';</script>";
}

?>

<script>
window.alert('회원가입 신청이 완료되었습니다.');location.href='/';
</script>
