<?php session_start();
	 if($_SESSION['AName']=="")
		 {
		 header("location: index.php?action=Apl");
		 exit();
		 }
include("../db/db.php");
$ref=getenv('HTTP_REFERER');
$id1=$_REQUEST["action"];


						$sqlup="DELETE from comments where id='$id1'";
						$string=mysql_query($sqlup);
						if($string==true)
							{
					header("location: comments.php");
							}

				else
					{
					header("location: $ref");
					}
?>