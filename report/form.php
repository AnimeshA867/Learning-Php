<?php include("database.php"); ?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Registration</title>
</head>
<body>
    <h2>Student Registration</h2>

    <?php
    // Insertion logic
    if (isset($_POST['submitbtn'])) {
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

        $insertSql = "INSERT INTO Student_tbl (studentname, studentemail, studentcity, studentgender, studentcourse, studentcountry) 
                      VALUES ('$name', '$email', '$city', '$gender', '$course', '$country')";

        if ($conn->query($insertSql) === TRUE) {
            echo "Inserted Data Successfully<br>";
        } else {
            echo "Error inserting data: " . $conn->error . "<br>";
        }
    }

    // Update logic
    if (isset($_POST['updatebtn'])) {
        $id = $_POST['sid'];
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

        $updateSql = "UPDATE Student_tbl 
                      SET studentname='$name', studentemail='$email', studentcity='$city', studentgender='$gender', studentcourse='$course', studentcountry='$country' 
                      WHERE studentid=$id";

        if ($conn->query($updateSql) === TRUE) {
            echo "Updated Data Successfully<br>";
        } else {
            echo "Error updating data: " . $conn->error . "<br>";
        }
    }

    // Deletion logic
    if (isset($_GET['deleteid'])) {
        $id = $_GET['deleteid'];
        $deleteSql = "DELETE FROM Student_tbl WHERE studentid=$id";

        if ($conn->query($deleteSql) === TRUE) {
            echo "Deleted Data Successfully<br>";
        } else {
            echo "Error deleting data: " . $conn->error . "<br>";
        }
    }

    // Retrieval logic
    $retrieve = "SELECT * FROM Student_tbl";
    $result1 = $conn->query($retrieve);

    if ($result1->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>City</th><th>Gender</th><th>Course</th><th>Country</th><th>Actions</th></tr>";
        while ($row = $result1->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["studentid"] . "</td>";
            echo "<td>" . $row["studentname"] . "</td>";
            echo "<td>" . $row["studentemail"] . "</td>";
            echo "<td>" . $row["studentcity"] . "</td>";
            echo "<td>" . $row["studentgender"] . "</td>";
            echo "<td>" . $row["studentcourse"] . "</td>";
            echo "<td>" . $row["studentcountry"] . "</td>";
            echo "<td><a href='?deleteid=" . $row["studentid"] . "'>Delete</a> | <a href='form.php?updateid=" . $row["studentid"] . "'>Update</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Update form
    if (isset($_GET['updateid'])) {
        $id = $_GET['updateid'];
        $sql = "SELECT * FROM Student_tbl WHERE studentid=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <h2>Update Student Information</h2>
            <form method="POST" action="form.php">
                <input type="hidden" name="sid" value="<?php echo $row['studentid']; ?>">
                <table>
                    <tr>
                        <td>Student Name</td>
                        <td><input type="text" name="sname" value="<?php echo $row['studentname']; ?>" required></td>
                    </tr>
                    <tr>
                        <td>Student Email</td>
                        <td><input type="email" name="semail" value="<?php echo $row['studentemail']; ?>" required></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input type="text" name="scity" value="<?php echo $row['studentcity']; ?>" required></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>
                            <input type="radio" name="gender" value="male" <?php if ($row['studentgender'] == 'male') { echo "checked"; } ?>> Male
                            <input type="radio" name="gender" value="female" <?php if ($row['studentgender'] == 'female') { echo "checked"; } ?>> Female
                        </td>
                    </tr>
                    <tr>
                        <td>Courses:</td>
                        <td>
                            <input type="checkbox" name="bca" value="BCA" <?php if (strpos($row['studentcourse'], 'BCA') !== false) { echo "checked"; } ?>>BCA
                            <input type="checkbox" name="csit" value="BSc CSIT" <?php if (strpos($row['studentcourse'], 'BSc CSIT') !== false) { echo "checked"; } ?>>BSc CSIT
                            <input type="checkbox" name="bbm" value="BBM" <?php if (strpos($row['studentcourse'], 'BBM') !== false) { echo "checked"; } ?>>BBM
                        </td>
                    </tr>
                    <tr>
                        <td>Select country:</td>
                        <td>
                            <select name="country">
                                <option value="nepal" <?php if ($row['studentcountry'] == 'nepal') { echo "selected"; } ?>>Nepal</option>
                                <option value="india" <?php if ($row['studentcountry'] == 'india') { echo "selected"; } ?>>India</option>
                                <option value="china" <?php if ($row['studentcountry'] == 'china') { echo "selected"; } ?>>China</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Save Info:</td>
                        <td><button type="submit" name="updatebtn">Update</button></td>
                    </tr>
                </table>
            </form>
            <?php
        } else {
            echo "No record found";
        }
    }

    $conn->close();
    ?>

    <form method="POST" action="form.php">
        <h2>Add New Student</h2>
        <table>
            <tr>
                <td>Student Name</td>
                <td><input type="text" name="sname" id="nameid" required /></td>
            </tr>
            <tr>
                <td>Student Email</td>
                <td><input type="email" name="semail" id="emailid" required /></td>
            </tr>
            <tr>
                <td>City</td>
                <td><input type="text" name="scity" id="cityid" required /></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <input type="radio" name="gender" id="gender" value="male" required /> Male
                    <input type="radio" name="gender" id="gender" value="female" required /> Female
                </td>
            </tr>
            <tr>
                <td>Courses:</td>
                <td>
                    <input type="checkbox" name="bca" value="BCA" />BCA
                    <input type="checkbox" name="csit" value="BSc CSIT" />BSc CSIT
                    <input type="checkbox" name="bbm" value="BBM" />BBM
                </td>
            </tr>
            <tr>
                <td>Select country:</td>
                <td>
                    <select name="country" required>
                        <option value="nepal">Nepal</option>
                        <option value="india">India</option>
                        <option value="china">China</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Save Info:</td>
                <td><button type="submit" name="submitbtn">Submit</button></td>
            </tr>
        </table>
    </form>
</body>
</html>
