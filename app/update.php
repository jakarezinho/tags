<?php 
require_once('../vendor/autoload.php');


use App\classes\Controller;

$test= new Controller();

if($_SERVER['REQUEST_METHOD'] === 'GET'){

$tag= $test->tag($_GET['id']);
 
}else{
    die();
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo $tag['id']?>
</body>
</html>