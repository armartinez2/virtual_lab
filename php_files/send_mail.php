<!DOCTYPE html>
<html>
<?php
require_once 'swiftmailer/lib/swift_required.php';

//grab data
$my_name = "user";
$my_email = $_GET["email"];
$my_message = "test message";

//make body
$body = "Name: ".$my_name."<br />"."Email: ".$my_email."<br />"."Message: ".$my_message;
echo $body;

//create transport
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com',465,'ssl);
//$transport->setUsername('cmuxen@gmail.com');
//$transport->setPassword('_One1Won_');
echo "transport made";
/*
//create mailer
$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance('Web Lead')
        ->setFrom(array('cmuxen@gmail.com'=>'hello world'))
        ->setTo(array('malex5183@gmail.com','cmuxen@gmail.com'=>'recipiants'))
        ->setSubject('this is the subject')
        ->setBody($date,'text/html');

//send message
$result = $mailer->send($message);
*/
?>
</html>

