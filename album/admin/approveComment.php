<?php session_start();
	 if($_SESSION['AName']=="")
		 {
		 header("location: index.php?action=Apl");
		 exit();
		 }
include("../db/db.php");
$ref=getenv('HTTP_REFERER');
$id1=$_REQUEST["action"];


$sqlup="update comments set status='1' WHERE id='$id1'";
$string=mysql_query($sqlup);

						if($string==true)
							{
					header("location: $ref");
							}

				else
					{
					header("location: $ref");
					}
?>