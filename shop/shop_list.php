<?php
session_start();
session_regenerate_id(true);

if(isset($_SESSION['member_login'])==false)
{
	print"<div class=t>";
	print '社員情報　';
	print '<a href="member_login.html">ログイン</a><br />';
	print '<br />';
	print "</div>";
}
else
{
	print"<div class=t>";
	print 'ログイン中　社員：';
	print $_SESSION['member_name'];
	print ' 　';
	print '<a href="member_logout.php">ログアウト</a><br />';
	print '<br />';
	print "</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>生魚発注</title>
<link rel="stylesheet" type="text/css" href="../css/shop_list.css">
</head>
<body>
<div class=h>
<?php

try
{

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name,price FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;


print '発注商品一覧<br /><br />';

while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	print '<a href="shop_product.php?procode='.$rec['code'].'">';
	print $rec['name'].'---';
	print $rec['price'].'円';
	print '</a>';
	print '<br />';
}

print '<br />';
print '<a href="shop_cartlook.php">発注商品を見る</a><br />';

}
catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>
</div>
</body>
</html>