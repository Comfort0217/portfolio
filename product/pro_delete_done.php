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
    $pro_code=$_POST['code'];
    $pro_gazou_name=$_POST['gazou_name'];
    
    
    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql='DELETE FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $date[] = $pro_code;
    $stmt->execute($date);

    $dbh = null;

    if($pro_gazou_name!='')
    {
      unlink('./gazou/'.$pro_gazou_name);
    }

  
    }
    catch(Exception $e)

    {
    print'只今障害により大変ご迷惑おかけしています。';
    exit();
    }
    ?>
    <div class=h>
      削除しました。<br />
      <br /> 
      
      <a href="pro_list.php">戻る</a>
      
    </div>
</body>
</html>