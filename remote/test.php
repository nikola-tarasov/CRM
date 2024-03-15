<?php
// include 'connect.php';

$result = mysqli_query($db, 'SELECT * FROM event');

$numresult = mysqli_num_rows($result);
 ?>
<?php echo '
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/style.css">
    <title>Событие</title>
  </head>
  <body>
'; ?>

<?php
for($n=0; $n<$numresult; $n++){
  $rowresult = mysqli_fetch_array($result);
          echo
          "
          <div class='content-redit'>
          <div class='wrapper'>
          <div class='blok-event'>
            <div class='data'>
              <p>".$rowresult['data']."</p>
            </div>
            <div class='even-text'>
              <p>" . $rowresult['text']."</p>
            </div>
        </div>
        </div>
        </div>";
}
 ?>

 <?php echo '
  </body>
</html>';
