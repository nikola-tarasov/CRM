<?php


if (isset($subreg)){





//// Вывод контактов
if ($subreg==1){



$category_array=[]; //массив для запросов

$category = mysqli_query($db, "SELECT * FROM category");
$numcategory = mysqli_num_rows($category);
//--------------------Cчитываем все с таблички базы данных в массив
if ($numcategory>0){
for ($ee=0;$ee<$numcategory;$ee++){

$rowcategory = mysqli_fetch_array($category);

$category_array[$rowcategory['id']]=' ('.$rowcategory['name'].')'; // записывем в массив ключом который будет являться id записи а заначение полем таблички

}
}
//---------------------------------------------------------------


 //делаем запрос для вывода всех записей
$result = mysqli_query($db, 'SELECT * FROM users');
$numresult = mysqli_num_rows($result);


 echo
          '
          <section>
        <div class="content-redit">
        <div class="wrapper">
            <div class="titleReditBlok">
                <div class="titleRedit">
                    <h1>Список контактов</h1> 
                </div>
                <a href="?reg=10&subreg=2"> '.$group.'</a>
            </div>
            ';

for($n=0; $n<$numresult; $n++){

  $rowresult = mysqli_fetch_array($result);

  ///var_dump($rowresult);

  $editUrl = 'form.php?id=' . $rowresult['id'] . '&vid=1';
  $deleteUrl = 'form.php?id=' . $rowresult['id'] . '&vid=2';



$parent_name=''; // пустая переменная если в табличке нет совпадения

if (isset($category_array[$rowresult['id_parent']])){ // делаем проверку общаясь к массиву по ключу

$parent_name=$category_array[$rowresult['id_parent']]; // записывем в переменную если есть совпадение и потом выводим в строку
}

          echo"
          <div class='blok' id='blok_".$rowresult['id']."'>
            <div class='namePerson'>
              <p>".$rowresult['name'] . " " . $rowresult['surname'] . " ".$parent_name."</p>
            </div>
            <div class='phonePerson'>
              ".$phone."
              <p>" . $rowresult['phone'] . "</p>
            </div>
            <div class='button-cmd'>
              <div class='iconPen'>
                  <a href='?reg=10&subreg=3&id=".$rowresult['id']."'>".$edit."</a>
              </div>
              <div class='iconCarbag'>
                  <a onclick = 'del_row(" .$rowresult['id'].");'>".$carbag."</a>
              </div>
          </div>
        </div>
        ";
}

echo'<section>';


}
//// Конец Вывод контактов





//// Добавление контактов
if ($subreg==2){

echo'
 <section>
            <div class="box">
                <div class="titleNewContactBlok">
                    <div class="titleNew">
                        <h1>Добавление контакта</h1>
                    </div>
                    <div class="buttonCancel">
                            <div class="cancel-text">
                            <a href="index.php"><din class="cancel">
                                <p>Отменить</p>
                            </div>
                            <img src="imegs/solar.png" alt="">
                        </din></a>
                    </div>
                </div>
            </div>
                <div class="container-form">
                    <div class="form-wrapper">
                        <form action="form_new.php" method="post" class="form">
                            <div class="bloc-input">
                                <input type="text" value="" name="name" id="" placeholder="Имя" />
                                <input type="text" value="" name="surname" id="" placeholder="Фамилия" />
                                <input type="text" value="" name="phone" id="" placeholder="Teлефон" />
                                  <select class="selectContainer" name="id_parent">
                                    <option value="0">Группа не выбрана</option>
                            ';

// делаем запрос в базу данных категорий и выводим через цикл
$category = mysqli_query($db, 'SELECT * FROM category');
$numcategory = mysqli_num_rows($category);


if ($numcategory>0){  //если больще 0 массив
for($n=0; $n<$numcategory;$n++){

$rowcategory = mysqli_fetch_array($category);


// выводим через эхо
echo '
<option value="'.$rowcategory['id'].'">'.$rowcategory['name'].'</option>
';
}
}
                    echo'
                                  </select>
                                <input  type="hidden" value="2" name="mess" />
                                <input  type="hidden" value="0" name="id" />
                            </div>
                            <div class="bloc-submit">
                                <div class="inputIconSave">
                                    <input type="submit" value="Добавить">
                                    <img src="imegs/save.png" alt="">
                                </div>';
                    echo'
                            </div>
                        </form>
                    </div>
                </div>
    </section>
';
}
//// Добаление контактов








//// Добаление контактов
if ($subreg==3){


$id=(int)$_GET['id'];

$result = mysqli_query($db, "SELECT * FROM users WHERE id='".$id."'");
$numresult = mysqli_num_rows($result);


if ($numresult>0){

  // echo '<pre>';
  // var_dump($rowresult);
  // echo '</pre>';
  // вывод через тег пре после выполнения кода

$rowresult = mysqli_fetch_array($result);




echo'
 <section>
            <div class="box">
                <div class="titleNewContactBlok">
                    <div class="titleNew">
                        <h1>Редактирование контакта</h1>
                    </div>
                    <div class="buttonCancel">
                            <div class="cancel-text">
                            <a href="index.php"><din class="cancel">
                                <p>Отменить</p>
                            </div>
                            <img src="imegs/solar.png" alt="">
                        </din></a>
                    </div>
                </div>
            </div>
                <div class="container-form">
                    <div class="form-wrapper">
                        <form action="form_new.php" method="post" class="form">
                            <div class="bloc-input">
                                <input type="text" value="'.$rowresult['name'].'" name="name" id="" placeholder="Имя" />
                                <input type="text" value="'.$rowresult['surname'].'" name="surname" id="" placeholder="Фамилия" />
                                <input type="text" value="'.$rowresult['phone'].'" name="phone" id="" placeholder="Teлефон" />
                                
                                
                                <select class="selectContainer" name="id_parent">
                                    <option value="0">Группа не выбрана</option>
                            ';


$category = mysqli_query($db, 'SELECT * FROM category');
$numcategory = mysqli_num_rows($category);


if ($numcategory>0){
for($n=0; $n<$numcategory;$n++){

$rowcategory = mysqli_fetch_array($category);


if ($rowcategory['id']==$rowresult['id_parent']) {
  $selected=' selected';
} else {
  $selected='';
}


echo '
<option value="'.$rowcategory['id'].'" '.$selected.'>'.$rowcategory['name'].'</option>
';



}
}




                               echo'
                                  </select>

                                <input  type="hidden" value="3" name="mess" />
                                <input  type="hidden" value="'.$rowresult['id'].'" name="id" />
                            </div>
                            <div class="bloc-submit">
                                <div class="inputIconSave">
                                    <input type="submit" value="Сохранить">
                                    <img src="imegs/save.png" alt="">
                                </div>';




                    echo'
                            </div>
                        </form>
                    </div>
                </div>
    </section>
';

}



}
//// Добаление контактов







}

/////////////////////////





if (isset($_POST['mess'])){


$mess=$_POST['mess'];



////// Добавление формы


if ($mess==2){

include 'connect.php';
include 'func.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$surname = $_POST['surname'];
$id_parent = $_POST['id_parent'];

$inss = "INSERT INTO users (name, phone, surname, id_parent) VALUES ('".$name."', '".$phone."', '".$surname."', '".$id_parent."')";
mysqli_query($db,$inss);


$text_event='Добавлен новый контакт «'.$name.' '.$surname.'»';
record_events ($text_event);


$d="/";
header('Refresh: 0; URL='.$d);

}


////// Конец Добавление формы







////// Редактирование формы


if ($mess==3){

include 'connect.php';
include 'func.php';

$id = (int)$_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$surname = $_POST['surname'];
$id_parent = $_POST['id_parent'];


$users = mysqli_query($db, "SELECT * FROM users WHERE id='".$id."'");
$numusers = mysqli_num_rows($users);


$data_edit_arr=array();


if ($numusers > 0) {

$rowusers = mysqli_fetch_array($users);

if ($rowusers['name']!=$name){ // сранвиваем с данными с базы и с данными из формы
$data_edit_arr[]='имя с «'.$rowusers['name'].'» на  «'.$name.'»'; // записываем в пустой массив строку
}

if ($rowusers['surname']!=$surname){
$data_edit_arr[]='фамилия с «'.$rowusers['surname'].'» на  «'.$surname.'»';
}


if ($rowusers['phone']!=$phone){
$data_edit_arr[]='телефон с «'.$rowusers['phone'].'» на  «'.$phone.'»';
}

// if ($rowusers['id_parent'] != $id_parent) {
//
//   $category = mysqli_query($db, "SELECT * FROM category WHERE id='".$rowusers['id_parent']."'");
//   $numcategory = mysqli_num_rows($category);
//
//
//   if ($numcategory > 0) {
//     $rowcategory = mysqli_fetch_array($category);
//   }
//
//   $category2 = mysqli_query($db, "SELECT * FROM category WHERE id='".$id_parent."'");
//   $numcategory2 = mysqli_num_rows($category2);
//
//
//   if ($numcategory2 > 0) {
//     $rowcategory2 = mysqli_fetch_array($category2);
//   }
//
//   $data_edit_arr[]='категория с «'.$rowcategory['name'].'» на  «'.$rowcategory2['name'].'»';
// }
//
// }

// при добавлении в массив



if ($rowusers['id_parent'] != $id_parent) {


  $category_array = [];

  $category = mysqli_query($db, "SELECT * FROM category");

  $numcategory = mysqli_num_rows($category);

  if ($numcategory>0) {
    for ($i=0; $i < $numcategory ; $i++) {
      $rowcategory = mysqli_fetch_array($category);
      $category_array[$rowcategory['id']] = $rowcategory['name'];
    }

$data_edit_arr[]='категория с «'.$category_array[$rowusers['id_parent']].'» на  «'.$category_array[$id_parent].'»';

  }

}




}




if (count($data_edit_arr)==0){
$data_edit_arr[]='данные не изменились';
}



$inss = "UPDATE users SET name = '".$name."', surname = '".$surname."', phone = '".$phone."', id_parent='".$id_parent."' WHERE id ='".$id."'";
mysqli_query($db,$inss);


$text_event='Редактирование контакты «'.$name.' '.$surname.'». Изменены следующие данные:'.implode(', ',$data_edit_arr);//вывод массива через преобразования функции  imploid()
record_events ($text_event);




$d="/";
header('Refresh: 0; URL='.$d);

}

////// Конец Редактирование формы



////// Удаление формы

if ($mess==4){// удаление при помощи ajax

include 'connect.php';
include 'func.php';

$id = $_POST['idrec'];

$users = mysqli_query($db, "SELECT * FROM users WHERE id='".$id."'");
$numusers = mysqli_num_rows($users);

if ($numusers > 0) {
$rowusers = mysqli_fetch_array($users);

}

mysqli_query($db, "DELETE FROM users WHERE id='".$id."'");


$text_event='Удаление контакта «'.$rowusers['name'].' '.$rowusers['surname'].'»';
record_events ($text_event);


$data = array(
'idrec' => $id
);

echo json_encode($data);


}

////// Конец удаление формы



}

?>