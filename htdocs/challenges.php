<html>
<head>
<title>Challenges CTF</title>
<link rel="stylesheet" href="/main.css">
</head>
<body style="text-align:center">
<style>
td, th {height: 50px}
</style>
<?php
    session_start();

	if(!isset($_SESSION["user_id"])) {
		header("Location: /login.php");
        die('Redirecting...');
	}
?>
<?php
    include('header.php');
    $conn = new mysqli($sql_host, $sql_uname, $sql_pass, $sql_db);
?>
<h1> Challenges </h1>
<br>
<div class="fourms">
<table>
<tr>
    <th>Challenge Name</th>
    <th>Tags</th>
    <th>Points</th>
    <th>Hints</th>
</tr>
<?php
    $stmt = $conn->prepare("SELECT `QUES_NAME`, `QUES_TYPE`, `POINTS`, (SELECT count(*) FROM SUBMITS WHERE SUBMITS.QUES_ID = QUESTIONS.QUES_ID AND SUBMITS.USER_ID = ?) AS 'SOLVED' FROM `QUESTIONS` ORDER BY QUES_TYPE, POINTS;");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
        if ($row["SOLVED"] == 1)
            echo "<tr class='solved'>";
        else
            echo "<tr>";
        echo "<td><a href='" . $challenge_base_path . "/" . $row["QUES_NAME"] . "/index.php'>" . $row["QUES_NAME"] . "</a></td><td>" . $row["QUES_TYPE"] . "</td><td>" .$row["POINTS"] . "</td><td><a href='AIT-CTF/" . $row["QUES_NAME"] . "/hints.php'>hints</a></td></tr>";
    }
?>
</table>
<br>
<br>
</div>
<?php
    include('footer.php');
?>
</body>
</html>