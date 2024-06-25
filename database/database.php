<?php

 $server ="localhost";
 $username = "root";
 $password = "";
 $dbname = "users";

 $conn = new mysqli($server, $username, $password, $dbname);

 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);

 }  
 echo "Connected successfully";

 $sql = ""

?>
