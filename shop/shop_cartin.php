<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
  print"<div class=t>";
  print'社員：　';
  print'<a href="member_login.html">ログイン</a><br />';
  print'<br />';
  print "</div>"; 
}
else
{
  print"<div class=t>";
  print'ログイン中　社員：';
  print $_SESSION['member_name'];
  print'<a href="member_logout.php">ログアウト</a><br />';
  print'<br />';
  print "</div>"; 
}
?>

<!DOCKTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>生魚発注</title>
<link rel="stylesheet" type="text/css" href="../css/shop_list.css">
</head>
<body>
<div class=h>
  
  <?php

try{
  
  $pro_code=$_GET['procode'];
  
if(isset($_SESSION['cart'])==true)

{
  $cart=$_SESSION['cart'];
  $kazu=$_SESSION['kazu'];
}

$cart[]=$pro_code;
$kazu[]=1;
$_SESSION['cart']=$cart;
$_SESSION['kazu']=$kazu; 


}
catch(Exception $e)
{
  print'只今障害により大変ご迷惑おかけしています。';
  exit();
}
?>

商品に追加しました。<br />
<br />
<a href="shop_list.php">商品一覧に戻る</a>

</div>
</body>
</html>