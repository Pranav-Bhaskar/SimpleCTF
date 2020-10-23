<html>
<head>
<title>Solves CTF</title>
<link rel="stylesheet" href="/main.css">
</head>
<body>
<?php
    include('header.php');
    $conn = new mysqli($sql_host, $sql_uname, $sql_pass, $sql_db);
?>

<?php
    if (isset($_GET['c'])) {
        echo "<h1>" . htmlspecialchars($_GET['c']) . "</h1>";
        $chal_name = $_GET['c'];
        $stmt = $conn->prepare('SELECT USER_NAME, TIME from QUESTIONS left join SUBMITS on SUBMITS.QUES_ID = QUESTIONS.QUES_ID join USERS ON USERS.USER_ID = SUBMITS.USER_ID WHERE QUESTIONS.QUES_NAME=? AND USERS.USER_ID != 0 order by SUBMITS.TIME;');
        $stmt->bind_param('s', $chal_name);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<table><tr><th>UserName</th><th>TimeStamp</th></tr>";
        if ($result->num_rows == 0) {
            echo "<tr><td>Your Name Can Be Here...</td><td></td></tr>";
        }
        $first = 1;
        while($row = $result->fetch_assoc()){
            $date = new DateTime($row['TIME']);
            echo "<tr><td>" . $row['USER_NAME'];
            if ($first == 1) {
                echo " [First Blood] ";
                $first = 0;
            }
            echo "</td><td>" . $date->format('H:i:s Y-m-d') . "</td></tr>";
        }
        echo "</table>";
    } else {
        ?>
        <h1>Challenge Board</h1>
        <br>
        <div class="fourms">
        <?php
        $stmt = $conn->prepare('SELECT QUESTIONS.QUES_NAME, COUNT(USER_ID) as solves from QUESTIONS left join SUBMITS on SUBMITS.QUES_ID = QUESTIONS.QUES_ID WHERE SUBMITS.USER_ID != 0 GROUP BY QUESTIONS.QUES_NAME order by solves;');
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<table><tr><th>Challenge Name</th><th>Solves</th></tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr><td>" . $row['QUES_NAME'] . "</td><td><a href=\"?c=" . $row['QUES_NAME'] . "\" >" . $row['solves'] . "</a></td></tr>";
        }
        echo "</table>";
    }
?>
</div>
<?php
    include('footer.php');
?>
</body>
</html>