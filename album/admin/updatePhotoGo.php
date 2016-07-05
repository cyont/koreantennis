<?php session_start();
	 if($_SESSION['AName']=="")
		 {
		 header("location: index.php?action=Apl");
		 exit();
		 }
include("../db/db.php");
$ref=getenv('HTTP_REFERER');

$idg=$_REQUEST["actionu"];

$captionu=$_REQUEST["captionu"];
$descu=$_REQUEST["descu"];
$hitsu=$_REQUEST["hitsu"];


$sql="update pics set caption='$captionu',descc='$descu',hits='$hitsu' where id='$idg'";
// $sql2="update pics set desc='$descu' where id='$idg'";


$string=mysql_query($sql);
// $string2=mysql_query($sql2);


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