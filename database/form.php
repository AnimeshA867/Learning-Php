<?php include("database.php"); ?>

<?php
// Insertion logic
if(isset($_POST['submitbtn'])){
    $name = $_POST['sname'];
    $email = $_POST['semail'];
    $city = $_POST['scity'];
    $gender = $_POST['gender'];
    $courses = [];

    if (isset($_POST['bca'])) {
        $courses[] = $_POST['bca'];
    }
    if (isset($_POST['csit'])) {
        $courses[] = $_POST['csit'];
    }
    if (isset($_POST['bbm'])) {
        $courses[] = $_POST['bbm'];
    }
    
    $course = implode(', ', $courses);
    $country = $_POST['country'];
    
    $insertSql = "INSERT INTO Student_tbl(studentname, studentemail, studentcity, studentgender, studentcourse, studentcountry) VALUES ('".$name."', '".$email."', '".$city."', '".$gender."', '".$course."', '".$country."');";

    if($conn->query($insertSql) === TRUE){
        echo "Inserted Data Successfully<br>";
    }else{
        echo "Error inserting data: " . $conn->error . "<br>";
    }

  /*   echo "My name is " . $name . "<br>";
    echo "My email is " . $email . "<br>";
    echo "My gender is " . $gender . "<br>";
    echo "My course is " . $course . "<br>";
    echo "My country is " . $country . "<br>";
    echo "My city is " . $city . "<br>"; */
}

// Retrieval logic
$retrieve = "SELECT * FROM Student_tbl;";
$result1 = $conn->query($retrieve);

if ($result1->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>City</th><th>Gender</th><th>Course</th><th>Country</th></tr>";
    // Output data of each row
    while($row = $result1->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["studentid"]. "</td>";
        echo "<td>" . $row["studentname"]. "</td>";
        echo "<td>" . $row["studentemail"]. "</td>";
        echo "<td>" . $row["studentcity"]. "</td>";
        echo "<td>" . $row["studentgender"]. "</td>";
        echo "<td>" . $row["studentcourse"]. "</td>";
        echo "<td>" . $row["studentcountry"]. "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
