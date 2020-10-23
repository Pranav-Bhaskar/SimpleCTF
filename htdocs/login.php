<html>
<head>
<title>Login CTF</title>
<link rel="stylesheet" href="/main.css">
</head>
<body>

<?php
    include('header.php');
?>
<fieldset>
<legend>
Login
</legend>
<form method="POST" action="login.php" >
Username : 
<input type="text" name="username" >
<br>
Password : 
<input type="password" name="password" >
<br>
<br>
<input type="submit" value="Login">
</form>
</fieldset>
<br><br>
<?php
    session_start();
	if(isset($_SESSION['user_id'])) {
		header( "refresh:2;url=/index.php" );
        die("Redirecting...");
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username=$_POST['username'];
        $password=$_POST['password'];
				$conn = new mysqli($sql_host, $sql_uname, $sql_pass, $sql_db);
				$stmt = $conn->prepare('SELECT USER_ID, USER_NAME FROM USERS WHERE USER_NAME=? AND PASSWORD=?');
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if (!$row) {
            echo 'ERROR :: WRONG ID OR PASSWORD';
        }
        else {
            $_SESSION['username'] = $row['USER_NAME'];
            $_SESSION['user_id'] = $row['USER_ID'];
            echo 'LOGGED IN';
            header("refresh:1");
        }
        $stmt->close();
	}
?>
<?php
    include('footer.php');
?>
</body>
</html>