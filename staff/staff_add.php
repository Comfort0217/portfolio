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
<div class=t>
  スタッフ追加<br />
</div>

<div class=h>
  <br />
  <form method="post" action="staff_add_check.php">
    スタッフ名を入力してください。<br />
    <input type="text" name="name" style="width:200px"><br />
    パスワードを入力してください。<br />
    <input type="password" name="pass" style="width:100px"><br />
    パスワードをもう一度入力してください。<br />
    <input type="password" name="pass2" style="width:100px"><br />
    <br />
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
  </form>
  
</div>
</body>
</html>