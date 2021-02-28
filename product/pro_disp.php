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

  $pro_code=$_GET['procode'];

  // $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
  // $user='root';
  // $password='';
  // $dbh=new PDO($dsn,$user,$password);
  // $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

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
  商品情報参照<br />
</div>
<div class=h>
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