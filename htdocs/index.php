<html>
<head>
<title>CTF</title>
<link rel="stylesheet" href="/main.css">
</head>
<body>
<?php
//die ('Maintainance');
    session_start();

	if(!isset($_SESSION["user_id"])) {
		header("Location: /login.php");
        die('Redirecting...');
	}
?>
<?php
    include('header.php');
?><br><br>
<fieldset>
<legend>
Flag Submission
</legend>
<form method="POST" action="index.php" >
Enter the flags to get points :<br><br>
<input type="textbox" name="flag" ><br><br>
<input type="submit" value="Submit Flag">
</form><br><br>
</fieldset>
<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['flag'])) {
			$flag=$_POST['flag'];
			$conn = new mysqli($sql_host, $sql_uname, $sql_pass, $sql_db);
                	$stmt = $conn->prepare('SELECT QUES_ID, POINTS FROM QUESTIONS WHERE QUES_FLAG=?');
                	$stmt->bind_param('s', $flag);
                	$stmt->execute();
                	$result = $stmt->get_result();
                	$row = $result->fetch_assoc();
                	if (!$row) {
                  		echo 'ERROR :: WRONG FLAG';
                	}
                	else {  //check if used prev
                    		$ques_id = $row['QUES_ID'];
                    		$points = $row['POINTS'];
                    		$stmt = $conn->prepare('SELECT QUES_ID FROM SUBMITS WHERE USER_ID=? AND QUES_ID=?');
                    		$stmt->bind_param('ii', $_SESSION['user_id'], $ques_id);
                    		$stmt->execute();
                    		$result = $stmt->get_result();
                    		$row = $result->fetch_assoc();
                    		if ($row) {
                    			echo 'ERROR :: FLAG RE-USAGE';
                    		} else {    // insert usage record
                        		$stmt = $conn->prepare('INSERT INTO SUBMITS(USER_ID, QUES_ID) VALUE(?, ?)');
                        		$stmt->bind_param('ii', $_SESSION['user_id'], $ques_id);
                        		$stmt->execute();
                        
                        		// update points
                        		$date = DateTime::createFromFormat('Y-m-d', '2020-09-28');//enter end date of CTF
                        		$now = new DateTime();
                        		//if($date < $now) {
                        		//    echo 'Time Exceded. Will not be adding to user activity.<br>';
                        		//} else {
                            			$stmt = $conn->prepare('UPDATE USERS SET POINTS = POINTS + ?, LAST_ACTIVITY = NOW() WHERE USER_ID=?');
                            			$stmt->bind_param('ii', $points, $_SESSION['user_id']);
                            			$stmt->execute();
                        		//}
					echo 'Success';
                    		}
                	}
                	$stmt->close();
		}
	}
?>
<?php
    include('footer.php');
?>
</body>
</html>