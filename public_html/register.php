<?php
    include('connection.php'); // Include your database connection script
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Hash the password for security (use a better hashing method in production)
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Insert user data into the database
        $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($con, $sql)) {
            header("Location: login.html"); // Redirect to a welcome page on success
    exit();
        } else {
            echo "<h3>Registration failed: " . mysqli_error($con) . "</h3>";
        }
    } 
    ?>