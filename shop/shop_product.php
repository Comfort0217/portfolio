<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
  print"<div class=t>";
  print'社員情報　';
  print'<a href="member_login.html">ログイン</a><br />';
  print'<br />';
  print "</div>";
}
else
{
  print"<div class=t>";
  print'ログイン中　社員：';
  print $_SESSION['member_name'];
  print'　';
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
<div class="h">  
<?php

try{

  $pro_code=$_GET['procode'];

  $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
  $user='root';
  $password='';
  $dbh=new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[]=$pro_code;
  $stmt->execute($data);

  $rec=$stmt->fetch(PDO::FETCH_ASSOC);
  $pro_name=$rec['name'];
  $pro_price=$rec['price'];
  $pro_gazou_name=$rec['gazou'];

  $dbh=null;

if($pro_gazou_name=="")
{
  $disp_gazou='';
}
else
{
  $disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
}
print'<a href="shop_cartin.php?procode='.$pro_code.'">発注リストに入れる</a><br /><br />';
}
catch(Exception $e)
{
    print'只今障害により大変ご迷惑おかけしています。';
    exit();
}

?>

商品情報参照<br />
<br />
商品コード<br />
<?php print $pro_code;?>
<br />
商品名<br />
<?php print $pro_name;?>
<br />
<?php print $pro_price;?>円
<br />
<?php print $disp_gazou;?>
<br />
<form>
<input type="button" onclick="history.back()"value="戻る">
</form>
</div>
</body>
</html>