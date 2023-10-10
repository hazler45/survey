<?php
include('connection.php');
$username = $_POST['username'];
$password = $_POST['pass'];

// To prevent SQL injection
$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);

// Corrected SQL query referencing the 'user' table
$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
if ($count == 1) {   
    // echo "<h3>Login successful! <a href='/survey'>Homepage</a></h3>";
    header("Location: /survey"); // Redirect to a welcome page on success
    exit();
} else {
    echo "<h1>Login failed. Invalid username or password.</h1>";
}
?>
