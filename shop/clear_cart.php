<?php
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
  setcookie(session_name(),'',time()-4200,'/');
}
session_destroy();
?>

<!DOCKTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>生魚発注</title>
</head>
<body>
発注リストを空にしました。<br />
</body>
</html>