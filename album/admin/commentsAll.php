<?php
session_start();
	 if($_SESSION['AName']=="")
		 {
		 header("location: index.php?action=Apl");
		 exit();
		 }
?>
<?php include("../db/db.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Muhammad Javed Khalil Photo Album Admin</title>
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="44" align="left" valign="middle" class="headerbg"><h1><a href="../index.php">PHP Photo Album</a></h1></td>
      </tr>
    </table>
      <table width="759" border="0" cellspacing="0" cellpadding="0">
      <?php include("admin_nav.php"); ?>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr align="left">
        
		  <td align="center" class="menu2"><a href="comments.php">Approve</a> | <a href="commentsAll.php">View/Delete All/Old</a> </td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr align="left">
        <td>Total: 
		
		
<?php
$sqla="select * from comments WHERE status='1' order by id desc";
if(mysql_query($sqla))
{
$checka=mysql_query($sqla);
$noa=mysql_num_rows($checka);
}
?>	<?php echo "$noa"; ?>		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      
<?php
for($i=0; $i<$noa; $i++)
{
?>
	  <tr>
        <td class="pad2">
		Name: <?php print mysql_result($checka,0+$i,"name"); ?><br>
		Email: <?php print mysql_result($checka,0+$i,"email"); ?><br>
		Comment: <?php print mysql_result($checka,0+$i,"comment"); ?><br>
		
		<a href="delComment.php?action=<?php print mysql_result($checka,0+$i,"id"); ?>" class="linksim">Delete</a>
	</td>
      </tr>
<?php
}
?>	  
	  
	  
	  
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>
        <td align="left" bgcolor="#1B1B1B" class="footer"><h3><a href="../index.php">Album Home</a> | <a href="http://www.techmynd.com/projects/php-photo-album.php">About</a> | <a href="http://www.techmynd.com/contact/">Contact</a></h3>
          <span style="padding-left:9px;"></span>http://www.techmynd.com<br>
          <span style="padding-left:9px;"></span>A PHP Dynamic Photo Album by TechMynd</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
