<?php include("database.php"); ?>

<?php
    $create = "CREATE TABLE Student_tbl
        (
        studentid int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        studentname varchar(2100),
        studentemail varchar(100),
        studentcity varchar(100),
        studentgender varchar(100),
        studentcourse varchar(10),
        studentcountry varchar(100)
        );
    ";

    if($conn->query($create)){
        echo "Table created successfully";
    }else{
        echo "Error Creating Table: " . $conn->error;
    }
?>
