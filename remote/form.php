<?php

  error_reporting(E_ALL);
  ini_set('display_errors', 'On');

include 'connect.php';

$userId =$_GET['id'] ?? null; // используем тернарный оператор
$vid = $_GET['vid'] ?? null;


if ($vid == 0){
  // редактирование
  $title = 'Добавление нового контакта';
  $name='';
  $surname='';
  $phone='';

  $textButton = 'Добавить';
  $mess_int = 1;
}
if ($vid == 1){
  // редактирование
  $title = 'Редактирование контакта';


  $result = mysqli_query($db, 'SELECT * FROM users WHERE id="'.$userId.'" ');
  $rowresult = mysqli_fetch_array($result);

  $name =$rowresult['name'];
  $phone = $rowresult['phone'];
  $surname = $rowresult['surname'];



  $textButton = 'Сохранить';
  $mess_int = 2;
}
if ($vid == 2){
  // удаление
  mysqli_query($db, "DELETE FROM users WHERE id='".$userId."' ");

  header("Location: index.php");
}


$mess = $_POST['mess'] ?? 0;


if ($mess==1){
  $name = $_POST['name'] ?? ''; // тернарный оператор
  $phone = $_POST['phone'] ?? '';
  $surname = $_POST['surname']?? '';

  $result = mysqli_query($db, "INSERT INTO users (name, phone, surname) VALUES ('".$name."', '".$phone."', '".$surname."' )");

  record_events ($db, 'Добавлен Хрен хренович'.$name.' '.$surname);

  header("Location: index.php");
}
if ($mess == 2){
  $name = $_POST['name'] ?? ''; 
  $phone = $_POST['phone'] ?? '';
  $surname = $_POST['surname']?? '';
  $userId = $_POST['id'] ?? null;

  $result = mysqli_query($db, "UPDATE users SET name = '".$name."', phone = '".$phone."' WHERE id ='".$userId."'");



record_events ($db, 'Отредактирован полностью Хрен хренович');
header("Location: index.php");


}




function record_events ($db,$text){

  $result = mysqli_query($db, "INSERT INTO event (date, text) VALUES (NOW(), '".$text."' )");

}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New contact</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- шапка сайта -->
    <header>
      <div class="content-wrapper">
        <div class="content">
            <div class="brend">
                <strong class="textAlfa">Alfa</strong><strong class="textFranche">Franche</strong>
            </div>
            <div class="face-prof">
                <img class="photo" src="imegs/face.jpg" alt="">
                <div class="icon">
                    <a href="">
                        <img src="imegs/icon.png" alt="">
                    </a>
                </div>
            </div>
        </div>
      </div>
    </header>
    <section>
            <div class="box">
                <div class="titleNewContactBlok">
                    <div class="titleNew">
                        <h1><?php echo $title; ?></h1>
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
                        <form action="form.php" method="post" class="form">
                            <div class="bloc-input">
                                <input type="text" value="<?php echo($name); ?>" name="name" id="" placeholder="Имя" />
                                <input type="text" value="<?= $surname; ?>" name="surname" id="" placeholder="Фамилия" />
                                <input type="text" value="<?= $phone; ?>" name="phone" id="" placeholder="Teлефон" />

                                <input  type="hidden" value="<?= $mess_int; ?>" name="mess" />
                                <input  type="hidden" value="<?= $userId; ?>" name="id" />
                            </div>
                            <div class="bloc-submit">
                                <div class="inputIconSave">
                                    <input type="submit" value="<?= $textButton; ?>">
                                    <img src="imegs/save.png" alt="">
                                </div>

                                <?php
                                  if ($vid == 1){
                                    echo
                                    '<div class="inputIconDelete">
                                      <input type="submit" value="Удалить">
                                      <img src="imegs/carbag.png" alt="">
                                    </div>';
                                  }

                                ?>
                            </div>
                        </form>
                    </div>
                </div>
    </section>
</body>
</html>
