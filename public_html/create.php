<?php
include('connection.php'); 

$msg = '';

if (!empty($_POST)) {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    // Insert new record into the "polls" table
    $sql = "INSERT INTO polls (title, description) VALUES ('$title', '$description')";
    $result = mysqli_query($con, $sql); 

    if ($result) {
        $poll_id = mysqli_insert_id($con); 

        $answers = isset($_POST['answers']) ? explode(PHP_EOL, $_POST['answers']) : '';

        foreach ($answers as $answer) {
            if (empty($answer))
                continue;

            $sql = "INSERT INTO poll_answers (poll_id, title) VALUES ($poll_id, '$answer')";
            mysqli_query($con, $sql); 
        }
        echo "<script>
        alert('Poll created sucessfully');
    </script>";
        $msg = 'Created Successfully!';
    } else {
        echo "<script>
        alert('Please fillup the form');
    </script>";
        $msg = 'Error: ' . mysqli_error($con); 
    }
}
// Close the MySQLi connection
mysqli_close($con); 
?>
<html>
<div class="backNav">
        <a href="firstPage.php">Back</a>
    </div>
<div class="content update">
    <h2>Create Poll</h2>
    <form action="create.php" method="post">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Title" required>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" placeholder="Description">
        <label for="answers">Answers (per line)</label>
        <textarea name="answers" id="answers" placeholder="Description" required></textarea>
        <input type="submit" value="Create">
    </form>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .content {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin: 20px auto;
            width: 50%;
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        textarea {
            height: 100px;
        }

        input[type="submit"] {
            background-color: #376ab7;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            color: green;
        }
    </style>

</div>

</html>