<?php

header('Content-type: application/json; charset=UTF-8');

require_once('../vendor/autoload.php');

use App\classes\Controller;

$test= new Controller();

$feed = $test->myquery();

$geojson = array(
  'type' => 'FeatureCollection',
  'features' => array()
);
# Loop through rows to build feature arrays

foreach ($feed as $data) {
     // print_r($data) ;
      $properties = $data;
      
      $feature = array(
            'type' => 'Feature',
            'properties'=>array(
            'id'=>$data['id'],
            'icon'=>$data['icon'],
            'size'=> $data['size'],
            'time'=> $data['time'],
            'info'=> $data['info'],
            'tag'=> $data['tag'],
            'color'=> $data['color'],
            'adress'=> $data['adress'],
          ),
          'geometry' => array(
              'type' => 'Point',
              'coordinates' => array(
                  $data['lng'],
                  $data['lat']
              )
          ),
           'properties' => $properties
      );
      # Add feature arrays to feature collection array
      array_push($geojson['features'], $feature);
  
}

echo json_encode($geojson, JSON_NUMERIC_CHECK);



//output as JSON string


//write to JSON file
$fp = fopen('geo.json', 'w');
fwrite($fp, json_encode($geojson, JSON_PRETTY_PRINT));
fclose($fp);