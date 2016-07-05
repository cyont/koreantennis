<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
date_default_timezone_set('America/Los_Angeles');

//$hostname_connTennis = "localhost";
//$database_connTennis = "koreante_db3610";
//$username_connTennis = "koreante";
//$password_connTennis = "1qazxsw2";
//$connTennis = mysql_pconnect($hostname_connTennis, $username_connTennis, $password_connTennis) or trigger_error(mysql_error(),E_USER_ERROR); 

// $connTennis = new PDO('mysql:host=localhost;dbname=koreante_db3610;charset=utf8', 'koreante', '1qazxsw2');

//$db = new PDO('mysql:host=localhost;dbname=koreante_db3610;charset=utf8', 'koreante', '1qazxsw2', array(PDO::ATTR_EMULATE_PREPARES => false, 
//                                                                                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

//$connTennis =new PDO('mysql:host=localhost;dbname=koreante_db3610;charset=utf8', 'koreante', '1qazxsw2');
//$connTennis->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$connTennis->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$connTennis = mysqli_connect('localhost', 'koreante', '1qazxsw2', 'koreante_db3610');


?>