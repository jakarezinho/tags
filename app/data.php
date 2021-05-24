<?php 
require_once('../vendor/autoload.php');


use App\classes\Controller;

$test= new Controller();

if($_SERVER['REQUEST_METHOD'] === 'GET'){

   $test->tag($_GET['id']);
 
}


if($_SERVER['REQUEST_METHOD'] === 'POST'&& !isset($_POST['post_id'])){
  $insert= $test->insert_infos($_POST['tag'],$_POST['latitude'],$_POST['longitude'],$_POST['color'],$_POST['icon'],$_POST['adress'],$_POST['info'],$_POST['size'],$_POST['time']);
 return $insert;
}

if($_SERVER['REQUEST_METHOD'] === 'PUT'){
   parse_str(file_get_contents("php://input"),$post_vars);
  $update=  $test->update_infos($post_vars['tag'],$post_vars['latitude'],$post_vars['longitude'],$post_vars['color'],$post_vars['icon'],$post_vars['adress'],$post_vars['info'],$post_vars['size'],$post_vars['id']);
 return $update;
   
 
}
if($_SERVER['REQUEST_METHOD'] === 'DELETE')
{
   parse_str(file_get_contents("php://input"),$post_vars);

  $delet= $test->delete($post_vars['id']);
  return $delet;
 
}

//////////////LIKES https://dev.to/ramonak/javascript-how-to-access-the-return-value-of-a-promise-object-1bck
////https://stackoverflow.com/questions/59477505/set-value-of-global-variable-inside-async-function-or-inside-promise

//GET LIKE//
if($_SERVER['REQUEST_METHOD'] === 'POST' &&  !isset($_POST['action']))
{ 
   $likes = $test->getLikes($_POST['post_id']);
   echo $likes;
 return ;
 
  
}

///// INSERT LIKE 
if($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['action']))
{ 

 $test->likeDeslike($_POST['action'], $_POST['post_id'], $_POST['user_id']);
 return ;
 
  
}
