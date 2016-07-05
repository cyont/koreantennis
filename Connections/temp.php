<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
date_default_timezone_set('America/Los_Angeles');

$servername = "localhost";
$database = "koreante_db3610";
//$username_connTennis = "koreante";
//$password_connTennis = "1qazxsw2";
$username = "root";
$password = "Kampoopoo889";
$conn = mysqli_connect($servername, $username, $password, $database);
// $connTennis = mysqli_connect($hostname_connTennis, $username_connTennis, $password_connTennis) or trigger_error(mysql_error(),E_USER_ERROR); 

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());	
}
mysqli_select_db($conn, $database);
echo "Conneted Successfully";
?>