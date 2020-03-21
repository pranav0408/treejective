<?php

    // $response = file_get_contents('https://cors-anywhere.herokuapp.com/https://trefle.io/api/plants/123?token=cXJKcEZFM05KVnpmaWllVXAvVjJndz09');
    
    require 'vendor/autoload.php';
    $num = $_GET['num'];
    $client = new GuzzleHttp\Client();
    // $res = $client->get('https://trefle.io/api/plants/186798?token=cXJKcEZFM05KVnpmaWllVXAvVjJndz09');
    $res = $client->get('https://trefle.io/api/plants?token=cXJKcEZFM05KVnpmaWllVXAvVjJndz09&page_size='.$num.'&page=8');
    $status = $res->getStatusCode();           // 200
    $content = $res->getBody();                 // {"type":"User"...'

    // echo $content;
    $content = json_decode($content);
    // print_r($content);
    echo "<br>";
    foreach( $content as $item ){
        $item = (array) $item;
        foreach( $item as $key=>$value ){
            echo "<b>$key</b> : $value <br>";
        }
        print_r($item);
        echo " <br> <br>";
    }
?>

