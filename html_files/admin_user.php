<!DOCTYPE html>
<html>

<head>
  <title>Admin Page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
            body {
              background-color: #202020;
            }
            .other-color{
              background: maroon;
            }
            div.relative {
                position: absolute;
                bottom: 200px;
		top: 200px;
                right: 0;
                left: 50%;
                width: 100px;
                height: 100px;
            }
	   div.absolute {
		position: relative;
		color: gold;
		text-indent: 20px;
		left: 5%;
		right: 0%;
		bottom: 200px;
		top: 50px;
	   }
            table {
              border: 1px solid black;
              border-collapse: collapse;
              color: black;
              background: green;
            }
            th {
              background: gold;
              color: maroon;
            }
            td {
              padding: 5px;
              color: gold;
            }
            tr {
              background: maroon;
            }
            .jumbotron h1 {
              font-family: "Times New Roman", Times, serif;
              color: gold;
              text-indent: 50px;
            }
            .jumbotron p{
              font-family: "Times New Roman", Times, serif;
              color: gold;
            }
            h1{
              font-family: "Times New Roman", Times, serif;
              color: gold;
              right: 200px;
            }
            label {
              width: 180px;
              clear: left;
              text-align: right;
              padding-right: 10px;
              color: gold
            }
            caption {
              color: gold;
            }
            input, label {
              float:left;
	      color: blue;
            }
      </style>
</head>

<div class="jumbotron other-color">
  <h1><b>Administrator Page</b></h1>
</div>

<body>
	<div class="absolute">
	<p><h4>

	To the right is a list of all of your users that are located <br>
	on this machine in order for users to access Xen Orchestra <br>
	they must first be users on the gateway. If necessary you can <br>
	delete any of these users if they have been misusing the xen<br> 
	server or if they are no longer using xen.<br>
</h4></p>
</div>
 <!-- <div class="container">
          <h1><b>Delete User</b></h1><br><br>
                  <form class="form-horizontal" action="forgot_password.php" method="get">
                      <div class="form-group">
                            <label for="email" class="col-sm-2 control-label"> User-Name: </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="email" placeholder="Delete"><br><br>
                                </div>
                      </div><br>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button href="forgot_password.php" type="submit" class="btn btn-danger btn-md">Delete</button>
                        </div>
                      </div>
                  </form>
  </div>-->

<div class="relative">
      <table class="table table-bordered" style="width:100%">
        <caption><h3><b>Student Information</b></h3></caption>
<tr>
	<th>First-Name</th>
	<th>Last-Name</th>
	<th>E-Mail</th>
	<th>ID</th>
	<th>Admin</th>
	<th>Delete</th>
</tr>
<?php

	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "mysql_login";
	$table = "login_info";
	$conn = mysqli_connect($servername, $username, $password,$dbname);
	if (! $conn){
        	die("connection failed: " . mysql_error());
	}
	$statement="SELECT * FROM $table";
	$result = mysqli_query($conn,$statement);
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr><td>";
		echo $row['first_name'];
		echo "</td>" ;
		echo "<td>";
		echo $row["last_name"];
		echo "</td>";
		echo "<td>";
		echo $row["email"];
		echo "</td>";
		echo "<td>";
		echo $row["uid"];
		echo "</td>";
		echo "<td>";
		if ($row['admin']==1){
			$admin = "yes";
		}
		else{
			$admin="no";
		}
		echo $admin;
		echo "</td>";
		echo "<td>";
		$method="get";
		$action="delete_user.php";
		echo "<form method=$method action=$action>";
		$type="submit";
		$value="delete";
		$hidden="hidden";
		$hidden_value = $row["uid"];
		$name="uid";
		echo "<input type=$hidden value=$hidden_value name=$name>";
		echo "<input type=$type value=$value></input>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
	}
mysqli_close($conn);
?>
      </table>
    </div>
</div>

</body>
</html>
