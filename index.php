<?php
$json_test  =  file_get_contents('slides.json');
$json_test =   json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json_test), true);

if (!$json_test)
    echo 'unable to open file';

$array_response = [];

function clean($string){
    $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}


$i = 0 ;
foreach ($json_test as $key => $value) {
    if (!empty($value['Arborescence de la slide']) and !empty($value['Step']) ){
        
        $i ++ ;
        $response =  new stdClass();
        $response->id = $i;
        $response->name = $value['name'];
        $with_subject = clean($value['Arborescence de la slide']);
       
        switch ($with_subject) {
            case strpos($with_subject ,  clean('Palais de lEurope')) == true :
                $response->poi_id = 1;
                break;
            case strpos($with_subject ,  clean('L’Orient Palace')) == true :
                $response->poi_id = 2;
                break;
            case strpos($with_subject,  clean('Musée Cocteau')) == true: 
                $response->poi_id = 3;
                break;
            case strpos($with_subject,  clean('Place des Logettes')) == true:
                $response->poi_id = 4;
                break;
            case  strpos($with_subject,  clean('Traverse du Vieux-Château')) == true:
                $response->poi_id = 5;
                break;
            case  strpos($with_subject,  clean('Point de vue')) == true:
                $response->poi_id = 6;
                break;
            case  strpos($with_subject,  clean('Parvis Basilique')) == true:
                $response->poi_id = 7;
                break;
            case  strpos($with_subject,  clean('Palais des princes')) == true:
                $response->poi_id = 8 ;
                break;
            case  strpos($with_subject,  clean('Place de la mairie')) == true:
                $response->poi_id = 9;
                break;
            case strpos($with_subject,  clean('Palais Lascaris')) == true:
                $response->poi_id = 10;
                break;
            case strpos($with_subject,  clean('Rue du Général Sarrail')) == true:
                $response->poi_id = 11;
                break; 
            case strpos($with_subject,  clean('Entrée du village')) == true:
                $response->poi_id = 12;
                break;
            case strpos($with_subject,  clean('Hôtel de ville')) == true:
                $response->poi_id = 13;
                break;
            case  strpos($with_subject,  clean('Point de vue')) == true:
                $response->poi_id = 14;
                break;
            case  strpos($with_subject,  clean('Fort')) == true:
                $response->poi_id = 15;
                break;
            case strpos($with_subject,  clean('Centre historique')) == true:
                $response->poi_id = 16;
                break;
            case strpos($with_subject,  clean('Ruines du château')) == true:
                $response->poi_id = 17;
                break;
            case strpos($with_subject,  clean('Orme centenaire')) == true:
                $response->poi_id = 18;
                break;
            case strpos($with_subject,  clean('Eglise Saint-Barthélemy')) == true:
                $response->poi_id = 19;
                break;
            case strpos($with_subject,  clean('Tour des Lascaris')) == true:
                $response->poi_id = 20;
                break;
            case  strpos($with_subject,  clean('Trophée d’Auguste')) == true:
                $response->poi_id = 21;
                break;
            case strpos($with_subject,  clean('Saint-Jean Baptiste')) == true:
                $response->poi_id = 22;
                break;
            case strpos($with_subject,  clean('Église Saint-Michel')) == true:
                $response->poi_id = 23;
                break;
            case strpos($with_subject,  clean('Mairie')) == true:
                $response->poi_id = 24;
                break;
            case  strpos($with_subject,  clean('Sanctuaire Saint-Joseph')) == true:
                $response->poi_id = 25;
                break;
            case  strpos($with_subject,  clean('Train cremaillere')) == true:
                $response->poi_id = 26;
                break;
            case  strpos($with_subject,  clean('lace des deux')) == true:
                $response->poi_id = 27;
                break;
            case  strpos($with_subject,  clean('Rue du château')) == true:
                $response->poi_id = 28;
                break;
            case  strpos($with_subject,  clean('Église Sainte-Marguerite')) == true:
                $response->poi_id = 29;
                break;
            case strpos($with_subject,  clean('Place de la liberté')) == true:
                $response->poi_id = 30;
                break;
            case  strpos($with_subject,  clean('Cadran Solaire')) == true:
                $response->poi_id = 31;
                break;
            case strpos($with_subject,  clean('Hauteurs du village')) == true:
                $response->poi_id = 32;
                break;
            case  strpos($with_subject,  clean('Pont de Sospel')) == true:
                $response->poi_id = 33;
                break;
            case  strpos($with_subject,  clean('Cathédrale Saint-Michel')) == true:
                $response->poi_id = 34;
                break;
            case  strpos($with_subject,  clean('Centre historique')) == true:
                $response->poi_id = 35;
                break;
            case  strpos($with_subject,  clean('Eglise Santa-Maria-in-Albis')) == true:
                $response->poi_id = 36;
                break;
            case strpos($with_subject,  clean('Sentier Saint-Antoine l’Ermite')) == true:
                $response->poi_id = 37;
                break;
            case  strpos($with_subject,  clean('Lavoir')) == true:
                $response->poi_id = 38;
                break;
            case strpos($with_subject,  clean('Couvent des franciscains')) == true:
                $response->poi_id = 39;
                break;
            case  strpos($with_subject,  clean('Centre historique')) == true:
                $response->poi_id = 40;
                break;
            case  strpos($with_subject,  clean('Eglise Notre-Dame de la visitation')) == true:
                $response->poi_id = 41;
                break;
            case  strpos($with_subject,  clean('JB Pachiaudi')) == true:
                $response->poi_id = 42;
                break;
            case  strpos($with_subject,  clean('château Lascaris')) == true:
                $response->poi_id = 43;
                break;
            case  strpos($with_subject,  clean('Place de Nice')) == true:
                $response->poi_id = 44;
                break;
            default:
               echo $response->name;
        }

        switch ($value['Type de slide']) {
            case preg_match('/QCM/', $value['Type de slide']):
                $response->type_slide_id = 2;
                break;

            case preg_match('/Info/', $value['Type de slide']):
                $response->type_slide_id = 1;
                break;

            case preg_match('/Question ouverte/', $value['Type de slide']):
                $response->type_slide_id = 4;
                break;

            case preg_match('/QCM Photos/', $value['Type de slide']):
                $response->type_slide_id = 5;
                break;

            case preg_match('/Orientation/', $value['Type de slide']):
                $response->type_slide_id = 3;
                break;
        }

        
        $response->text = $value['Texte slide'];
        if (!empty($value['Pop-up Good answer'])) {
            $reponse->text_success = $value['Pop-up Good answer'];
        }else  $reponse->text_success = "";
        
        $reponse->text_fail = $value['Pop-up Wrong answer'];
        $response->time = null;
        $response->step = $value['Step'];
        $response->penality = 0;
        $response->response = $value['response'];
        $solution  = explode(';',  $value['response']);
        $response->solution = $solution[0];
        array_push($array_response, $response);
        
    }
   
   
}

foreach ($array_response as  $value) {
    if (!empty($value->poi_id) and !empty($value->name)) {
        echo ($value->name . ' ------------------POI = ' . $value->poi_id);
        echo '<br><br><br>';
    }
   
}