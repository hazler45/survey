<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $poll_id = $_GET['id'];

    // Select the poll record
    $select_query = "SELECT * FROM polls WHERE id = ?";
    $stmt = $con->prepare($select_query);
    $stmt->bind_param("i", $poll_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $poll = $result->fetch_assoc();

    if ($poll) {
        // Select all poll answers ordered by votes
        $select_answers_query = "SELECT * FROM poll_answers WHERE poll_id = ? ORDER BY votes DESC";
        $stmt = $con->prepare($select_answers_query);
        $stmt->bind_param("i", $poll_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $poll_answers = [];
        $total_votes = 0;

        while ($row = $result->fetch_assoc()) {
            $poll_answers[] = $row;
            $total_votes += $row['votes'];
        }
    } else {
        exit('Poll with that ID does not exist.');
    }
} else {
    exit('No poll ID specified.');
}
?>
<?('Poll Results')?>

<div class="content poll-result">
    <h2><?=$poll['title']?></h2>
    <p><?=$poll['description']?></p>
    <div class="wrapper">
        <?php foreach ($poll_answers as $poll_answer): ?>
        <div class="poll-question">
            <p><?=$poll_answer['title']?> <span>(<?=$poll_answer['votes']?> Votes)</span></p>
            <div class="result-bar" style="width: <?=@round(($poll_answer['votes'] / $total_votes) * 100)?>%">
                <?=@round(($poll_answer['votes'] / $total_votes) * 100)?>%
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
            }
        
            .content.poll-result {
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
        
            .wrapper {
                margin-top: 20px;
            }
        
            .poll-question {
                background-color: #f0f0f0;
                margin: 10px 0;
                padding: 10px;
                border-radius: 3px;
            }
        
            .poll-question p {
                font-weight: bold;
                margin: 0;
            }
        
            .poll-question span {
                color: #888;
                font-size: 14px;
            }
        
            .result-bar {
                background-color: #007bff;
                color: #fff;
                text-align: center;
                padding: 5px 0;
                border-radius: 3px;
            }
        
            .result-bar::after {
                content: '';
            }
        
            /* Adjust the width of the result bars */
            .poll-question:nth-child(1) .result-bar {
                width: 35%;
            }
        
            .poll-question:nth-child(2) .result-bar {
                width: 22%;
            }
        
            .poll-question:nth-child(3) .result-bar {
                width: 13%;
            }
        </style>
</div>

