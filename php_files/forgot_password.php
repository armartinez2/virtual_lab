<!DOCTYPE html>
<html>
<body>
  <?php
    function send_message($email, $username, $password){
	$password = "_One1Won_";
	$from = "<cmuxen@gmail.com>";
	$to = $email;
	$message = "your username is $username and your password is $password";
	$subject = "your username and password";
	$ssl = "ssl://smtp.gmail.com";
	$headers = array("From"=>"cmuxen@gmail.com","To"=>$email,"Subject"=>$subject);
	$smtp = Mail::factory("smtp",array("host"=>$ssl,"port" => "465", "auth" => true, "username" => "cmuxen@gmail.com","password" => "_One1Won_"));
	echo "email set";
	$mail = $smtp->send($email,$headers,message);
	echo "email should have sent";
	if (PEAR::isError($email)){
		echo "error";
	} else {
		echo "message sent";
	}
    }

    function check_email($email){
		$servername = "localhost";
		$username = "root";
		$password = "password";
		$dbname = "mysql_login";
		$table = "login_info";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$statement = "SELECT * FROM $table WHERE email='$email'";
		$result = $conn->query($statement);
		if($result->num_rows < 1){
			echo "the email you put in is not in our database please go back and fix this";
			//header("Location:forgot_password.html");
			//exit();
		}
		else{
			while($row = mysqli_fetch_assoc($result)){
				echo "email found";
           			send_message($row["email"], $row["username"],$row["password"]);
			}
		}
	}
	$email = $_GET["email"];
	echo $email;
	check_email($email);
  ?>
</body>
</html>
