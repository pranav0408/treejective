<?php

session_start();

// initialising var
//$first = $last = $email = $pwd1 = $pwd2 = "";
$errors = array();

//connect to database

$db = mysqli_connect('localhost','root','','treejective') or die("couldn't connect to database");

//registering user
if(isset($_POST['signup']))
{
	$first = mysqli_real_escape_string($db,$_POST['firstname']);
	$last = mysqli_real_escape_string($db,$_POST['lastname']);
	$email = mysqli_real_escape_string($db,$_POST['email']);
	$pwd1 = mysqli_real_escape_string($db,$_POST['pwd']);
	$pwd2 = mysqli_real_escape_string($db,$_POST['cpwd']);

	// form validation

	if(empty($first)){ 
		array_push($errors, "user's first name is required");
	}
	else if (!preg_match("/^[a-zA-Z ]*$/",$first)) {
		array_push($errors, "Only letters and white space allowed");
	}
	if(empty($last)){ 
		array_push($errors, "user's last name is required");
	}
	else if (!preg_match("/^[a-zA-Z ]*$/",$first)) {
		array_push($errors, "Only letters and white space allowed");
	}

	if(empty($email)){ 
		array_push($errors, "user's email is required");
	}
	else if(!empty($email)){
		$email = filter_var($email,FILTER_SANITIZE_EMAIL);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			array_push($errors, "email is invalid");
		}	
	}


	if(empty($pwd1)){
		array_push($errors, "user's password is required");
	}
	else if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $pwd1) === 0){
		array_push($errors,"Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit");
	}

	if(empty($pwd2)){ array_push($errors, "user's confirmation password is required");}


	if($pwd1 != $pwd2)
	{
		array_push($errors, "passwords need to be the same");
	}

	// check db for existing user with same username

	$user_check_query = "SELECT * FROM user WHERE email = '$email' LIMIT 1 ";
	$result = mysqli_query($db,$user_check_query);
	$user = mysqli_fetch_assoc($result);

	if($user)
	{
		if($user['email'] === $email){
			array_push($errors, "user already exists");
		}
	}

	//register the user if no error

	if(count($errors) == 0){
		$password = md5($pwd1); // this will encrypt the password
		$query = "INSERT INTO user (firstname , lastname , email, password) VALUES ('$first','$last', '$email', '$password')";
		mysqli_query($db,$query);
		$_SESSION['name'] = $first." ".$last;
		$_SESSION['email'] = $email;

		header('location: http://localhost:8080/mvc-php/php-project/main-page/');
		exit;

	}

	var_dump($errors);
	header('location: newsignup.php?errors='.implode("|", $errors));
	/*else if(count($errors) != 0)
		{
			var_dump($errors);
		header('location: signup.php ');
		}*/

}

//LOGIN USER

if(isset($_POST['loginuser'])){
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['userpwd']);

// error checking
	if(empty($username)){
		array_push($errors, "username is required");
	}
	else if(!empty($username)){
		$username = filter_var($username,FILTER_SANITIZE_EMAIL);
		if(!filter_var($username, FILTER_VALIDATE_EMAIL)){
			array_push($errors, "username is invalid");
		}	
	}
	if(empty($password)){
		array_push($errors, "password is required");
	}
	else if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password) === 0){
		array_push($errors,"Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit");
	}


	if(count($errors) == 0){
		$password = md5($password);
		$query = "SELECT * FROM user WHERE email = '$username' AND password = '$password' ";
		$result = mysqli_query($db, $query);
		if(mysqli_num_rows($result)){
			$_SESSION['email'] = $username;
			header('location: http://localhost:8080/mvc-php/php-project/main-page/');
			exit;
		}
		else{
			array_push($errors, "wrong username or password . Please try again");
		}
	}

	var_dump($errors);
	header('location: newlogin.php?errors='.implode("|", $errors));
	/*else if(count($errors) != 0)
	{
		var_dump($errors);
		header('location: login.php ');
	}
*/
}
?>


