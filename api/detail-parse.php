<?php

    require 'vendor/autoload.php';
    $client = new GuzzleHttp\Client();
    $res = $client->get('https://trefle.io/api/plants/167019?token=cXJKcEZFM05KVnpmaWllVXAvVjJndz09');
    $status = $res->getStatusCode();           // 200
    $content = $res->getBody();                 // {"type":"User"...'

    $content = json_decode($content);

    foreach( $content as $key=>$value ){
        
        if ( $key == "scientific_name" ){
            echo "<b>Scientific name</b> : $value <br>";
        }
        if ( $key == "native_status" ){
            echo "<b>Native Status</b> : $value <br>";
        }
        if( $key == "main_species" ){
            // print_r($key);
            echo "<br>";
            $value = (array)$value;
            // print_r($value);
            foreach( $value as $key=>$value ){
                // echo "<b>$key</b><br>";
                // print_r($value);
                // echo "<br><br>";

                if( $key == "specifications" ){
                    $value = (array)$value;
                    foreach($value as $key=>$value){
                        if( $key == "toxicity"){
                            echo "<b>Toxicity</b>: $value <br>";
                        }
                        if( $key == "shape_and_orientation"){
                            echo "<b>Shape and orientation</b>: $value <br>";
                        }
                        if( $key == "lifespan"){
                            echo "<b>Lifespan</b>: $value <br>";
                        }
                        if( $key == "growth_rate"){
                            echo "<b>Growth Rate</b>: $value <br>";
                        }
                        if( $key == "growth_period"){
                            echo "<b>Growth Period</b>: $value <br>";
                        }
                        if( $key == "growth_habit"){
                            echo "<b>Growth habit</b>: $value <br>";
                        }
                        if( $key == "growth_form"){
                            echo "<b>Growth Form</b>: $value <br>";
                        }
                    }
                    echo "<br>";
                }

                if( $key=="family_common_name" ){
                    echo "<b>Common family name: </b> $value <br>";
                }
                if( $key=="duration" ){
                    echo "<b>Duration: </b> $value <br>";
                }
                if( $key=="common_name" ){
                    echo "<b>Common name: </b> $value <br>";
                }   
            }
            echo "<br>";
        }
        if( $key == "images" ){
            echo "<b>Images: </b>";
            // print_r($value);
            if( isset($value[0]) ){
                $_GLOBALS['$url'] = (array)$value[0];
                echo $_GLOBALS['$url']['url'];
            }
        }
        
    } //foreach
?>

