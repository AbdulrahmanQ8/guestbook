<html>
<head>
<title>Creating MySQL Tables</title>
</head>
<body>
<?php
require_once ('conx.php');
//connectt to the database


$conn = mysql_connect("$dbhost", "$dbusername", "$dbpass");
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully<br />';
$sql = "CREATE TABLE GUESTBOOK( ".
       "id INT NOT NULL AUTO_INCREMENT, ".
       "name VARCHAR(250) NOT NULL, ".
       "email VARCHAR(250) NOT NULL, ".
       "message VARCHAR(250) NOT NULL, ".
       "time VARCHAR(50) NOT NULL, ".
       "date VARCHAR(50) NOT NULL, ".
       "ip VARCHAR(50) NOT NULL, ".
       "PRIMARY KEY ( id )); ";
mysql_select_db("$dbname");
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not create table: ' . mysql_error());
}
echo "Table created successfully\n";
mysql_close($conn);
?>
</body>
</html>