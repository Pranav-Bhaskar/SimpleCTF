<html>
<head>
<title>Leaderboard CTF</title>
<link rel="stylesheet" href="/main.css">
</head>
<body>
<?php
    include('header.php');
?>
<h1> Leaderboard </h1>
<br>
<div class="fourms">
<?php
    $conn = new mysqli($sql_host, $sql_uname, $sql_pass, $sql_db);
		$stmt = $conn->prepare('SELECT USER_NAME, POINTS FROM USERS where POINTS > 0 AND USER_ID != 0 ORDER BY POINTS DESC, LAST_ACTIVITY ASC');
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<table><tr><th>Rank</th><th>User Name</th><th>Points</th></tr>";
    $rank = 1;
    while($row = $result->fetch_assoc()){
        echo "<tr><td>" . $rank . "</td><td>" . $row['USER_NAME'] . "</td><td>" . $row['POINTS'] . "</td></tr>";
        $rank += 1;
    }
    echo "</table>";
?>
</div>
<?php
    include('footer.php');
?>
</body>
</html>