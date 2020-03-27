<?php
    $mysqli = new mysqli('localhost', 'root', '', 'treejective') or die("couldn't connect to database");
    session_start();
    if (isset($_SESSION['username']) && isset($_SESSION['email']) ) {
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $get_user = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
        $user_data = $get_user->fetch_assoc();
    } else {
        header('location: http://localhost:8080/mvc-php/php-project/main-page/');
    }
?>
<!DOCTYPE html>
<html>
    <head>  
        <meta charset="UTF-8">

             <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
        
        <!-- Css -->
        <link rel="stylesheet" href="./css/profile_edit.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <title><?php echo $user_data['username'] ?>'s Profile Settings</title>
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
    

        <h1 class="PI center">Update Profile Information</h1> 

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card profile-box">
                    <div class="card-body">
                        <form method="post" action="update-profile-action.php?user=<?php echo $user_data['username'] ?>">   
                            <div class="form-group row">
                                <label for="fullname" class="col-sm-2 offset-sm-2 col-form-label">Name:</label><br> 
                                <div class="col-sm-6">
                                    <input type="text" id="fullname" class="form-control" name="fullname" value="<?php echo $user_data['full_name'] ?>" />
                                </div>
                                <!-- <small class="form-text text-muted">We'll never share your details with anyone else.</small> -->
                            </div>         
                            <div class="form-group row"> 
                                <label class="col-sm-2 offset-sm-2 col-form-label" for="age">Age:</label><br>
                                <div class="col-sm-6">
                                    <input type="text" id="age" class="form-control" name="age" value="<?php echo $user_data['age'] ?>" /><br> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 offset-sm-2 col-form-label" >Gender:</label><br> 
                                <div class="col-sm-6">
                                    <input type="select" class="form-control" name="gender" value="<?php echo $user_data['gender'] ?>" /><br>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 offset-sm-2 col-form-label" >Address:</label><br>          
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="address" value="<?php echo $user_data['address'] ?>" /><br><br>  
                                </div>
                            </div>
                            <div class="form-group  card container-fluid">
                                <div class="row card-body">
                                    <div class="col-sm-8 center">
                                        <p for="obj1" class="form-control text-center " >Plant a Rose</p>
                                    </div>    
                                    <div class="col-sm-4 center">
                                        <select name="obj1" class="custom-select" id="obj1">
                                            <option selected value=<?php echo $user_data['obj1'];?>><?php if($user_data['obj1']){echo "Done";}else{echo"To be done";} ?>(Current Stat)</option>
                                            <option value="0">To be done</option>
                                            <option value="1">Done</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  card container-fluid">
                                <div class="row card-body">
                                    <div class="col-sm-8 center">
                                        <p for="obj2" class="form-control text-center " >Plant a Neem tree</p>
                                    </div>    
                                    <div class="col-sm-4 center">
                                        <select name="obj2" class="custom-select" id="obj2">
                                            <option selected value=<?php echo $user_data['obj2'];?>><?php if($user_data['obj2']){echo "Done";}else{echo"To be done";} ?>(Current Stat)</option>
                                            <option value="0">To be done</option>
                                            <option value="1">Done</option>
                                        </select>
                                    </div>
                                </div>
                            </div><div class="form-group  card container-fluid">
                                <div class="row card-body">
                                    <div class="col-sm-8 center">
                                        <p for="obj3" class="form-control text-center " >Plant a Banyan tree</p>
                                    </div>    
                                    <div class="col-sm-4 center">
                                        <select name="obj3" class="custom-select" id="obj3">
                                            <option selected value=<?php echo $user_data['obj3'];?>><?php if($user_data['obj3']){echo "Done";}else{echo"To be done";} ?>(Current Stat)</option>
                                            <option value="0">To be done</option>
                                            <option value="1">Done</option>
                                        </select>
                                    </div>
                                </div>
                            </div><div class="form-group  card container-fluid">
                                <div class="row card-body">
                                    <div class="col-sm-8 center">
                                        <p for="obj4" class="form-control text-center " >Plant a vegetable plant</p>
                                    </div>    
                                    <div class="col-sm-4 center">
                                        <select name="obj4" class="custom-select" id="obj4">
                                            <option selected value=<?php echo $user_data['obj4'];?>><?php if($user_data['obj4']){echo "Done";}else{echo"To be done";} ?>(Current Stat)</option>
                                            <option value="0">To be done</option>
                                            <option value="1">Done</option>
                                        </select>
                                    </div>
                                </div>
                            </div><div class="form-group  card container-fluid">
                                <div class="row card-body">
                                    <div class="col-sm-8 center">
                                        <p for="obj5" class="form-control text-center " >Plant a tree for 3 days Straight</p>
                                    </div>    
                                    <div class="col-sm-4 center">
                                        <select name="obj5" class="custom-select" id="obj5">
                                            <option selected value=<?php echo $user_data['obj5'];?>><?php if($user_data['obj5']){echo "Done";}else{echo"To be done";} ?>(Current Stat)</option>
                                            <option value="0">To be done</option>
                                            <option value="1">Done</option>
                                        </select>
                                    </div>
                                </div>
                            </div><div class="form-group  card container-fluid">
                                <div class="row card-body">
                                    <div class="col-sm-8 center">
                                        <p for="obj6" class="form-control text-center " >Water a plant for 7 days Straight</p>
                                    </div>    
                                    <div class="col-sm-4 center">
                                        <select name="obj6" class="custom-select" id="obj6">
                                            <option selected value=<?php echo $user_data['obj6'];?>><?php if($user_data['obj6']){echo "Done";}else{echo"To be done";} ?>(Current Stat)</option>
                                            <option value="0">To be done</option>
                                            <option value="1">Done</option>
                                        </select>
                                    </div>
                                </div>
                            </div><div class="form-group  card container-fluid">
                                <div class="row card-body">
                                    <div class="col-sm-8 center">
                                        <p for="obj7" class="form-control text-center " >Study about different types of seeds</p>
                                    </div>    
                                    <div class="col-sm-4 center">
                                        <select name="obj7" class="custom-select" id="obj7">
                                            <option selected value=<?php echo $user_data['obj7'];?>><?php if($user_data['obj7']){echo "Done";}else{echo"To be done";} ?>(Current Stat)</option>
                                            <option value="0">To be done</option>
                                            <option value="1">Done</option>
                                        </select>
                                    </div>
                                </div>
                            </div><div class="form-group  card container-fluid">
                                <div class="row card-body">
                                    <div class="col-sm-8 center">
                                        <p for="obj8" class="form-control text-center " >Plant 3 trees consecutively</p>
                                    </div>    
                                    <div class="col-sm-4 center">
                                        <select name="obj8" class="custom-select" id="obj8">
                                            <option selected value=<?php echo $user_data['obj8'];?>><?php if($user_data['obj8']){echo "Done";}else{echo"To be done";} ?>(Current Stat)</option>
                                            <option value="0">To be done</option>
                                            <option value="1">Done</option>
                                        </select>
                                    </div>
                                </div>
                            </div><div class="form-group  card container-fluid">
                                <div class="row card-body">
                                    <div class="col-sm-8 center">
                                        <p for="obj9" class="form-control text-center " >Reduce the use of plastic for more than a month</p>
                                    </div>    
                                    <div class="col-sm-4 center">
                                        <select name="obj9" class="custom-select" id="obj9">
                                            <option selected value=<?php echo $user_data['obj9'];?>><?php if($user_data['obj9']){echo "Done";}else{echo"To be done";} ?>(Current Stat)</option>
                                            <option value="0">To be done</option>
                                            <option value="1">Done</option>
                                        </select>
                                    </div>
                                </div>
                            </div><div class="form-group  card container-fluid">
                                <div class="row card-body">
                                    <div class="col-sm-8 center">
                                        <p for="obj10" class="form-control text-center " >Fertilize 4 different trees thrice in a month</p>
                                    </div>    
                                    <div class="col-sm-4 center">
                                        <select name="obj10" class="custom-select" id="obj10">
                                            <option selected value=<?php echo $user_data['obj10'];?>><?php if($user_data['obj10']){echo "Done";}else{echo"To be done";} ?>(Current Stat)</option>
                                            <option value="0">To be done</option>
                                            <option value="1">Done</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  card container-fluid">
                                <div class="row card-body">
                                    <div class="col-sm-8 center">
                                        <p for="obj11" class="form-control text-center " >Water daily the plants that you have planted for 2 months</p>
                                    </div>    
                                    <div class="col-sm-4 center">
                                        <select name="obj11" class="custom-select" id="obj11">
                                            <option selected value=<?php echo $user_data['obj11'];?>><?php if($user_data['obj11']){echo "Done";}else{echo"To be done";} ?>(Current Stat)</option>
                                            <option value="0">To be done</option>
                                            <option value="1">Done</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  card container-fluid">
                                <div class="row card-body">
                                    <div class="col-sm-8 center">
                                        <p for="obj12" class="form-control text-center " >Aware three person about the challenges and give feedback to them</p>
                                    </div>    
                                    <div class="col-sm-4 center">
                                        <select name="obj12" class="custom-select" id="obj12">
                                            <option selected value=<?php echo $user_data['obj12'];?>><?php if($user_data['obj12']){echo "Done";}else{echo"To be done";} ?>(Current Stat)</option>
                                            <option value="0">To be done</option>
                                            <option value="1">Done</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 center">
                                    <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile" />
                                </div>
                            </div>
                                    
                        </form> 
                    </div>
                </div>
            </div>
        </div>

           
    </body>
</html>