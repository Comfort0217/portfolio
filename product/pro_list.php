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
$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT code,name,price FROM mst_product WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$dbh = null;
print"<div class=t>";
print' 生魚情報　一覧<br /><br />';
print "</div>";
print'<div class=h>';
print'<form method="post" action="pro_branch.php">';

while(true)
{
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  if($rec==false)
  {
    break;
  }
  print'<input type="radio" name="procode"value="'.$rec['code'].'">';
  print $rec['name'].'---';
  print $rec['price'].'円';
  print'<br />';
}
print'<input type="submit" name="disp" value="参照">';
print'<input type="submit" name="add" value="追加">';
print'<input type="submit" name="edit" value="修正">';
print'<input type="submit" name="delete" value="削除">';
print'</form>';
}
catch(EXception $e){
  print'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

?>

<br />
<a href="../staff_login/staff_top.php">トップメニューへ</a><br />

</div>
</body>
</html>