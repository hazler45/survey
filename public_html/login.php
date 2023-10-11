<?php
include('connection.php');

if (isset($_POST['username']) && isset($_POST['pass'])) {
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
        header("Location: firstPage.php");
        exit();
    } else {
        echo "<script>
            alert('Login failed. Please check your username and password.');
        </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="frm">
        <h1>Login</h1>
        <form name="f1" action="login.php" method="POST">
            <p>
                <label>Username:</label>
                <input type="text" id="username" name="username" />
            </p>
            <p>
                <label>Password:</label>
                <input type="password" id="password" name="pass" />
            </p>
            <p>
                <input type="submit" id="btn" value="Login" />
            </p>
        </form>
    </div>
</body>
</html>
