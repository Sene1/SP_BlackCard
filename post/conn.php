<?php
$connect=mysqli_connect("localhost","root",'');
mysqli_select_db($connect,'website');


function Error($msg){
echo "
 <script>
 window.alert('$msg');
 history.back(1);
 </script>
 ";
 exit; //위에 에러 메세지만 뛰운다.
}

///////////////회원정보 쿠키///////////////(8)
 function member(){
    global $connect;
    $tmp = $_COOKIE['members'] ?? NULL;
    $temp  = explode("//",$tmp);


///////////////회원정보/////////////// (9)

    $sql="select * from member where user_id='$temp[0]'";
    $result= mysqli_query($connect,$sql);
    $member= mysqli_fetch_assoc($result);
    return $member;

  }
  
  function card(){
	$str = $_POST['hakbun'] ?? NULL;
	$db = new PDO('mysql:host=localhost;dbname=website;', 'root', '');
	$sql = $db->prepare('SELECT * FROM `register` WHERE `hakbun`=:str');
	$sql->bindParam(":str", $str);
	$sql->execute();
	return $sql->fetchAll(PDO::FETCH_ASSOC);

  }
  
  function gcard(){
    global $connect;
	$str = $_POST["get_hakbun"];
	$sql = "SELECT * FROM `register` WHERE `hakbun`='{$str}'";
	$result= mysqli_query($connect,$sql);
	$records=mysqli_fetch_assoc($result);
    return $records;

  }
  
  function tcard(){
    global $connect;
	$str = $_POST["take_hakbun"];
	$sql = "SELECT * FROM `register` WHERE `hakbun`='{$str}'";
	$result= mysqli_query($connect,$sql);
	$records=mysqli_fetch_assoc($result);
    return $records;

  }


 ?>
