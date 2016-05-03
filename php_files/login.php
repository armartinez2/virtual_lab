
<!DOCTYPE html>
<html>
<?php
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
?>
</html>

