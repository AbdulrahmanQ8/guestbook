<?php error_reporting(E_ALL ^ E_NOTICE);?>
<!DOCTYPE html>
<html>
<head>
	<title>guesst bock</title>
</head>
<body>
<?php 
require_once ('conx.php');
//connectt to the database
mysql_connect("$dbhost", "$dbusername", "$dbpass");
mysql_select_db("$dbname");

/***********************************************/
// form and add stuff area

if ($_POST['postbtn']) {
	$name = strip_tags($_POST['name']);
	$email = strip_tags($_POST['email']);
	$message =strip_tags( $_POST['message']);

	if ($name && $email && $message) {
			$time= date("h:i A");
			$date= date("F d, Y");
			$ip=$_SERVER['REMOTE_ADDR'];
		// add to the db

		mysql_query("INSERT INTO guestbook VALUES(
				'','$name','$email','$message','$time','$date','$ip' )
			");
		echo "your post has been added";
		
	} else {
		echo"you did not enter in all the required info.";
	}
	
}

echo "<h2> post to the guestbook </h2>
<form action= './index.php' method='POST' >
<table>
<div>
	<tr>
		<td> Name: </td>
		<td> <input type='text' name='name' style='width: 200px;'/> </td>
	</tr>
	<br/>
	<tr>
		<td> email: </td>
		<td> <input type='text' name='email' style='width: 200px;'/> </td>
	</tr>
	<br/>
	<tr>
		<td> Message: </td>
		<td><textarea name='message' style='width:200px; height:100px; '></textarea> </td>
	</tr>
	<br/>
	<tr>
		<td></td>
		<td> <input type='submit' name='postbtn' value='post' /> </td>
	</tr>


</div>

</table>
</form> ";



/***********************************************/
// display stuf area


$query= mysql_query("SELECT * FROM guestbook ORDER BY id DESC");

$numrows = mysql_num_rows($query);
if ($numrows > 0) {

	while ($row = mysql_fetch_assoc($query)) {
		$id = $row['id'];
		$name = $row['name'];
		$email = $row['email'];
		$message = $row['message'];
		$time = $row['time'];
		$date = $row['date'];
		$ip = $row['ip'];
		$message = nl2br($message);
		echo "<div>
				By <b>$name</b> - at <b>$time</b> on <b>$date</b> <br/>
				$message
			</div> <hr/>";

	}
}else{echo "no post was found";}

/***********************************************/

mysql_close()
?>
</body>
</html>