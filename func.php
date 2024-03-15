<?php





function record_events ($text){

include 'connect.php';

$inss = "INSERT INTO event (date, text) VALUES (NOW(),'".$text."')";
mysqli_query($db,$inss);

}



function date1($str){

$date = new DateTime($str);

$i = $date->format('n');

$months = ['','Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];

$ru_month = $months[$i];

$ru_date = $date->format("d $ru_month Y");

return $ru_date;
}



function date2($strd){

$str = $strd;
$str = new DateTime($str);

$rez = $str->format('G.i');

return $rez;
}


?>
