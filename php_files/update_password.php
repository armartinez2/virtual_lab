<!DOCTYPE html>
<html>
<h1>updating password</h1>
<?php

function get_newpassword(){
	$new_pass1 = $_GET["password"];
	$new_pass2 = $_GET["password"];
	if ($new_pass1 == $new_pass2){
		return $new_pass1;
	}
	else{
		echo "the passwords you entered do not match please go back and fix this";
	}
}

function replace_password($new_pass){
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "mysql_login";
	$table = "login_info";
	$uname = $_GET["username"];
	$conn = mysqli_connect($servername, $username, $password,$dbname);
	if (! $conn){
        	die("connection failed: " . mysql_error());
	}
	$sentence = "UPDATE $table SET password=$new_pass WHERE username=$uname";
	//$result = mysqli_query($conn,$sentence);
	//mysqli_close($conn);
	echo $sentence;
}

function return2user(){
	//header("Location:incorrect_info.html");
        //exit();
	echo "return to user profile";
}

$new_pass = get_newpassword();
replace_password($new_pass);
return2user();

?>
</html>

