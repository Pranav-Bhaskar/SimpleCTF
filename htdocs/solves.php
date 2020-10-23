<html>
<head>
<title>Solves CTF</title>
<link rel="stylesheet" href="/main.css">
</head>
<body>
<?php
    include('header.php');
?>
<h1> Solves </h1>
<br>
<div class="fourms">
<?php
    $conn = new mysqli($sql_host, $sql_uname, $sql_pass, $sql_db);
		$stmt = $conn->prepare('SELECT USERS.USER_NAME, QUESTIONS.QUES_NAME , SUBMITS.TIME from SUBMITS JOIN USERS ON SUBMITS.USER_ID = USERS.USER_ID JOIN QUESTIONS ON QUESTIONS.QUES_ID = SUBMITS.QUES_ID WHERE USERS.USER_ID != 0 ORDER BY SUBMITS.TIME DESC');
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<table><tr><th>User Name</th><th>Question Name</th><th>Timestamp</th></tr>";
    while($row = $result->fetch_assoc()){
        $date = new DateTime($row['TIME']);
        echo "<tr><td>" . $row['USER_NAME'] . "</td><td>" . $row['QUES_NAME'] . "</td><td>" . $date->format('H:i:s Y-m-d') . "</td></tr>";
    }
    echo "</table>";
?>
</div>
<?php
    include('footer.php');
?>
</body>
</html>