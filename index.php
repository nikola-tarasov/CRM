<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);



if (isset($_GET['reg'])){
$reg=(int)$_GET['reg'];
} else {
$reg=10;
}

if (isset($_GET['subreg'])){
$subreg=(int)$_GET['subreg'];
} else {
$subreg=1;
}





$cache = rand(1, 1000000);

include 'connect.php';
include 'func.php';
include 'svg-icons.php';


echo'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Справочник</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/css/style.css?v='.$cache.'">
    <script src="js/js.js?v='.$cache.'"></script>
</head>
<body>

';



include "header.php";



if ($reg==10){
include "form_new.php";
}


if ($reg==20) {
  include "event.php";
}

if($reg == 30){
  include "category.php";
}

// echo('
//
// <div style="color:#ffffff;width:500px;margin:auto;margin-top:100px;">
//
// <input id="name_pole" style="color:#ffffff;width:200px;background:#000000;" type="text" /> <input onclick="name_post();" type="button" value="Отправить" />
//
//
// <div id="name_post">
//
//
// </div>
//
//
//
// <div id="name_post2">
//
//
// </div>
//
//
//
// <div id="name_post3">
//
//
// </div>
//
//
//
// </div>
//
// ');
echo'

</body>
</html>
';



?>
