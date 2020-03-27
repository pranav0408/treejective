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
            <li>
                <?php 
                    if( isset($_SESSION['email'])  && isset($_SESSION['username'])){
                        echo "<a href='destroy.php'><button id='session'>Logout</button></a>";
                    }
                    else{
                        echo "<a href='../login/newlogin.php'><button id='session'>Login/Signup</button></a>";
                    }
                ?>
            </li>
            <?php 
                if( isset($_SESSION['email']) && isset($_SESSION['username'])){
                ?>
                <a href="../Profile_management/profile.php">
                    <li id="hamburger">
                        <h3> <?php echo $_SESSION['username']; ?> </h3>
                        <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M33.5094 0H3.49057C1.56278 0 0 1.56278 0 3.49057V33.5094C0 35.4372 1.56278 37 3.49057 37H33.5094C35.4372 37 37 35.4372 37 33.5094V3.49057C37 1.56278 35.4372 0 33.5094 0Z" fill="#80BEA0"/>
                            <path d="M31.4151 30.0189V28.6429C31.4151 28.2568 31.1869 27.9113 30.8421 27.7744C26.7961 26.1653 22.3046 24.1673 21.9271 22.9226V21.6164C22.7664 20.7326 23.4284 19.5004 23.8203 18.0574C24.7615 17.3774 24.9956 15.9756 24.2164 14.9892V12.0655C24.2164 9.04756 22.5833 6.98114 18.8495 6.98114C15.2121 6.98114 13.4806 9.04756 13.4806 12.0655V14.9899C12.7032 15.9749 12.9367 17.376 13.8768 18.0567C14.2685 19.5004 14.931 20.7326 15.7709 21.6164V22.9219C15.3944 24.1659 10.9019 26.1639 6.85603 27.7737C6.51123 27.912 6.28302 28.2568 6.28302 28.6429V30.0189" stroke="white" stroke-width="2"/>
                        </svg>
                    </li>
                </a>                 
                <?php
                }
            ?>
            
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