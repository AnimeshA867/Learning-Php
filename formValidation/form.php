<?php
if(isset($_POST['submitbtn'])){
    $name = $_POST['sname'];
    $email = $_POST['semail'];
    $city = $_POST['scity'];
    $gender = $_POST['gender'];
    $bca = isset($_POST['bca']) ? $_POST['bca'] : NULL;
    $csit = isset($_POST['csit']) ? $_POST['csit'] : NULL;
    $bbm = isset($_POST['bbm']) ? $_POST['bbm'] : NULL;
    $country = $_POST['country'];
    
    echo "My name is " . $name . "<br>";
    echo "My email is " . $email . "<br>";
    echo "My gender is " . $gender . "<br>";
    echo "My course is " . $csit . " " . $bbm . " " . $bca . "<br>";
    echo "My country is " . $country . "<br>";
    echo "My city is " . $city . "<br>";
}
?>
