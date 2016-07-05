<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connKoreanTennis = "localhost";
$database_connKoreanTennis = "db361004340";
$username_connKoreanTennis = "root";
$password_connKoreanTennis = "wasuri";
$connKoreanTennis = mysql_pconnect($hostname_connKoreanTennis, $username_connKoreanTennis, $password_connKoreanTennis) or trigger_error(mysql_error(),E_USER_ERROR); 
?>