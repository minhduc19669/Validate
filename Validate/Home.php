<?php
declare(strict_types=1);
session_start();
if (!isset($_SESSION['username'])){
    header('location: Login.php');
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
Chúc mừng bạn có username là <?php }else{
echo $_SESSION['username'];
session_destroy(); }?> đã đăng nhập thành công !
</body>
</html>