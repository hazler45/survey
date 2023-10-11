<?php
include 'connection.php';

$msg = '';

if (isset($_GET['id'])) {
    $poll_id = $_GET['id'];

    // Select the record that is going to be deleted
    $select_query = "SELECT * FROM polls WHERE id = ?";
    $stmt = $con->prepare($select_query);
    $stmt->bind_param("i", $poll_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $poll = $result->fetch_assoc();

    if (!$poll) {
        exit('Poll doesn\'t exist with that ID!');
    }

    // Make sure the user confirms before deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $delete_poll_query = "DELETE FROM polls WHERE id = ?";
            $stmt = $con->prepare($delete_poll_query);
            $stmt->bind_param("i", $poll_id);
            $stmt->execute();

            // We also need to delete the answers for that poll
            $delete_answers_query = "DELETE FROM poll_answers WHERE poll_id = ?";
            $stmt = $con->prepare($delete_answers_query);
            $stmt->bind_param("i", $poll_id);
            $stmt->execute();

            // Output msg
            $msg = 'You have deleted the poll!';
        } else {
            // User clicked the "No" button, redirect them back to the index page
            header('Location: index.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<div class="content delete">
    <h2>Delete Poll #
        <?= $poll['id'] ?>
    </h2>
    <?php if ($msg): ?>
        <p>
            <?= $msg ?>
        </p>
    <?php else: ?>
        <p>Are you sure you want to delete poll #
            <?= $poll['id'] ?>?
        </p>
        <div class="yesno">
            <a href="delete.php?id=<?= $poll['id'] ?>&confirm=yes">Yes</a>
            <a href="firstPage.php?id=<?= $poll['id'] ?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .content.delete {
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

        .yesno {
            margin-top: 20px;
        }

        .yesno a {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }

        .yesno a:hover {
            background-color: #0056b3;
        }
    </style>
</div>