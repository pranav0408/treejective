<?php
    $mysqli = new mysqli('localhost', 'root', '', 'treejective') or die("couldn't connect to database");
    if (isset($_POST['update_profile'])) 
    {
        $user = $_GET['user'];
        $fullname = $_POST['fullname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $obj1 = $_POST['obj1'];
        $obj2 = $_POST['obj2'];
        $obj3 = $_POST['obj3'];
        $obj4 = $_POST['obj4'];
        $obj5 = $_POST['obj5'];
        $obj6 = $_POST['obj6'];
        $obj7 = $_POST['obj7'];
        $obj8 = $_POST['obj8'];
        $obj9 = $_POST['obj9'];
        $obj10 = $_POST['obj10'];
        $obj11 = $_POST['obj11'];
        $obj12 = $_POST['obj12'];
        $task = $obj1 + $obj2 + $obj3 + $obj4 + $obj5 + $obj6 + $obj7 + $obj8 + $obj9 + $obj10 + $obj11 + $obj12;
        $score = ($obj1 + $obj2 + $obj3 + $obj4 + $obj5 + $obj6 + $obj7 + $obj8 + $obj9 + $obj10 + $obj11 + $obj12)*20;
        $update_profile = $mysqli->query("UPDATE users SET full_name = '$fullname',
                            gender = '$gender', age = $age, address = '$address', obj1 = '$obj1',
                            obj2 = '$obj2', obj3 = '$obj3', obj4 = '$obj4', obj5 = '$obj5', obj6 = '$obj6', obj7 = '$obj7',
                            obj8 = '$obj8', obj9 = '$obj9', obj10 = '$obj10', obj11 = '$obj11', obj12 = '$obj12', score=$score,
                            task = '$task'
                            WHERE username = '$user'");
    if ($update_profile) 
    {
    header("Location: profile.php?user=$user");
    } else {
            echo $mysqli->error;
        }
    }
?>