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

  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"], 1);
  
  $dbh = new PDO(
    'mysql:host=' . $server . ';dbname=' . $db . ';charset=utf8mb4',
    $username,
    $password,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
    ]
    );

  $staff_code=$_GET['staffcode'];

  // $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
  // $user='root';
  // $password='';
  // $dbh=new PDO($dsn,$user,$password);
  // $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql='SELECT name FROM mst_staff WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[]=$staff_code;
  $stmt->execute($data);

  $rec=$stmt->fetch(PDO::FETCH_ASSOC);
  $staff_name=$rec['name'];

  $dbh=null;
}
catch(Exception $e)
{
    print'只今障害により大変ご迷惑おかけしています。';
    exit();
}
?>
<div class=t>
  社員削除<br />
</div>
<div class=h>
  <br />
  スタッフコード<br />
  <?php print $staff_code;?>
<br />
スタッフ名<br />
<?php print $staff_name;?>
<br />
このスタッフを削除してよろしいですか？<br />
<br />
<form method="post" action="staff_delete_done.php">
  <input type ="hidden" name ="code" value="<?php print $staff_code;?>">
  <input type="button" onclick="history.back()"value="戻る">
<input type="submit" value="OK">
</div>
</form>
</body>
</html>