<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	print"<div class=t>";
	print 'ログインされていません。<br />';
	print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
	print "</div>";
	exit();
}
else
{
	print"<div class=t>";
	print 'ログイン中　社員：';
	print $_SESSION['staff_name'];
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
	商品管理トップメニュー<br />
	<br />
	<a href="../staff/staff_list.php">社員管理</a><br />
	<br />
	<a href="../product/pro_list.php">商品管理</a><br />
	<br />
	<a href="staff_logout.php">ログアウト</a><br />
	
</div>
</body>
</html>