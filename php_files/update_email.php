<!DOCTYPE html>
<html>
<h1>updating password</h1>
<?php

function get_newemail(){
        $new_email = $_GET["email"];
        return $new_email;
}

function replace_email($new_email){
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
        $sentence = "UPDATE $table SET email=$new_email WHERE username=$uname";
        //$result = mysqli_query($conn,$sentence);
        //mysqli_close($conn);
        echo $sentence;
}

function return2user(){
        //header("Location:incorrect_info.html");
        //exit();
        echo "return to user profile";
}

$new_email = get_email();
replace_email($new_email);
return2user();

?>
</html>

