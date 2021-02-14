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

try{

  $pro_code=$_GET['procode'];

  $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
  $user='root';
  $password='';
  $dbh=new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql='SELECT name,gazou FROM mst_product WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[]=$pro_code;
  $stmt->execute($data);

  $rec=$stmt->fetch(PDO::FETCH_ASSOC);
  $pro_name=$rec['name'];
  $pro_gazou_name=$rec['gazou'];

  $dbh=null;

  if($pro_gazou_name=='')
  {
    $disp_gazou='';
  }
  else
  {
    $disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
  }
}
catch(Exception $e)
{
    print'只今障害により大変ご迷惑おかけしています。';
    exit();
}
?>
<div class=t>
  商品削除<br />
</div>
<div class=h>
  
  <br />
  商品コード<br />
  <?php print $pro_code;?>
  <br />
  商品名<br />
  <?php print $pro_name;?>
  <br />
  <?php print $disp_gazou;?>
<br />
この商品を削除してよろしいですか？<br />
<br />
<form method="post" action="pro_delete_done.php">
  <input type ="hidden" name ="code" value="<?php print $pro_code;?>">
  <input type="hidden" name="gazou_name" value="<?php print $pro_gazou_name;?>">
  <input type="button" onclick="history.back()"value="戻る">
  <input type="submit" value="OK">
</form>
</div>
</body>
</html>