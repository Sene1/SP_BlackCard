<?php
require_once('../post/conn.php');

session_start();

$tokn = md5(uniqid(rand(), true)); // 매번 랜덤하게 생성될 보안인증 토큰
$_SESSION['tokn']=$tokn;

$member=member();
	if(empty($member["user_id"])){?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>계정 만들기</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="sub2/fonts/material-icon/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Main css -->
    <link rel="stylesheet" href="sub2/css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action='/post/signup' id="signup" class="signup">
                        <h2 class="form-title">계정 생성</h2>
						<div class="alert alert-info"><strong><i class="fas fa-bullhorn"></i></strong>⠀일반 학생은 이 서비스를 가입하지 않아도 이용할 수 있습니다.</div>
						<div class="form-group">
                            <input type="number" class="form-input" name="hakbun" minlength="4" maxlength="4" id="hakbun" placeholder="학번"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="이름"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="이메일"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="pw" id="password" placeholder="비밀번호"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="pw_2" id="re_password" placeholder="비밀번호 확인"/>
							<span toggle="#re_password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="check" onclick="checkall(this)" value="check_OK" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span><a href="/member/privacy" onclick="window.open(this.href, '_blank', 'width=700, height=350'); return false;" class="term-service">개인정보 취급방침</a>에 동의합니다.</label>
                        </div>
                        <div class="form-group">
							<input type='hidden' name='tokn' value='<?=$tokn?>'>
                            <input type="submit" name="submit" id="submit" class="form-submit" value="계정 생성"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        이미 계정이 있다면? <a href="/member/signin" class="loginhere-link">로그인</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="sub2/vendor/jquery/jquery.min.js"></script>
    <script src="sub2/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
	<?php } else {
	echo "<script>window.alert('이미 로그인된 정보가 있습니다.');location.href='/admin'</script>"; }?>