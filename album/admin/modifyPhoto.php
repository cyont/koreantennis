<?php session_start();
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

<body onLoad="document.frm_update.captionu.focus();">
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
        <td>
<?php
// $_REQUEST["actiongo"] = "";

$idg=$_REQUEST["actiongo"];
$sqla="select * from pics WHERE id='$idg' order by id desc";
if(mysql_query($sqla))
{
$checka=mysql_query($sqla);
$noa=mysql_num_rows($checka);
}
?>	</td>
      </tr>
      

	  <tr>
        <td class="pad2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top">
            EDIT
			</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        
		<form action="updatePhotoGo.php" method="post" name="frm_update" id="frm_update">
		<td align="center"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" class="brd1"><table width="600" border="0" cellspacing="1" cellpadding="4">

                <tr>
                  <td align="right">Caption:</td>
                  <td><label>
                    <input name="captionu" type="text" class="frmtxt" id="captionu" size="60" value="<?php print mysql_result($checka,0,"caption"); ?>">
                  </label></td>
                </tr>
                <tr>
                  <td width="120" align="right" valign="top">Description:</td>
                  <td><textarea name="descu" cols="59" rows="5" class="frmtxt" id="descu"><?php print mysql_result($checka,0,"descc"); ?></textarea></td>
                </tr>
                <tr>
                  <td align="right">Hits:</td>
                  <td><label>
                    <input name="hitsu" type="text" class="frmtxt" id="hitsu" size="60" value="<?php print mysql_result($checka,0,"hits"); ?>">
                  </label></td>
                </tr>
                <tr>
                  <td width="120" align="right">&nbsp;</td>
                  <td><label>
                    <input name="Submit" type="submit" class="btn" value="Update">
                    <input name="Submit2" type="reset" class="btn" value="Clear">
                  </label></td>
                </tr>
            </table></td>
          </tr>
        </table></td>
		<input name="actionu" type="hidden" value="<?php print mysql_result($checka,0,"id"); ?>">
		</form>
		
		
		
		
		
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
