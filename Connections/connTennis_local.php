<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connTennis = "localhost";
$database_connTennis = "koreante_db3610";
$username_connTennis = "koreante";
$password_connTennis = "1qazxsw2";
$connTennis = mysql_pconnect($hostname_connTennis, $username_connTennis, $password_connTennis) or trigger_error(mysql_error(),E_USER_ERROR); 
?>