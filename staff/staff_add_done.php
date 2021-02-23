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
    $staff_name=$post['name'];
    $staff_pass=$post['pass'];
    
    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql='INSERT INTO mst_staff(name,password) VALUES(?,?)';
    $stmt = $dbh->prepare($sql);
    $date[] = $staff_name;
    $date[] = $staff_pass;
    $stmt->execute($date);

    $dbh = null;

    print'<div class=h>';
    print$staff_name;
    print'を追加しました。<br />';
    
  }
  catch(Exception $e)
  
  {
    print'只今障害により大変ご迷惑おかけしています。';
    exit();
  }
  
  ?>

<a href="staff_list.php">戻る</a>
</div>

</body>
</html>