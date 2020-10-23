<?php
    session_start();
    //Make a user with USER_ID = 0 to access admin.
	if((!isset($_SESSION['user_id'])) || ($_SESSION['user_id'] != 0)) {
		header( "Location: /index.php" );
        die("Redirecting...");
	}
?>
<html>
<head>
<title>Admin</title>
<link rel="stylesheet" href="/main.css">
</head>
<body>

<?php
    include('header.php');
?>
<br>
<fieldset>
<legend>
Register
</legend>
<form method="POST" action="admin.php" >
Username (can be used for XSS) : 
<input type="text" name="username" >
<br>
Password : 
<input type="password" name="password" >
<br>
<br>
<input type="submit" name="register" value="Register">
</form>
</fieldset>
<br><br>
<br>
<fieldset>
<legend>
Create Challenge
</legend>
<form method="POST" action="admin.php" >
Name : 
<input type="text" name="challenge" >
<br>
Flag : 
<input type="text" name="flag" >
<br>
Points :
<input type="number" name="points" >
<br>
Type
<input type="text" name="type" >
<br>
<br>
<input type="submit" name="create" value="Create">
</form>
</fieldset>
<br><br>
<br>
<fieldset>
<legend>
Announce
</legend>
<form method="POST" action="admin.php" >
Title : 
<input type="text" name="title" >
<br>
Description : <br>
<textarea name="desc"></textarea>
<br>
<br>
<input type="submit" name="announce" value="Announce">
</form>
</fieldset>
<br><br>
<?php
    $conn = new mysqli($sql_host, $sql_uname, $sql_pass, $sql_db);
	
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["register"])) {
            $username=$_POST['username'];
            $password=$_POST['password'];
            $stmt = $conn->prepare('INSERT INTO USERS (USER_NAME, PASSWORD) VALUE(?, ?);');
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();
            $stmt->close();
        } else if (isset($_POST["create"])) {
            $name=$_POST['challenge'];
            $flag=$_POST['flag'];
            $points=$_POST['points'];
            $type=$_POST['type'];
            $stmt = $conn->prepare('INSERT INTO `QUESTIONS`(`QUES_NAME`, `QUES_TYPE`, `QUES_FLAG`, `POINTS`) VALUE(?, ?, ?, ?);');
            $stmt->bind_param('sssi', $name, $type, $flag, $points);
            $stmt->execute();
            $stmt->close();
        } else if (isset($_POST["announce"])) {
            $title=$_POST['title'];
            $desc=$_POST['desc'];
            $stmt = $conn->prepare('INSERT INTO `announcement`(`Title`, `description`) VALUE(?, ?);');
            $stmt->bind_param('ss', $title, $desc);
            $stmt->execute();
            $stmt->close();
        }
	}
?>
<script>
function showUserList() {
    document.getElementById('user_list').style.display = "";
    return false;
}

function showChallengeList() {
    document.getElementById('chall_list').style.display = "";
    return false;
}

function showAnnouncements() {
    document.getElementById('announcements').style.display = "";
    return false;
}
</script>
<div class="fourms">
<br>
<a href='#' onclick="return showUserList()"><h1> User List </h1></a>
<br>
<?php
    $stmt = $conn->prepare('SELECT USER_ID, USER_NAME, PASSWORD, POINTS FROM USERS ORDER BY USER_ID DESC');
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<table id='user_list' style='display:none'><tr><th>USER_ID</th><th>User Name</th><th>PASSWORD</th><th>POINTS</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['USER_ID'] . "</td><td>" . $row['USER_NAME'] . "</td><td>" . $row['PASSWORD'] . "</td><td>" . $row['POINTS'] . "</td></tr>";
    }
    echo "</table>";
?>
<br>
<a href='#' onclick="return showChallengeList()"><h1> Challenge List </h1></a>
<br>
<?php
    $stmt = $conn->prepare('SELECT QUES_ID, QUES_NAME, QUES_TYPE, QUES_FLAG, POINTS FROM QUESTIONS ORDER BY QUES_ID DESC');
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<table id='chall_list' style='display:none'><tr><th>ID</th><th>Challenge Name</th><th>Type</th><th>Flag</th><th>Points</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['QUES_ID'] . "</td><td>" . $row['QUES_NAME'] . "</td><td>" . $row['QUES_TYPE'] . "</td><td>" . $row['QUES_FLAG'] . "</td><td>" . $row['POINTS'] . "</td></tr>";
    }
    echo "</table>";
?>
<br>
<a href='#' onclick="return showAnnouncements()"><h1> Announcements </h1></a>
<br>
<?php
    $stmt = $conn->prepare('SELECT `Title`, `description` FROM `announcement` ORDER BY make_time DESC;');
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<table id='announcements' style='display:none'><tr><th>Title</th><th>Description</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['Title'] . "</td><td>" . $row['description'] . "</td></tr>";
    }
    echo "</table>";
?>
<div>
<?php
    include('footer.php');
?>
</body>
</html>