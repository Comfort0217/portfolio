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

  require_once('../common/common.php');

  $post=sanitize($_POST);
  $staff_name=$post['name'];
  $staff_pass=$post['pass'];
  $staff_pass2=$post['pass2'];

  if($staff_name=='')
  {
      print'社員名が入力されていません。<br />';
  }
  else
  {   
      print'<div class=h>';
      print'社員名:';
      print$staff_name;
      print'<br />';
    }
    if($staff_pass=='')
    {
        print'パスワードが入力されいません。<br />';  
    }

    if($staff_pass!=$staff_pass2)
    {
        print'パスワードが一致しません。<br />';
    }
    
    if($staff_name==''||$staff_pass==''||$staff_pass!=$staff_pass2)
    {
      print'<form>';
      print'<input type="button" onclick="history.back()"value="戻る">';
      print'</form>';
    }
  else
  {
      $staff_pass=md5($staff_pass);
      print'<form method="post"action="staff_add_done.php">';
      print'<input type="hidden" name="name" value="'.$staff_name.'">';
      print'<input type="hidden" name="pass" value="'.$staff_pass.'">';
      print'<br />';
      print'<input type="button" onclick="history.back()"value="戻る">';
      print'<input type="submit" value="OK">';
      print'</form>';
      print'</div>';
    }

  ?>

</body>
</html>