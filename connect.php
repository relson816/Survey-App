<?php
session_start();

// variable declaration
$name = "";
$email = "";
$errors = array(); 
$_SESSION['success'] = "";

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'crud');

// REGISTER USER
if (isset($_POST['reg_user'])) {
	// receive all input values from the form
	$name = mysqli_real_escape_string($db, $_POST['form-name']);
	$email = mysqli_real_escape_string($db, $_POST['form-email']);
	$password = mysqli_real_escape_string($db, $_POST['form-password']);

	// form validation: ensure that the form is correctly filled
	if (empty($name)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password)) { array_push($errors, "Password is required"); }


	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password);//encrypt the password before saving in the database
		$query = "INSERT INTO user (name, email, password) 
				  VALUES('$name', '$email', '$password')";
		mysqli_query($db, $query);

		$_SESSION['name'] = $name;
		$_SESSION['success'] = "You are now logged in";
		header('location: index.html');
	}

}

?>