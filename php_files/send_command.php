<html>
<?php

function send_command(){
include("Net/SSH2.php");
$username = "myuser2";
$password = "password";
$uid = 800;
//$connection = ssh2_connect("192.168.7.176",22);
//ssh2_auth_password($connection,"root","_One1Won_");
//$stream = ssh2_exec($connection, "./home/add.sh $username $paassword $uid");
//stream_set_blocking($stream,true);
//fclose($stream);

}

send_command();
?>
</html>
