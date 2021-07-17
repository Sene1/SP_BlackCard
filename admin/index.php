<?php
require_once('../post/conn.php');

$member=member();
$card=card();

if(isset($member["user_id"])){
	if ($member["verify"] == 1) {
	echo "<script>location.href='/admin/get'</script>";
 } else {
	echo "<script>window.alert('아직 가입신청이 승인되지 않았습니다.');location.href='/member/signin'</script>"; }
	} else {
	echo "<script>location.href='/member/signin'</script>"; }?>