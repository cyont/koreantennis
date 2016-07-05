<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
// Change this.
date_default_timezone_set('America/Los_Angeles');

$hostname_connTennis = "localhost";
$database_connTennis = "koreante_db3610";
//$username_connTennis = "koreante";
//$password_connTennis = "1qazxsw2";
$username_connTennis = "root";
$password_connTennis = "Kampoopoo889";
$connTennis = mysqli_connect($hostname_connTennis, $username_connTennis, $password_connTennis, $database_connTennis);
// $connTennis = mysqli_connect($hostname_connTennis, $username_connTennis, $password_connTennis) or trigger_error(mysql_error(),E_USER_ERROR); 

if (!$connTennis) {
	die("Connection failed: " . mysqli_connect_error());	
}
//mysqli_select_db($connTennis, $database_connTennis);
//echo "Conneted Successfully";



//$servername = "localhost";
//$database = "koreante_db3610";
////$username_connTennis = "koreante";
////$password_connTennis = "1qazxsw2";
//$username = "root";
//$password = "Kampoopoo889";
//$conn = mysqli_connect($servername, $username, $password, $database);
//// $connTennis = mysqli_connect($hostname_connTennis, $username_connTennis, $password_connTennis) or trigger_error(mysql_error(),E_USER_ERROR); 
//
//if (!$conn) {
//	die("Connection failed: " . mysqli_connect_error());	
//}
//mysqli_select_db($conn, $database);
//echo "Conneted Successfully";

?>