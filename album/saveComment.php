<?php session_start();
$name=$_REQUEST["name"];
$comments=$_REQUEST["comments"];
$imgid=$_REQUEST["imgid"];
$ref=getenv('HTTP_REFERER');
// $ref=@$HTTP_REFERER;

include("db/db.php");

$t= date("M d, Y");
// $domain = GetHostByName($REMOTE_ADDR);

$sql="insert into comments (imgid, name,comment, date, status) values('$imgid','$name','$comments','$t',1)";
mysql_query($sql)==true;

// Now mail admin to tell him about entry

	$sqlem="select * from admin";
	if(mysql_query($sqlem))
	{
	$checkem=mysql_query($sqlem);
	$noem=mysql_num_rows($checkem);
	$emm=mysql_result($checkem,0,"email");
	}

$myemail = $emm;
$subject= "New Comment for Photo Album";
$mysite="contact@koreantennis.org";
$todayis = date("l, F j, Y, g:i a") ;
// $domain = GetHostByName($REMOTE_ADDR);

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: $mysite\r\n";

// Additional headers


$mmessage = "
Date: $todayis<br>
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::<br>
<h4>Hello,</h4>
You have recieved a new entry for Korean Tennis Album from <b>$name</b>.<br>
<br>
<b>Name</b> ----------------- $name <br>
<b>Comments</b> ------------- $comments
<br><br>

";

mail($myemail, $subject, $mmessage, $headers);
?>
		<script language="javascript" type="text/javascript">
			document.location = "details.php?action=<?php echo "$imgid"; ?>";
		</script>
