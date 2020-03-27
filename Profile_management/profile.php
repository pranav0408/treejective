<?php 
    $mysqli = new mysqli('localhost', 'root', '', 'treejective') or die("couldn't connect to database");
    session_start();
    if (isset($_SESSION['username']) && isset($_SESSION['email'])){
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $get_user = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
        if ($get_user->num_rows == 1){
            // fetching the profile data
            $profile_data = $get_user->fetch_assoc();         
        }
    } else {
        header('location: http://localhost:8080/mvc-php/php-project/main-page/');
    }
    $task = $profile_data['task'];
    $score = $profile_data['score']
?>




<!-- ===============Html Code=============== -->
<!DOCTYPE html>
<html>    
    <head>        
        <meta charset="UTF-8">
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
        
        <!-- Css -->
        <link rel="stylesheet" href="./css/profile_edit.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <!-- Title -->
        <title><?php echo $profile_data['username'] ?>'s Profile</title>

    
    </head>
    <body>
    <div class="nav">
        <span id="brand">
            <a href="../main-page/index.php">Treejective</a>
        </span>
        <ul class="item">
            <li>
                <?php echo "<a href='../main-page/destroy.php'><button id='session'>Logout</button></a>"; ?>
            </li>
            <li id="hamburger">
                <?php 
                    ?>
                    <h5> <?php echo $_SESSION['username']; ?>'profile</h5>
                    <?php
                ?>
            </li>
        </ul>
    </div>
        
        <h1 class="PI center">
            Profile Page
        </h1>    

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card profile-box">
                    <div class="card-body">
                        <!--==============The profile grid==============-->
                        <div class="row">
                            <div class="col-md-12">   
                                <div class="rounded center">
                                    <img src="https://api.adorable.io/avatars/285/abott@adorable.png" alt="profile-picture" class="img-fluid rounded-circle img-thumbnail shadow-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-sm-6 offset-sm-3 pro-dis card" style="z-index:-1; padding-top:9em;">
                                <div class="card-body">
                                    <div class="center">
                                        <div class="right">
                                            <p>Name: </p>
                                        </div>
                                        <div class="detail">
                                            <p><?php echo $profile_data['full_name']?></p>
                                        </div>
                                    </div>
                                    <div class="center">
                                        <div class="right">
                                            <p>Age:</p>
                                        </div>
                                        <div class="detail">
                                            <p><?php echo $profile_data['age'] ?></p>
                                        </div>
                                    </div>
                                    <div class="center">
                                        <div class="right">
                                            <p>Gender:</p>
                                        </div>
                                        <div class="detail">
                                            <p> <?php echo $profile_data['gender'] ?> </p>
                                        </div>
                                    </div>
                                    <div class="center">
                                        <div class="right">
                                            <p>Address:</p>
                                        </div>
                                        <div class="detail">
                                            <p>
                                                <address><?php echo $profile_data['address'] ?></address>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="center">
                                        <div class="right">
                                            <p>Score:</p>
                                        </div>
                                        <div class="detail">
                                            <p>
                                                <?php echo $profile_data['score'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="center">
                                        <div class="right">
                                            <p>Number of tasks completed: </p>
                                        </div>
                                        <div class="detail">
                                            <p>
                                                <?php echo $profile_data['task'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="h3 center">
                                            Badges
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="row center">
                        
                                    <div class="col-sm-2">
                                        <div class="">
                                            <img class="card-img" style="width:100%; height:auto;" src="./Images/new.svg" alt="New badge">
                                        </div>
                                    </div>

                                    <?php if($profile_data['score']>=40){ ?>
                                    <div class="col-sm-2">
                                        <div class="">
                                            <img class="card-img" style="width:100%; height:auto;" src="./Images/approved.svg" alt="New badge">
                                        </div>
                                    </div>
                                    <?php }?>

                                    <?php if($profile_data['score']>=100){ ?>
                                    <div class="col-sm-2">
                                        <div class="">
                                            <img class="card-img" style="width:100%; height:auto;" src="./Images/miscellaneous.svg" alt="New badge">
                                        </div>
                                    </div>
                                    <?php }?>

                                    <?php if($profile_data['score']>=160){ ?>
                                    <div class="col-sm-2">
                                        <div class="">
                                            <img class="card-img" style="width:100%; height:auto;" src="./Images/guarantee.png" alt="New badge">
                                        </div>
                                    </div>
                                    <?php }?>

                                    <?php if($profile_data['score']>=160){ ?>
                                    <div class="col-sm-2">
                                        <div class="">
                                            <img class="card-img" style="width:100%; height:auto;" src="./Images/reward.svg" alt="New badge">
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="container-fluid">
                            <div class="row ">
                                <div class="col-md-12 obj center">
                                    <p class="h3">Objectives</p>
                                </div>
                            </div>
                        </div>
                <!-- Objectives encoded in php -->
                        <?php
                            for ($i=1; $i<13;$i++){
                                {
                                    ?>
                                    <div class="row ">
                                        <div class="col-sm-8 offset-sm-2 blockquote obj-card card">
                                            <p class="center objectives card-body">
                                            <?php if($profile_data['obj'.$i]) {echo "<del>";} ?>
                                            <?php
                                                switch($i){
                                                    case 1: echo "Plant a Rose"; break;
                                                    case 2: echo "Plant a Neem tree"; break;
                                                    case 3: echo "Plant a Banyan tree"; break;
                                                    case 4: echo "Plant a vegetable plant"; break;
                                                    case 5: echo  "Plant a tree for 3 days Straight"; break;
                                                    case 6: echo "Water a plant for 7 days Straight"; break;
                                                    case 7: echo "Study about different types of seeds"; break;
                                                    case 8: echo "Plant 3 trees consecutively"; break;
                                                    case 9: echo "Reduce the use of plastic for more than a month"; break;
                                                    case 10: echo "Fertilize 4 different trees thrice in a month"; break;
                                                    case 11: echo "Water daily the plants that you have planted for 2 months"; break;
                                                    case 12: echo "Aware three person about the challenges and give feedback to them"; break;
                                                    default: break;
                                                }
                                            ?>
                                            <?php if(!$profile_data['obj'.$i]) {echo "</del>";} ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php        
                                }
                            }
                        ?>    


                        <!-- ================Profile Edit button================ -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php $visitor = $_SESSION['username'];
                                    if ($visitor)
                                    { ?>
                                        <div class="center">
                                            <button type="submit" class="btn submit btn-success">
                                                <a href="edit-profile.php?user=<?php echo $profile_data['username'] ?>">Edit Profile</a>
                                            </button>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>