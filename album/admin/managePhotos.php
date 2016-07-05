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
<title>Photo Album Admin</title>
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
        <td height="44" align="center" valign="middle" class="headerbg"><h1><a href="../index.php">Korean Tennis Photo Album Admin</a></h1></td>
      </tr>
    </table>
      <table width="759" border="0" cellspacing="0" cellpadding="0">
      <?php include("admin_nav.php"); ?>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="menu2"><a href="upload.php">Upload</a> | <a href="managePhotos.php">Manage Photos</a> </td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr align="left">
        <td>Total: 
		
		
<?php
$sqla="select * from pics order by id desc";
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
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td width="150" align="right" valign="top">
			<a href="../photos/<?php print mysql_result($checka,0+$i,"img"); ?>" height="<?php print mysql_result($checka,0+$i,"height_small"); ?>" target="_blank"><img src="../photos/thumb/<?php print mysql_result($checka,0+$i,"img"); ?>" height="<?php print mysql_result($checka,0+$i,"height_small"); ?>" width="<?php print mysql_result($checka,0+$i,"width_small"); ?>" border="0" class="imgst"></a>

			</td>
            
            <td align="left" valign="top">
Caption: <?php print mysql_result($checka,0+$i,"caption"); ?><br>
Description: <?php print mysql_result($checka,0+$i,"descc"); ?><br>
<a href="delPhoto.php?action=<?php print mysql_result($checka,0+$i,"id"); ?>" class="linksim">Delete</a> | 
<a href="modifyPhoto.php?actiongo=<?php print mysql_result($checka,0+$i,"id"); ?>" class="linksim">Modify</a>
</td>
            
          </tr>
        </table></td>
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
        <td align="center" bgcolor="#1B1B1B" class="footer">
        <h3><a href="../index.php">Album Home</a> | <a href="../../eng/index.php">Korean Tennis Home</a></h3>
         </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
