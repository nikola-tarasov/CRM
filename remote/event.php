<?php

if (isset($subreg)) {




  if($subreg == 1){

    $result = mysqli_query($db, 'SELECT * FROM event ORDER BY date DESC');

    $numresult = mysqli_num_rows($result);





echo "

<div class='content-redit'>
<div class='wrapper'>
<div class='titleReditBlok'>
    <div class='titleRedit'>
        <h1>Событие</h1>
    </div>
</div>


";
    for($n=0; $n<$numresult; $n++){
      $rowresult = mysqli_fetch_array($result);
              echo"
              <div class='blok-event' id='event_".$rowresult['id']."'>
                <div class='data'>
                  <p>".date1($rowresult['date']) . " в " . date2($rowresult['date']). "</p>
                </div>
                <div class='event-text'>
                  <p>" . $rowresult['text']."</p>
                </div>
                <div class='iconCarbagEvent'>
                    <a onclick = 'del_event(".$rowresult['id'].");'>".$carbag."</a>
                </div>
                </div>";
    }
    echo "
    </div>
    </div>";

  }



    if ($subreg == 4){

    $id=$_GET['id'];


    $event= mysqli_query($db, "SELECT * FROM event WHERE id='".$id."'");
    $numevent = mysqli_num_rows($event);

    echo("SELECT * FROM event WHERE id='".$id."'");


    if ($numevent>0){

    $rowevent = mysqli_fetch_array($event);


    echo "
<div class='content-redit'>
<div class='wrapper'>
<div class='titleReditBlok'>
    <div class='titleRedit'>
        <h1>Событие ".$rowevent['date']."</h1>
    </div>
</div>
";

echo("
    </div>
    </div>
    ");


} else {
    echo('<p style="color:#ffffff;">Такого события нет</p>');
    }
    }
}

////////////////

$mess = 0;
if(isset($_POST['mess'])){
  $mess = $_POST['mess'];
}



if($mess == 1){
  include 'connect.php';
  include 'func.php';

  $id = $_POST['idrec'];

  mysqli_query($db, "DELETE FROM event WHERE id='".$id."'");

  $data = [
    'idrec' => $id
  ];
  echo json_encode($data);
}










 ?>
