<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $request_uri = $_SERVER['REQUEST_URI'];
    // Remove leading and trailing slashes and potential query parameters
    $request_uri = trim($request_uri, '/');
    ?>
 <h1>Welcome to Our Website</h1>
    
    <!-- Login Button -->
    <a href="public_html/login.html"><button>Login</button></a>
    
    <!-- Register Button -->
    <a href="public_html/register.html"><button>Register</button></a>
</body>
</html>