<html>
<head>
<title>Announcement CTF</title>
<link rel="stylesheet" href="/main.css">
</head>
<body>
<?php
    include('header.php');
?>
<h1> Announcements </h1>
<br>
<div class="fourms">
<?php
    $conn = new mysqli($sql_host, $sql_uname, $sql_pass, $sql_db);
    $stmt = $conn->prepare('SELECT Title, description, make_time FROM announcement ORDER BY make_time DESC');
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<table><tr><th>Title</th><th>Description</th><th>Timestamp</th></tr>";
    while($row = $result->fetch_assoc()){
        $date = new DateTime($row['make_time']);
        echo "<tr><td>" . $row['Title'] . "</td><td>" . $row['description'] . "</td><td>" . $date->format('H:i:s Y-m-d') . "</td></tr>";
    }
    echo "</table>";
?>
</div>
<?php
    include('footer.php');
?>
</body>
</html>