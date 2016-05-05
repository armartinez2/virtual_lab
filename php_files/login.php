<!--
this page is used to login the users into there profile
-->

<!DOCTYPE html>
<html>
<?php


/*
this section is used to compare the password and
compare it to the hashed password stored in the database
if they do not have the correct password that corresponds to
the username that was typed in then they are not logged in 
at the same time it looks for a section called admin in the database
that indicates whether a uer is an admin or a user. 1 is for an admin
and 0 is for a user

*/

function compare_pass($uname,$upass,$admin){

	if ($uname == $_GET["userid"] and $upass == hash('sha256',$_GET["pswrd"]) and $admin == "1"){
		header("Location:../html_files/admin_user.php");
		exit();
	}
	elseif ($uname == $_GET["userid"] and $upass == hash('sha256',$_GET["pswrd"]) and $admin != "1"){
		header("Location:../html_files/student_page.html");
		exit();
	}
	else{
		header("Location:../html_files/incorrect_info.html");
		exit();
	}
}
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "mysql_login";
$table = "login_info";
//this section makes a connection to the database
//and then grabs the password and admin rights for the 
//username that has been typed in
//============================================================
$conn = mysqli_connect($servername, $username, $password,$dbname);
if (! $conn){
	die("connection failed: " . mysql_error());
}
$user = $_GET["userid"];
$statement = "SELECT * FROM $table WHERE username = '$user'";
$result = mysqli_query($conn,$statement);
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){
		compare_pass($row["username"],$row["password"],$row["admin"]);
	}
} else {
	header("Location:incorrect_info.html");
        exit();
}
mysqli_close($conn);
//=============================================================
?>
</html>

