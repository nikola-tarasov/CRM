$(document).ready(function(){

  console.log();


});//получить все данные с js не зависимо


function del_row(id) {
if ( confirm('Вы уверены что хотите удалить контакт?')){

$('#blok_'+id).css({'opacity':'0.5'});

$.ajax({
type: 'POST',
url: 'form_new.php',
dataType: 'json',
data: 'mess=4&idrec='+id,
success: function(data) {

var id_back=data.idrec;

$('#blok_'+id).remove();



}
});


    /////location.href = 'form.php?id='+id+'&vid=2';


  }
}






function name_post(){
var name=document.getElementById("name_pole").value;
$.ajax({
type: 'POST',// создаем способ передачи
url: 'name_post.php',// указываем путь до сервера или файла для обработки запроса
dataType: 'json', // получем файл в json формате
data: 'name='+name,// формируем POST запрос без ? и &
success: function(data) {
alert(data.root);
// document.getElementById('name_post').innerHTML=data.sex4;
///alert(data.sex+' '+data.sex2+' '+data.sex3);
///$('#name_post').html(data.sex4);
///$('#name_post2').html(data.sex2);
///$('#name_post3').html(data.sex3);

}//функция получает и обрабатывает с сервера и вывожит по id в html страницу
});
}

function del_event(id) {

  // console.log(id, 1+1);

  $('#event_'+id).css({'background-color':'red'});

  // document.getElementById('event_'+id).style.backgroundColor = 'red';

  $.ajax({
  type: 'POST',// создаем способ передачи
  url: 'event.php',// указываем путь до сервера или файла для обработки запроса
  dataType: 'json', // получем файл в json формате
  data: 'mess=1&idrec='+id,// формируем POST запрос без ? и &
  success: function(data) {

    // console.log(data.test);

    // document.getElementById('event_'+id).remove();

    $('#event_'+id).remove();


  }
  });

}

function delCategory(id){

  document.getElementById('deleteCategory_'+id).style.backgroundColor = 'red';

  $.ajax({
  type: 'POST',// создаем способ передачи
  url: 'category.php',// указываем путь до сервера или файла для обработки запроса
  dataType: 'json', // получем файл в json формате
  data: 'mess=1&id='+id,// формируем POST запрос без ? и &
  success: function(data) {

  document.getElementById('deleteCategory_'+id).remove();

    // $('#event_'+id).remove();
  }
  });


}







