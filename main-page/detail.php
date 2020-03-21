<?php
    session_start();
    require '../api/vendor/autoload.php';
    $client = new GuzzleHttp\Client();
    $id = $_GET['id'];
    $res = $client->get('https://trefle.io/api/plants/'.$id.'?token=cXJKcEZFM05KVnpmaWllVXAvVjJndz09');
    $status = $res->getStatusCode();           // 200
    $content = $res->getBody();                 // {"type":"User"...'

    $content = json_decode($content);

    foreach( $content as $key=>$value ){
        
        if ( $key == "scientific_name" ){
            $_GLOBALS['sci_name'] = $value;
        }
        if ( $key == "native_status" ){
            $_GLOBALS['native_status'] = $value;
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
                            $_GLOBALS['toxicity'] = $value;
                        }
                        if( $key == "shape_and_orientation"){
                            $_GLOBALS['shape_orientation'] = $value;
                        }
                        if( $key == "lifespan"){
                            $_GLOBALS['lifespan'] = $value;
                        }
                        if( $key == "growth_rate"){
                            $_GLOBALS['growth_rate'] = $value;
                        }
                        if( $key == "growth_period"){
                            $_GLOBALS['growth_period'] = $value;
                        }
                        if( $key == "growth_habit"){
                            $_GLOBALS['growth_habit'] = $value;
                        }
                        if( $key == "growth_form"){
                            $_GLOBALS['growth_form'] = $value;
                        }
                    }
                    echo "<br>";
                }

                if( $key=="family_common_name" ){
                    $_GLOBALS['family_common'] = $value;
                }
                if( $key=="duration" ){
                    $_GLOBALS['duration'] = $value;
                }
                if( $key=="common_name" ){
                    $_GLOBALS['common_name'] = $value;
                }   
            }
            echo "<br>";
        }
        if( $key == "images" ){
            // echo "<b>Images: </b>";
            // print_r($value);
            if( isset($value[0]) ){
                $_GLOBALS['$url'] = (array)$value[0];
                $_GLOBALS['img'] = $_GLOBALS['$url']['url'];
            }
        }
        
    } //foreach
?>

<!-- ############################# MAIN STRUCTURE ################################### -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/detail-style.css">
    <title> <?php echo $_GLOBALS['sci_name'] ?> </title>
</head>
<body>
    <nav>
        <span id="nav-brand">
            <a href="index.php">Treejective</a>
        </span>
        <ul class="nav-item">
            <li> <button id="session">
                    <?php 
                        if( isset($_SESSION['email']) ){
                            echo "<a href='destroy.php'>Logout</a>";
                        }
                        else{
                            echo "<a href='../login/newlogin.php'>Login/Signup</a>";
                        }
                    ?>
                </button> 
            </li>
            <li id="hamburger">
                <svg width="50" height="37" viewBox="0 0 50 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.69696 3C18.8384 3 32.9798 3 47.1212 3" stroke="#80BEA0" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.69696 18.2727C18.8384 18.2727 32.9798 18.2727 47.1212 18.2727" stroke="#80BEA0" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3 33.5455C10.3535 33.5455 17.7071 33.5455 25.0606 33.5455" stroke="#80BEA0" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                    
            </li>
        </ul>
    </nav>
    <div class="img-container">
        <div class="image">
            <?php 
                if(empty($_GLOBALS['img']))
                    echo "<h3>Sorry, No image is avalaible at this time..!</h3>";
                else{
                    ?>
                        <img src=" <?php echo $_GLOBALS['img'] ?> " >
                    <?php
                }
            ?>
        </div>
    </div>
    
    <div class="list-content">
        
        <div class="para">
            <p>
                The Family Common Name of &nbsp;
                <b>
                    <?php 
                        if(empty($_GLOBALS['sci_name']))
                            echo " NA ";
                        else{
                            echo $_GLOBALS['sci_name'];
                        }    
                    ?>
                </b>
                &nbsp; is &nbsp;
                <b>
                    <?php 
                        if(empty($_GLOBALS['family_common']))
                            echo " NA. ";
                        else{
                            echo $_GLOBALS['family_common'].".";
                        }    
                    ?>
                </b>
                &nbsp;Its common name is&nbsp; 
                <b>
                    <?php 
                        if(empty($_GLOBALS['common_name']))
                            echo " NA. ";
                        else{
                            echo $_GLOBALS['common_name'].".";
                        }    
                    ?>
                </b>
                &nbsp;The duration of&nbsp;
                <b>
                    <?php 
                        if(empty($_GLOBALS['sci_name']))
                            echo " NA. ";
                        else{
                            echo $_GLOBALS['sci_name'];
                        }    
                    ?>
                </b>
                &nbsp;is&nbsp;
                <b>
                    <?php 
                        if(empty($_GLOBALS['duration']))
                            echo " NA. ";
                        else{
                            echo $_GLOBALS['duration'].".";
                        }    
                    ?>
                </b>
            </p>

<!-- ################################# SPECIFICATIONS ####################################  -->

            <h2>Specifications:</h2>
            <ul>
                <li><b>Native Status</b> : 
                    <?php 
                        if(empty($_GLOBALS['native_status']))
                            echo " NA. ";
                        else{
                            echo $_GLOBALS['native_status'].".";
                        }    
                    ?>
                </li>
                <li><b>Toxicity</b> : 
                    <?php 
                        if(empty($_GLOBALS['toxicity']))
                            echo " NA. ";
                        else{
                            echo $_GLOBALS['toxicity'].".";
                        }    
                    ?>
                </li>
                <li><b>Shape and Orientation</b> : 
                    <?php 
                        if(empty($_GLOBALS['shape_orientation']))
                            echo " NA. ";
                        else{
                            echo $_GLOBALS['shape_orientation'].".";
                        }    
                    ?>
                </li>
                <li><b>Lifespan</b> : 
                    <?php 
                        if(empty($_GLOBALS['lifespan']))
                            echo " NA. ";
                        else{
                            echo $_GLOBALS['lifespan'].".";
                        }    
                    ?>
                </li>
                <li><b>Growth Rate</b> : 
                    <?php 
                        if(empty($_GLOBALS['growth_rate']))
                            echo " NA. ";
                        else{
                            echo $_GLOBALS['growth_rate'].".";
                        }    
                    ?>
                </li>
                <li><b>Growth Period</b> : 
                    <?php 
                        if(empty($_GLOBALS['growth_period']))
                            echo " NA. ";
                        else{
                            echo $_GLOBALS['growth_period'].".";
                        }    
                    ?>
                </li>
                <li><b>Growth Habit</b> : 
                    <?php 
                        if(empty($_GLOBALS['growth_habit']))
                            echo " NA. ";
                        else{
                            echo $_GLOBALS['growth_habit'].".";
                        }    
                    ?>
                </li>
                <li><b>Growth Form</b> : 
                    <?php 
                        if(empty($_GLOBALS['growth_form']))
                            echo " NA. ";
                        else{
                            echo $_GLOBALS['growth_form'].".";
                        }    
                    ?>
                </li>
            </ul>
        </div>

    </div>

</body>
</html>