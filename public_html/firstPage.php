<?php
include 'connection.php'; // Include your database connection script
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Hash the password for security (use a better hashing method in production)
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert user data into the database using the MySQLi connection
    $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($con, $sql)) {
        header("Location: login.html"); // Redirect to a welcome page on success
        exit();
    } else {
        echo "<h3>Registration failed: " . mysqli_error($con) . "</h3>";
    }
}

// Now, use the same MySQLi connection to retrieve poll data
// Modify the following code based on your database structure
$sql = "SELECT id, title, description FROM polls";
$result = mysqli_query($con, $sql);
$polls = array();

while ($row = mysqli_fetch_assoc($result)) {
    $polls[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel = "stylesheet" type = "text/css" href = "style.css">  
</head>
<body>
    <div class="content home">
        <h2>Polls</h2>
        <a href="create.php" class="create-poll">Create Poll</a>
        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($polls as $poll): ?>
                <tr>
                    <td><?=$poll['id']?></td>
                    <td><?=$poll['title']?></td>
                    <td><?=$poll['description']?></td>
                    <td class="actions">
                        <a href="vote.php?id=<?=$poll['id']?>" class="view" title="View Poll"><i class="fas fa-eye fa-xs"></i></a>
                        <a href="delete.php?id=<?=$poll['id']?>" class="trash" title="Delete Poll"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
