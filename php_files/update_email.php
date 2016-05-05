<!DOCTYPE html>
<html>
<h1>updating password</h1>
<?php
//this section accesses the form and grabs the new password that
//has been typed in; then if the passwords typed in match then
//it returns the password to be stored otherwise it sends out
//an error message
function get_newemail(){
	$new_email1 = $_GET["email1"];
	$new_email2 = $_GET["email2"];
	if ($new_email1 == $new_email2){
		return $new_email1;
	}
	else{
		echo "the passwords you entered do not match please go back and fix this";
	}
}
//this section simply replace the old password with the newly updated password
function replace_email($new_email){
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "mysql_login";
	$table = "login_info";
	$uname = $_GET["usrname"];
	$conn = mysqli_connect($servername, $username, $password,$dbname);
	if (! $conn){
        	die("connection failed: " . mysql_error());
	}
	$sentence = "UPDATE $table SET email='$new_email' WHERE username='$uname'";
	if ($conn->query($sentence) === TRUE) {
		$conn->close();
		header("Location:../html_files/admin_user.php");
		exit();
	} else {
		echo "error";
	}
	mysqli_close($conn);
}

$new_email = get_newemail();
replace_email($new_email);

?>
</html>

