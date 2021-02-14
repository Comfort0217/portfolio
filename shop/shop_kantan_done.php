<?php
	session_start();
	session_regenerate_id(true);
	if(isset($_SESSION['member_login'])==false)
	{
		print'ログインされていません。<br />';
		print'<a href="shop_list.php">商品一覧へ</a>';
		exit();
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

<?php

try
{

require_once('../common/common.php');

$post=sanitize($_POST);

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];

print"<div class=t>";
print'<h>ご注文情報</h><br />';
print "</div>";

print'<div class=h>';
print $onamae.'様<br />';
print 'ご注文ありがとうござました。<br />';
print $email.'にメールを送りましたのでご確認ください。<br />';
print '商品は以下の住所に発送させていただきます。<br />';
print $postal1.'-'.$postal2.'<br />';
print $address.'<br />';
print $tel.'<br />';

$honbun='';
$honbun.=$onamae."様\n\nこのたびはご注文ありがとうございました。\n";
$honbun.="\n";
$honbun.="ご注文商品\n";
$honbun.="--------------------\n";

$cart=$_SESSION['cart'];
$kazu=$_SESSION['kazu'];
$max=count($cart);

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

for($i=0;$i<$max;$i++)
{
	$sql='SELECT name,price FROM mst_product WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data[0]=$cart[$i];
	$stmt->execute($data);
	
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	
	$name=$rec['name'];
	$price=$rec['price'];
	$kakaku[]=$price;
	$suryo=$kazu[$i];
	$shokei=$price*$suryo;
	
	$honbun.=$name.' ';
	$honbun.=$price.'円 x ';
	$honbun.=$suryo.'個 = ';
	$honbun.=$shokei."円\n";
}


$lastmembercode=$_SESSION['member_code'];
$sql='INSERT INTO dat_member (password,name,email,postal1,postal2,address,tel) VALUES (?,?,?,?,?,?,?,)';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=$onamae;
	$data[]=$email;
	$data[]=$postal1;
	$data[]=$postal2;
	$data[]=$address;
	$data[]=$tel;
	
	
	$dbh=null;
	
$honbun.="--------------------\n";
$honbun.="\n";
$honbun.="準備が整い次第、発送いたします。\n";
$honbun.="\n";
$honbun.="□□□□□□□□□□□□□□\n";
$honbun.="株式会社イズミ　鮮魚課バイヤー　田中義朋\n";
$honbun.="\n";
$honbun.="広島県二葉の里\n";
$honbun.="電話 090-6060-xxxx\n";
$honbun.="メール info@rokumarunouen.co.jp\n";
$honbun.="□□□□□□□□□□□□□□\n";
//print '<br />';
print nl2br($honbun);

$title='ご注文ありがとうございます。';
$header='From:info@rokumarunouen.co.jp';
$honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
//mb_send_mail($email,$title,$honbun,$header);

$title='お客様からご注文がありました。';
$header='From:'.$email;
$honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
//mb_send_mail('info@rokumarunouen.co.jp',$title,$honbun,$header);

}
catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<br />
<a href="shop_list.php">商品画面へ</a>

</div>
</body>
</html>