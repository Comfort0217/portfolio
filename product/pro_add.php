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
  生魚　商品情報追加<br />
</div>

<div class=h>
  <br />
  <form method="post" action="pro_add_check.php" enctype="multipart/form-data">
  産地、商品名、単位を入力してください。<br />
  <input type="text" name="name" style="width:200px"><br />
    価格を入力してください。<br />
    <input type="text" name="price" style="width:50px"><br />
    画像を選んでください。<br />
    <input type="file" name="gazou" style="width:400px"><br />
    <br />  
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
  </form>
  
</div>
</body>
</html>