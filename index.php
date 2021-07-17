<?php
require_once('post/conn.php');

$member=member();
$card=card();
	
?>
<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>신평고 - 블랙카드</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/popup.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="assets/js/jquery.bpopup-0.1.1.min.js"></script>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<span class="logo"><img src="images/icon.svg" alt="" /></span>
						<h1>블랙카드</h1>
						<p>블랙카드 제도<br />
						Made by <a href="https://dreamcoffee2.github.io/website/"> COMON</a>.</p>
					</header>

				<!-- Navi -->
					<nav id="nav">
						<ul>
							<li><a href="#Blackcard" class="active">소개</a></li>
							<li><a href="#Lunch">오늘의 급식</a></li>
							<li><a href="#HAB">블랙카드 조회</a></li>
							<?php
							  if(isset($member["user_id"])){
								?>
							<li><a href="/admin">관리</a></li>
							<?php } else { ?>
							<li><a href="/member/signin">관리</a></li>
							<?php } ?>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- What is Blackcard? -->
							<section id="Blackcard" class="main">
								<div class="spotlight">
									<div class="content">
										<header class="major">
											<h2>블랙카드 제도란?</h2>
										</header>
										<p>기준에 맞게 급식을 다 먹은 학생에게 블랙카드를 지급하고,<br /> 이를 상품으로 교환해주는
										신평고만의 제도로<br /> 사회적 문제인 음식물 쓰레기를 줄이는 효과를 가져올 수 있습니다.</p>
										<ul class="actions">
											<li><a href="#" class="button" id="my-button">교환가능 상품</a></li>
											<script>
											 ;(function($) {
												$(function() {
													
													$('#my-button').bind('click', function(e) {
														e.preventDefault();
														$('#element_to_pop_up').bPopup({
														   });

													});
													
												 });
											 })(jQuery);

											 </script>
											<!-- Element to pop up -->
											<div id="element_to_pop_up">
												<div class="visual">
													<img src="images/info.jpg" alt="" />
												</div>
											</div>
										</ul>
									</div>
									<span class="image"><img src="images/giftcard.png" alt="" /></span>
								</div>
							</section>

						<!-- Lunch! -->
							<section id="Lunch" class="main special">
								<header class="major">
									<h2>급식 메뉴</h2>
								</header>
								<ul class="features">
									<li>
										<span class="icon solid major style1 fa-drumstick-bite"></span>
										<h3><?php
											$today = date('Y년 m월 d일 중식');
											echo $today;?></h3>
										<p><?php
											$url = 'http://localhost/meal.php'; //급식 정보 불러오는 API 주소
											$json_string = file_get_contents($url);
											$R = json_decode($json_string, true); 

											$var1 = implode(' / ', $R['menus']);
											 if ( empty( $var1 ) ) { //급식 정보가 공백인 경우
												echo "<p>오늘은 급식을 제공하지 않습니다.</p>"; //급식 미제공 메세지 출력
											  } else { //급식 정보가 공백이 아닌 경우
												echo implode(' / ', $R['menus']); //급식 정보 표기
											  };
											 ?></p>
									</li>
								</ul>
								<footer class="major">
									<ul class="actions special">
										<li><a href="http://sp.cnehs.kr/foodList.do?m=040701&s=sp_h" class="button">월간 식단표</a></li>
									</ul>
								</footer>
							</section>
							
							<!-- Have a Blackcard -->
							<section id="HAB" class="main special">
								<header class="major">
									<h2>블랙카드 갯수 조회</h2>
									
									
								</header>
								<?php
									if (empty($card)) {
										echo "<p>존재하지 않는 학번입니다.</p>";
									} else {?>
									<div class="table-wrapper">
											<table>
												<thead>
													<tr>
														<th>이름</th>
														<th>학번</th>
														<th>보유 카드갯수</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>비공개</td>
														<?php foreach($card as $row) {?>
														<td><?=$row['hakbun']?></td>
														<td><?=$row["card"]?>개</td>
														<?php } ?>
													</tr>
												</tbody>
											</table>
										</div>
									<?php }?>
								
								<footer class="major">
									<form method="POST" action="#HAB">
									<div class="row gtr-uniform">
										<div class="col-6 col-12-xsmall aln-middle">
											<input type="text" name="hakbun" id="hakbun" value="" placeholder="학번을 입력해주세요." />
											<br />
											<input type="submit" name="submit" value="조회하기" class="button primary" />
										</div>
									</div>
									</form>
								</footer>
							</section>

					</div>

				<!-- Footer -->
					<footer id="footer">
						<section>
							<h2>정보</h2>
							<p>급식 메뉴는 <a href="https://stu.cne.go.kr/">"나이스 학생서비스"</a> 사이트에서 불러오는 것으로, 학교사정에 따라 급식메뉴가 변경 될 수 있습니다.</p>
							<ul class="actions">
								<li><a href="https://stu.cne.go.kr/sts_sci_md01_001.do" class="button">식단표 출처</a></li>
							</ul>
						</section>
						<section>
							<h2>학교 정보</h2>
							<dl class="alt">
								<dt>주소</dt>
								<dd>(31746) 충남 당진시 신평면 서해로 7076</dd>
								<dt>전화</dt>
								<dd>041-430-3004</dd>
							</dl>
							<ul class="icons">
								<li><a href="https://www.facebook.com/sphsstucouncil/" class="icon brands fa-facebook-f alt"><span class="label">Facebook</span></a></li>
								<li><a href="https://www.instagram.com/sphsstudents" class="icon brands fa-instagram alt"><span class="label">Instagram</span></a></li>
								<li><a href="http://sp.cnehs.kr/" class="icon solid fa-school alt"><span class="label">School</span></a></li>
								<?php
								  if(isset($member["user_id"])){
									?>
								<li><a href="/admin" class="icon solid fa-wrench alt"><span class="label">Settings</span></a></li>
								<?php } else { ?>
								<li><a href="/member/signin" class="icon solid fa-wrench alt"><span class="label">Settings</span></a></li>
								<?php } ?>
							</ul>
						</section>
						<p class="copyright">&copy; COMON. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
			<script src="assets/js/jquery.bpopup-0.1.1.min.js"></script>

	</body>
</html>