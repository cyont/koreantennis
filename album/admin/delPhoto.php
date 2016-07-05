<?php session_start();
	 if($_SESSION['AName']=="")
		 {
		 header("location: index.php?action=Apl");
		 exit();
		 }
include("../db/db.php");
$ref=getenv('HTTP_REFERER');
$id1=$_REQUEST["action"];



$sql="select * from pics where id='$id1'";
				$check=mysql_query($sql);
				$no=mysql_num_rows($check);
$delf2=mysql_result($check,0,"img");


						$sqlup="DELETE from pics where id='$id1'";
						$string=mysql_query($sqlup);

						// unlink("../photos/$delf2");

						if($string==true)
							{
					header("location: managePhotos.php");
					// header("location: $ref");
							}

				else
					{
					header("location: $ref");
					}
?>