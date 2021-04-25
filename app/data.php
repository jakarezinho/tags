<?php 
require_once('../vendor/autoload.php');


use App\classes\Controller;

$test= new Controller();

if($_SERVER['REQUEST_METHOD'] === 'GET'){

   $test->tag($_GET['id']);
 
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $test->insert_infos($_POST['tag'],$_POST['latitude'],$_POST['longitude'],$_POST['color'],$_POST['icon'],$_POST['adress'],$_POST['info'],$_POST['size'],$_POST['time']);
 
}
if($_SERVER['REQUEST_METHOD'] === 'PUT'){
   $test->update_infos($_POST['tag'],$_POST['latitude'],$_POST['longitude'],$_POST['color'],$_POST['icon'],$_POST['adress'],$_POST['info'],$_POST['size'],$_POST['time'],$_POST['id']);
   
 
}
if($_SERVER['REQUEST_METHOD'] === 'DELETE')
{
   parse_str(file_get_contents("php://input"),$post_vars);

   $test->delete($post_vars['id']);
 
}
//$test->insert_infos($tag,$lat,$lng,$color,$icon,$adress,$info,$size,$time);
//$test->insert_infos('tags ','3.1224588','56.445555555','bleu','hot','rua das gaivotas','infos','Thu Apr 22 2021 17:12:43 GMT+0100 (Hora de ver da Europa Ocidental)');

 
?>


