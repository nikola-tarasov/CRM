<?php

if($subreg){


  if($subreg == 1){

    $result = mysqli_query($db, 'SELECT * FROM category');   // делаем запрос к базе данных категории
    $numresult = mysqli_num_rows($result); // полученный результат прогоняем через функцию чтобы подсчитать кол.строк

    // вывод категории
    echo'
      <section>
        <div class="content-redit">
        <div class="wrapper">
            <div class="titleReditBlok">
                <div class="titleRedit">
                    <h1>Категории</h1>
                    </div>
                    <a href="?reg=30&subreg=2">'.$groupCategory.'</a>
                    </div>
                    ';

             for($n=0; $n<$numresult; $n++){

             $rowresult = mysqli_fetch_array($result); // вывод в массив

             $del_category='"'.$rowresult['name'].'"';

         echo"
          <div class='blok' id='deleteCategory_".$rowresult['id']."'>
            <div class='namePerson'>
              <p>".$rowresult['name']."</p>
              </div>
           <div class='phonePerson'>
             <p> Номер " . "  ".$rowresult['id']."</p>
           </div>
           <div class='button-cmd'>
             <div class='iconPen'>
                 <a href='index.php?reg=30&subreg=3?&id=".$rowresult['id']."'>".$edit."</a>
             </div>
             <div class='iconCarbag'>
                 <a onclick='delCategory(".$rowresult['id'].")' >".$carbag."</a>
             </div>
         </div>
       </div>
       ";
}

echo'<section>';
}
//// Конец Вывод категории

// Редактирования группы
if($subreg == 3){

  $textButton = "Добавить";
  $id = $_GET['id'];

  $category = mysqli_query($db, "SELECT * FROM category WHERE id= '".$id."'   ");
  $rowcategory = mysqli_fetch_array($category);


  echo'
   <section>
              <div class="box">
                  <div class="titleNewContactBlok">
                      <div class="titleNew">
                          <h1>Добавление группы</h1>
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
                          <form action="category.php" method="post" class="form">
                              <div class="bloc-input">
                                  <input type="text" value="'.$rowcategory['name'].'" name="name" placeholder="Название группы" />
                                  <input type="hidden" name="mess" value="3">
                                  <input type="hidden" name="id" value="'.$rowcategory['id'].'">
                              </div>
                              <div class="bloc-submit">
                                  <div class="inputIconSave">
                                      <input type="submit" value="Изменить">
                                      <img src="imegs/save.png" alt="">
                                  </div>
                              </div>


                          </form>
                      </div>
                  </div>
      </section>
  ';


}
// Конец редактирования группы

// Добавление новой группы
if($subreg == 2){

  $textButton = "Сохранить";

    echo'
     <section>
                <div class="box">
                    <div class="titleNewContactBlok">
                        <div class="titleNew">
                            <h1>Добавление группы</h1>
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
                            <form action="category.php" method="post" class="form">
                                <div class="bloc-input">
                                    <input type="text" value="" name="name" placeholder="Название группы" />
                                    <input type="hidden" name="mess" value="2">


                                </div>
                                <div class="bloc-submit">
                                    <div class="inputIconSave">
                                        <input type="submit" value="'.$textButton.'">
                                        <img src="imegs/save.png" alt="">
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
        </section>
    ';
  }
}




$mess = 0;

if (isset($_POST['mess'])){
  $mess = $_POST['mess'];
}



if ($mess == 3) {

  include 'connect.php';
  include 'func.php';



  $id = $_POST['id'];
  $name = $_POST['name'];

  $category = mysqli_query($db, "SELECT * FROM category WHERE id='".$id."'");
  $numcategory = mysqli_num_rows($category);

  $category_edit_arr = [];



  if ($numcategory > 0) {

       $rowcategory = mysqli_fetch_array($category);

       if($rowcategory['name'] != $name){

         $category_edit_arr[] = " Название с " . $rowcategory['name'] . " на " . $name;
       }
  }




  if (count($category_edit_arr) == 0) {
    $category_edit_arr[] = " Название не изменено ";
  }



  $sql = "UPDATE category SET name ='".$name."' WHERE   id = '".$id."' ";

  mysqli_query($db, $sql);

  $text = "Было изменено : " . $rowcategory['name'] . implode(', ', $category_edit_arr);

  record_events($text);
  header('Location: index.php?reg=30&subreg=1');

}




if ($mess == 2){

    include 'connect.php';
    include 'func.php';

    $name = $_POST['name'];

    $sql = "INSERT INTO category (name) VALUES ('".$name."') ";

    mysqli_query($db, $sql);

    $text = "Добавлена новая категория" ." " . $name ;

    record_events($text);

    header('Location: index.php?reg=30&subreg=1');


  }
  // Конец добавление новой группы






  // удаление группы из списка
if ($mess == 1) {

  include 'connect.php';
  include 'func.php';

  $id = $_POST['id'];

  $category = mysqli_query($db,"SELECT * FROM category WHERE id= '".$id."'");
  $rowcategory = mysqli_fetch_array($category);

  $sql="DELETE FROM category WHERE id =".$id."";

  mysqli_query($db, $sql);

  $text = "Была удалена категория" . " " . $rowcategory['name'];

  record_events($text);

  $data = [
  'id' => $id
];

  echo json_encode($data);

}

  // конец удаление группы из списка


?>
