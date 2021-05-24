<?php

namespace App\classes;
use \PDO;
use App\classes\Base;

class Controller{ 

private $db;
public function __construct()
{
    $this->db = App::getDatabase();
}

/////LOCALE 

public function porperto($lat,$lng, $radius=2, $limite = 5){
  $perto= $this->db->query("SELECT  *,( 6371 * acos( cos( radians('$lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( lat ) ) ) ) AS distance FROM tags  HAVING distance < '$radius' ORDER BY distance LIMIT 0 , $limite")->fetchAll(PDO::FETCH_ASSOC);
  return $perto;
}

///// DISPLAY
public function myquery()
{
  //$n= $this->db->query("SELECT tags.* FROM tags UNION rating_info SELECT rating_action  FROM rating_info WHERE rating_action ='like'")->fetchAll(PDO::FETCH_ASSOC);
 $n= $this->db->query("SELECT DISTINCT tags.*,  rating_info.*  FROM tags  LEFT JOIN rating_info ON tags.id=rating_info.post_id AND  rating_info.rating_action ='like' ")->fetchAll(PDO::FETCH_ASSOC);
 // $n= $this->db->query("SELECT * FROM tags ")->fetchAll(PDO::FETCH_ASSOC);
		return $n;

}

//////TAG ////

public function tag($id)
{

  $result = $this->db->query("SELECT* from tags WHERE id=?", [$id])->fetch(PDO::FETCH_ASSOC);
  return $result;

}
/////INSERT

public function insert_infos($tag,$lat,$lng,$color,$icon,$adress,$info,$size,$time) 
{

    $insert = $this->db->query("INSERT INTO tags SET tag=?, lat=?, lng=?, color=?,icon=?, adress=?, info=?,size=?,time=?", [$tag, $lat, $lng, $color, $icon,  $adress,$info,$size, $time]);
  return  $insert? 'OK' : 'OPS!!';

  }
////// UPDATE////


public function update_infos($tag,$lat,$lng,$color,$icon,$adress,$info,$size,$id)
 {

    $update = $this->db->query("UPDATE tags SET tag=?, lat=?, lng=?, color=?,icon=?, adress=?, info=?,size=? WHERE id=?", [$tag, $lat, $lng, $color, $icon,  $adress,$info,$size,$id]);
  return $update;

  }

////////// DELETE///
public function delete( $id)
{

  $result = $this->db->query("DELETE from tags WHERE id=?", [$id]);

    return $result;

}


///// INSERT LIKE 

public function likeDeslike($action, $post_id, $user_id)
{
    switch ($action) {
        case 'like':
          return  $insert = $this->db->query("INSERT INTO rating_info SET rating_action='like',post_id=?,user_id =? ON DUPLICATE KEY UPDATE  rating_action='like'", [$post_id, $user_id]);

            break;
        case 'dislike':
            $insert = $this->db->query("INSERT INTO rating_info SET rating_action='dislike',post_id=?,user_id =? ON DUPLICATE KEY UPDATE  rating_action='dislike'", [$post_id, $user_id]);

            break;
    }
}

////// GET LIKE

public function getLikes($id)
{
    $count = $this->db->query("SELECT * FROM rating_info WHERE post_id=? AND rating_action='like'", [$id])->rowCount();

  return $count;
  
}
  

}