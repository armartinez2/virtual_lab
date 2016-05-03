/*
this section of code is made with the purpose of creating a new user
adding them to a database, and sending a signal to the server to 
create two new machines
*/
<!DOCTYPE html>
<html>
<body>
<?php
include 'message_class.php';
/*
this section checks to see if the username has been used before
if it has it sends back an error message
*/
function check_username($user){
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "mysql_login";
	$table = "login_info";
	$conn = new mysqli($servername, $username, $password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$statement = "SELECT username from $table where username='$username'";
	$result = $conn->query($statement);
	if ($result->num_rows > 0){
		echo "the username is already in use";
		$conn->close();
		header("Location:new_user.html");
		exit();
	}
	$conn->close();
}

/*
this sections checks the passwords to make sure that they match if
the two entries do not match it has an error message and sends the
user back to the new_user.html page
*/
function check_pass($pass1,$pass2){
	if($pass1 != $pass2){
		echo "the passwords do not match please fix";
		header("Location:new_user.html");
		exit();
	}
}
/*
this section adds the user to the mysql database
*/
function add_user($user,$first,$last,$email,$pass,$uid){
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "mysql_login";
	$table = "login_info";
	$pass = hash('sha256',$pass);
	$conn = new mysqli($servername, $username, $password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$statement = "INSERT INTO $table (username,password,first_name,last_name,email,admin,uid) VALUES('$user','$pass','$first','$last','$email',0,'$uid')";
	if ($conn->query($statement) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $statement . "<br>" . $conn->error;
	}
	$conn->close();
}
/*
this section creates a userid for the user it gets a random integer and
then checks the database to ensure that the user id has not been used by
other users
*/
function get_uid(){
	$uid = rand(510,1000);
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "mysql_login";
	$table = "login_info";
	$conn = new mysqli($servername, $username, $password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$statement = "SELECT * from $table where uid=$uid";
	$result = $conn->query($statement);
	if ($result->num_rows > 0){
		echo "the username is already in use";
		$conn->close();
		$uid = get_uid();
	}
	$conn->close();
	return $uid;
}
/*
this section creates a ssh request sending over a message to the
xen server to create a new user on xen with the username and
password and then runs a script to clone two virtual machines
based on two master operating systems we premade
*/
function add_to_xen($username, $password, $uid){
	$user = 'root';
	$pass = '_One1Won_';
	$cmd = "cd /home; ./add.sh $username $password $uid; ./clone.sh $username";
	$ip='192.168.7.176';
	$connection = ssh2_connect("192.168.7.176",22);
	ssh2_auth_password($connection,"root","_One1Won_");
	$stream = ssh2_exec($connection, $cmd);
	stream_set_blocking($stream,true);
	fclose($stream);

}

$username = $_GET["username"];
$first = $_GET["firstname"];
$last = $_GET["lastname"];
$email = $_GET["email"];
$pass1 = $_GET["password1"];
$pass2 = $_GET["password2"];
$uid = get_uid();
check_username($username);
check_pass($pass1,$pass2);
add_user($username,$first, $last,$email,$pass1,$uid);
add_to_xen($username,$pass1,$uid);
header("Location:../index.html");
exit();

$download = "http://localhost/sh_files/run.sh";
$width = "1";
$height="1";
$frame = "0";
$src = "/var/www/html/run.sh";
echo "<iframe width=$width height=$height frameborder=$frame src=$src>";
echo "<a href=$download download>download</a>";
echo "</iframe>";
echo "<a href=$download download>download</a>";

  ?>
</body>
</html>
