<!DOCTYPE html>
<html>
<h1>updating password</h1>
<?php
//this section accesses the form and grabs the new password that
//has been typed in; then if the passwords typed in match then
//it returns the password to be stored otherwise it sends out
//an error message
function get_newpassword(){
	$new_pass1 = $_GET["password1"];
	$new_pass2 = $_GET["password2"];
	if ($new_pass1 == $new_pass2){
		return $new_pass1;
	}
	else{
		echo "the passwords you entered do not match please go back and fix this";
	}
}
//this section simply replace the old password with the newly updated password
function replace_password($new_pass){
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "mysql_login";
	$table = "login_info";
	$uname = $_GET["usrname"];
	echo $uname;
	$conn = mysqli_connect($servername, $username, $password,$dbname);
	if (! $conn){
        	die("connection failed: " . mysql_error());
	}
	$new_pass = hash('sha256', $new_pass);
	$sentence = "UPDATE $table SET password='$new_pass' WHERE username='$uname'";
	echo $sentence;
	if ($conn->query($sentence) === TRUE) {
		$conn->close();
		header("Location:../index.html");
		exit();
	} else {
		//echo "error";
	}
	mysqli_close($conn);
}

$new_pass = get_newpassword();
replace_password($new_pass);

?>
</html>

