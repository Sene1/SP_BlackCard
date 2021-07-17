<?php
require_once('../post/conn.php');

$member=member();
session_start();

$tokn = md5(uniqid(rand(), true)); // 매번 랜덤하게 생성될 보안인증 토큰
$_SESSION['tokn']=$tokn;

	if(empty($member["user_id"])){?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<title>계정 로그인</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="sub/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="sub/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="sub/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="sub/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="sub/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="sub/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="sub/css/util.css">
	<link rel="stylesheet" type="text/css" href="sub/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="sub/images/logo.jpg" alt="IMG">
				</div>

				<form  method="POST" action='/post/signin' class="login100-form validate-form">
					<span class="login100-form-title">
						계정 로그인
					</span>

					<div class="wrap-input100 validate-input" data-validate = "이메일 형식을 지켜주세요 ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="이메일">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "비밀번호를 입력해주세요">
						<input class="input100" type="password" name="pw" placeholder="비밀번호">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<input type='hidden' name='tokn' value='<?=$tokn?>'>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							로그인
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="/member/signup">
							가입된 계정이 없다면? 회원가입
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="sub/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="sub/vendor/bootstrap/js/popper.js"></script>
	<script src="sub/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="sub/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="sub/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="sub/js/main.js"></script>

</body>
</html>
	<?php } else {
	echo "<script>window.alert('이미 로그인된 정보가 있습니다.');location.href='/admin'</script>"; }?>