<?php 
require_once('../vendor/autoload.php');


use App\classes\Controller;

$test= new Controller();

if($_SERVER['REQUEST_METHOD'] === 'GET'){

   $test->tag($_GET['id']);
 
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
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
