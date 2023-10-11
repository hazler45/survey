<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    $request_uri = $_SERVER['REQUEST_URI'];
    // Remove leading and trailing slashes and potential query parameters
    $request_uri = trim($request_uri, '/');
    ?>
    <div class="tap">
 <h1>Welcome to Our Website</h1>
 <p>A polling application is a software tool designed to collect and analyze feedback, opinions, or data from a group of individuals, often in the form of questions or polls. 
    Users can create surveys or polls, distribute them to respondents, and gather responses for analysis. </p>
    
    <!-- Login Button -->
    
    <a href="public_html/login.html"><button class="log">Login</button></a>
    
    <!-- Register Button -->
    <a href="public_html/register.html"><button class="top">Register</button></a>
</div>
<style>
    .tap {
        justify-self: center;
        
  font-size: 24px;
  font-weight: bold;
  text-align: center;
  margin-top: 20px;
  color: #333;
}

a {
  padding:12px;
  
  }
button{
    padding:20px 40px;
    font-size: 20px;
    color:white;
    font-weight: 500;

}
.log{
    background-color: #007bff;
    
}
.top{
    background-color:#228B22;
}
p{
    font-size: 20px;
  line-height: 1.5;
  margin: 20px 0;
  margin-left: 25rem;
  color:#555555 ; 
  width: 50%;

}

</style>
</body>
</html>