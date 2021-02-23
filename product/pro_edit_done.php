<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
  print'ログインされていません。<br />';
  print'<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
  exit();
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

  <?php
  
  try
  {

    require_once('../common/common.php');

    $post=sanitize($_POST);
    $pro_code=$post['code'];
    $pro_name=$post['name'];
    $pro_price=$post['price'];
    $pro_gazou_name_old=$post['gazou_name_old'];
    $pro_gazou_name=$post['gazou_name'];


    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql='UPDATE mst_product SET name=?,price=?, gazou=? WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $date[] = $pro_name;
    $date[] = $pro_price;
    $date[] = $pro_gazou_name;
    $date[] = $pro_code;

    $stmt->execute($date);

    $dbh = null;

    if($pro_gazou_name_old!=$pro_gazou_name)
    {
      if($pro_gazou_name_old!='')
      {
        unlink('./gazou/'.$pro_gazou_name_old);
      }
    }  
    
    print'<div class=h>';
    print $pro_name;
    print'修正しました。<br />';
    
  }
  catch(Exception $e)
  
    {
      print'只今障害により大変ご迷惑おかけしています。';
      exit();
    }
    
    ?>

<a href="pro_list.php">戻る</a>
</div>

</body>
</html>