<?php
session_start();
ob_start();

  require_once('conn.php');


   setcookie("members","0",-1,"/");


session_destroy();    ////// 세션 끝내기


?>

<script language="javascript">
 window.top.location.href ="../" ;
 // window.top.location.href ="../main.php?id=test" ;
</script>
