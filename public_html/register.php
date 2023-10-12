<?php
    include('connection.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($con, $sql)) {
            header("Location: login.php"); 
    exit();
        } else {
            echo "<h3>Registration failed: " . mysqli_error($con) . "</h3>";
        }
    } 
    ?>
    <html>  
    <head>  
        <title>Register page</title>  
        <link rel = "stylesheet" type = "text/css" href = "style.css">   
    </head>  
    <body>  
    <div class="backNav">
        <a href="/survey/">Back</a>
    </div>
        <div id = "frm">  
            <h1>Register</h1>  
            <form name="f1" action = "register.php" onsubmit = "return validation()" method = "POST">  
                <p>  
                    <label> UserName: </label>  
                    <input type = "text" id ="username" name  = "username"  />  
                </p>  
                <p>  
                    <label> Password: </label>  
                    <input type = "password" id ="password" name  = "password" />  
                </p>  
                <p>     
                    <input type =  "submit" id = "btn" value = "Register" />  
                </p>  
            </form>  
        </div>  
  
        <script>  
                function validation()  
                {  
                    var id=document.f1.username.value;  
                    var ps=document.f1.password.value;  
                    if(id.length=== 0 && ps.length=== 0) {  
                        alert("User Name and Password fields are empty");  
                        return false;  
                    }  
                    else  
                    {  
                        if(id.length=== 0) {  
                            alert("User Name is empty");  
                            return false;  
                        }   
                        if (ps.length=== 0) {  
                        alert("Password field is empty");  
                        return false;  
                        }  
                    }                             
                }  
            </script>  
    </body>     
    </html>  