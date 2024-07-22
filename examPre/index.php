<?php
session_start();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Set cookies
    setcookie('name', $name, time() + 3600, "/");
    setcookie('password', $password, time() + 3600, "/");
    setcookie('email', $email, time() + 3600, "/");

    // Set session variables
    $_SESSION['name'] = $name;
    $_SESSION['password'] = $password;
    $_SESSION['email'] = $email;

    // Output
    echo "Name: " . htmlspecialchars($name) . "<br>";
    echo "Password: " . htmlspecialchars($password) . "<br>";
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "Cookies set successfully.<br>";
    echo "Session info saved successfully.<br>";
    echo "Session: ". $_SESSION['name'];
}
?>
