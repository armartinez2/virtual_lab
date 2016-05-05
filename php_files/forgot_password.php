<!--
the goal of this page is to send an email to users who
have forgotten there password it first gets there email
and then sends them an email with a link were they can update
there password
-->
<!DOCTYPE html>
<html>
<body>
  <?php
	require_once('../swiftmailer/lib/swift_required.php');

    function send_message($email, $username, $password){
	$password = "_One1Won_";
	$from = "<cmuxen@gmail.com>";
	$to = $email;
	$message = "your username is $username and your password is $password";
	$subject = "your username and password";
	$ssl = "ssl://smtp.gmail.com";
	echo "made ssl <br>";
	$headers = array("From"=>"cmuxen@gmail.com","To"=>$email,"Subject"=>$subject);
	echo "headers made <br>";
	$smtp = Mail::factory("smtp",array("host"=>$ssl,"port" => "465", "auth" => true, "username" => "cmuxen@gmail.com","password" => "_One1Won_"));
	echo "email set <br>";
	$mail = $smtp->send($email,$headers,message);
	echo "email should have sent <br>";
	if (PEAR::isError($email)){
		echo "error";
	} else {
		echo "message sent";
	}
    }

function swift_mail($email, $username, $password){
	// Create the mail transport configuration
	$transport = Swift_MailTransport::newInstance();
	echo "transport created<br>";
	// Create the message
	$message = Swift_Message::newInstance();
	echo "message created <br>";
	$message->setTo(array(
  		"cmuxen@gmail.com" => "Xen",
  		$email => "$username"
	));
	echo "set to <br>";
	$message->setSubject("This email is sent using Swift Mailer");
	$message->setBody("You're our best client ever.");
	$message->setFrom("cmuxen@gmail.com", "xen");
	echo "from set <br>";
	// Send the email
	$mailer = Swift_Mailer::newInstance($transport);
	echo "mailer made <br>";
	$mailer->send($message);
	echo "message sent <br>";
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
		if($result->num_rows == 0){
			echo "the email you put in is not in our database please go back and fix this";
			//header("Location:forgot_password.html");
			//exit();
		}
		else{
			while($row = mysqli_fetch_assoc($result)){
           			swift_mail($row["email"], $row["username"],$row["password"]);
			}
		}
	}
	$email = $_GET["email"];
	check_email($email);
  ?>
</body>
</html>
