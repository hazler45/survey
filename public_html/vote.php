<?php
include 'connection.php'; // Include the database connection file

if (isset($_GET['id'])) {
    // MySQL query that selects the poll records by the GET request "id"
    $stmt = $con->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->bind_param('i', $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    // Fetch the record
    $poll = $result->fetch_assoc();
    
    if ($poll) {
        // MySQL query that selects all the poll answers
        $stmt = $con->prepare('SELECT * FROM poll_answers WHERE poll_id = ?');
        $stmt->bind_param('i', $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        // Fetch all the poll answers
        $poll_answers = $result->fetch_all(MYSQLI_ASSOC);
        
        // If the user clicked the "Vote" button...
        if (isset($_POST['poll_answer'])) {
            // Update and increase the vote for the answer the user voted for
            $stmt = $con->prepare('UPDATE poll_answers SET votes = votes + 1 WHERE id = ?');
            $stmt->bind_param('i', $_POST['poll_answer']);
            $stmt->execute();
            
            // Redirect user to the result page
            header('Location: result.php?id=' . $_GET['id']);
            exit;
        }
    } else {
        exit('Poll with that ID does not exist.');
    }
} else {
    exit('No poll ID specified.');
}
?>

<div class="content poll-vote">
    <h2><?=$poll['title']?></h2>
    <p><?=$poll['description']?></p>
    <form action="vote.php?id=<?=$_GET['id']?>" method="post">
        <?php foreach ($poll_answers as $answer): ?>
        <label>
            <input type="radio" name="poll_answer" value="<?=$answer['id']?>">
            <?=$answer['title']?>
        </label>
        <?php endforeach; ?>
        <div>
            <input type="submit" value="Vote">
            <a href="result.php?id=<?=$poll['id']?>">View Result</a>
        </div>
    </form>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }

    .content.poll-vote {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        margin: 20px auto;
        width: 50%;
        text-align: center;
    }

    h2 {
        color: #333;
    }

    p {
        color: #555;
    }

    form {
        margin-top: 20px;
    }

    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    a {
        display: inline-block;
        margin-top: 10px;
        text-decoration: none;
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        border-radius: 3px;
    }

    a:hover {
        background-color: #0056b3;
    }
</style>
</div>

