<?php session_start();

$_SESSION['AName'] = '';

	if($_SESSION['AName']!="")
		{
				header("Location: main.php");

		}

include("../db/db.php");
// store user name and password into session
		$AName= $_REQUEST["name"];
		$APass=$_REQUEST["password"];
	$sql="SELECT * FROM admin WHERE admin = '$AName' AND pass = '$APass'";
	$rs = @mysql_query($sql);
// here we check stored session values of user and pass , if they match with database ...
	if( mysql_num_rows($rs) > 0)
	{
		$_SESSION['AName']=$AName;
		$_SESSION['APass']=$APass;

		header("Location: managePhotos.php");

}
	else
	{

header("Location: index.php?action=Arelogin");

}
?>