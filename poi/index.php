<?php


$json_test  =  file_get_contents('test.json');
$json_test =   json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json_test), true);

if(!$json_test)
    echo 'unable to open file';

$array_response = [ ];

   function  retrun_digit($string){
    for ($i = 0; $i < strlen($string); $i++) {
        if (ctype_digit($string[$i])) {
            return $i +1 ;
        }
    }
}

function return_image($string){
    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] === '/') {
            return $i + 1;
        }
    }
}

//attention creer les quete avec les bon id avant;
$i = 0 ;
foreach ($json_test as $key => $value) {
    if (!empty($value['Nom du Poi']) and !empty($value['Related to Zones  (Column)']) ) {
        $i ++ ;
        $response =  new stdClass();
        $response->id = $i;
        switch ($value['Related to Zones  (Column)']) {
            case preg_match('/Zone-Menton/', $value['Related to Zones  (Column)']):
                $response->quest_id = 3;
                break;
            case preg_match('/Zone-Castellar/', $value['Related to Zones  (Column)']):
                $response->quest_id = 4;
                break;
            case preg_match('/Zone-Castillon/', $value['Related to Zones  (Column)']):
                $response->quest_id = 6;
                break;
            case preg_match('/Zone-Sainte-Agn/', $value['Related to Zones  (Column)']):
                $response->quest_id = 7;
                break;
            case preg_match('/Zone-Gorbio/', $value['Related to Zones  (Column)']):
                $response->quest_id = 8;
                break;
            case preg_match('/Zone-La-Turbie/', $value['Related to Zones  (Column)']):
                $response->quest_id = 9;
                break;
            case preg_match('/Zone-Beausoleil/', $value['Related to Zones  (Column)']):
                $response->quest_id = 10;
                break;
            case preg_match('/Zone-Roquebrune/', $value['Related to Zones  (Column)']):
                $response->quest_id = 11;
                break;
            case preg_match('/Zone-Moulinet/', $value['Related to Zones  (Column)']):
                $response->quest_id = 12;
                break;
            case preg_match('/Zone-Sospel/', $value['Related to Zones  (Column)']):
                $response->quest_id = 13;
                break;
            case preg_match('/Zone-Breil-sur-Roya/', $value['Related to Zones  (Column)']):
                $response->quest_id = 14;
                break;
            case preg_match('/Zone-Saorge-Fontan/', $value['Related to Zones  (Column)']):
                $response->quest_id = 15;
                break;
            case preg_match('/Zone-La-Brigue/', $value['Related to Zones  (Column)']):
                $response->quest_id = 16;
                break;

        }
            $response->quest_id = 3 ;
            $index = retrun_digit($value['Nom du Poi']);
            $name = substr($value['Nom du Poi'] , $index);
            $response->name = trim($name);
            
            $gps = str_replace('"', "", $value['GPS']);
            $gps = str_replace('"', "", $value['GPS']);
            $gps = explode(',' ,  $gps);
            $gps =  '{ "lat":'. $gps[0].' , "lng":'. $gps[1].'}';
           
       
            $response->latLng = $gps;
            $response->clue = $value['Texte indice'];
            $response->text  = null ;
            $index = return_image($value['indiceImage']) ;
            $response->image_clue = 'images/clues/'.trim(substr($value['indiceImage'] , $index));
            switch ($value['CatPoi']) {
                case 'Culturel':
                    $response->type_poi_id = 2;
                    break;
                case 'Orientation':
                    $response->type_poi_id = 5;
                    break;
                case 'Observation':
                    $response->type_poi_id = 3;
                    break;
                case 'Sport':
                    $response->type_poi_id = 6;
                    break;
                case 'Enigme':
                    $response->type_poi_id = 4;
                    break;
                case 'Flash':
                    $response->type_poi_id = 1;
                    break;
                case 'Durable':
                    $response->type_poi_id = 7;
                    break;
                default:
                    var_dump($response->name);
                break;
                
            }
            $response->radius = 5 ;
            array_push($array_response, $response);
        }
      
    
    }
    function insertOne($poi, $pdo, $i){

        $request = $pdo->prepare('INSERT INTO poi (id , quest_id , name , latlng , text , clue , image_clue , step , type_poi_id , radius )
        VALUES (:id, :quest_id, :name, :latlng, :text , :clue , :image_clue , :step , :type_poi_id ,  :radius)');

        $request->bindValue(":id", $poi->id);
        $request->bindValue(":quest_id", $poi->quest_id);
        $request->bindValue(":name", $poi->name);
        $request->bindValue(":latlng", $poi->latLng);
        $request->bindValue(":text", null);
        $request->bindValue(":clue", $poi->clue);
        $request->bindValue(":image_clue", $poi->image_clue);
        $request->bindValue(":step", $i);
        $request->bindValue(":type_poi_id", $poi->type_poi_id);
        $request->bindValue(":radius", $poi->radius);
        $request->execute();
    }
    $i =0 ;
    $pdo = new PDO('mysql:dbname=meb;host=localhost', 'root', '',  array(1002 => 'SET NAMES utf8'));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    foreach ($array_response as $key => $value) {
      $i ++;
      insertOne($value, $pdo , $i);
    }

    echo 'ok';

  
// foreach ($array_response as $key => $value) {
//     $i ++ ;
//     var_dump($value , $i);
//     echo '<br><br><br>';

// }



   

