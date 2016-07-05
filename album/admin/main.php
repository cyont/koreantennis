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
        <td height="44" align="left" valign="middle" class="headerbg"><h1><a href="../index.php">PHP Photo Album</a></h1></td>
      </tr>
    </table>
      <table width="759" border="0" cellspacing="0" cellpadding="0">
      <?php include("admin_nav.php"); ?>
      <tr>
        <td align="center">&nbsp;
		
<?php 

$action=$_REQUEST["action"];
$name=$_REQUEST["name"];
$pass=$_REQUEST["pass"];
$email=$_REQUEST["email"];
$status=$_REQUEST["status"];
$adsc=$_REQUEST["adsc"];
$adsc2=$_REQUEST["adsc2"];
$adsc3=$_REQUEST["adsc3"];
$adsc4=$_REQUEST["adsc4"];
$adsc5=$_REQUEST["adsc5"];
$adsc6=$_REQUEST["adsc6"];
$adsc7=$_REQUEST["adsc7"];

if($action=='up')
{
$sqlup="update admin set admin='$name',pass='$pass',email='$email',ads='$status',adsbody='$adsc',adsbody2='$adsc2',adsbody3='$adsc3',adsbody4='$adsc4',adsbody5='$adsc5',adsbody6='$adsc6',adsbody7='$adsc7'";
						$string=mysql_query($sqlup);
						if($string==true)

							{
							$mes="Account Updated";
							}
							else
							{
							$mes="Not Updated";
							}
}		
?>		


		
<?php
$sql="select * from admin";
if(mysql_query($sql))
{
$check=mysql_query($sql);
$no=mysql_num_rows($check);
}
?>
		
		
		
		</td>
      </tr>
      <tr>
        
		  <form action="main.php?action=up" method="post" name="update" id="update">
		  <td align="center"><table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center" class="brd1"><table width="600" border="0" cellspacing="1" cellpadding="4">
                  <tr>
                    <td width="120" align="left" class="color1">Account Settings </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right">User Name:</td>
                    <td><label>
                      <input name="name" type="text" class="frmtxt" id="name" size="60" value="<?php print mysql_result($check,0,'admin'); ?>">
                    </label></td>
                  </tr>
                  <tr>
                    <td width="120" align="right">Password:</td>
                    <td><input name="pass" type="password" class="frmtxt" id="pass" size="60" value="<?php print mysql_result($check,0,'pass'); ?>"></td>
                  </tr>
                  <tr>
                    <td align="right">Email:</td>
                    <td><input name="email" type="text" class="frmtxt" id="email" size="60" value="<?php print mysql_result($check,0,'email'); ?>"></td>
                  </tr>
                  <tr>
                    <td align="right">Ads Status: </td>
                    <td><input name="status" type="text" class="frmtxt" id="status" size="60" value="<?php print mysql_result($check,0,'ads'); ?>"></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Ads Script 1:<br>468x60</td>
                    <td><textarea name="adsc" cols="60" rows="10" class="frmtxt" id="adsc"><?php print mysql_result($check,0,'adsbody'); ?></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Ads Script 2:<br>
                      728x90 4 links </td>
                    <td><textarea name="adsc2" cols="60" rows="10" class="frmtxt" id="adsc2"><?php print mysql_result($check,0,'adsbody2'); ?></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Ads Script 3:<br>
                      728x90 image </td>
                    <td><textarea name="adsc3" cols="60" rows="10" class="frmtxt" id="adsc3"><?php print mysql_result($check,0,'adsbody3'); ?></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Ads Script 4:<br>
                      728x15 link unit </td>
                    <td><textarea name="adsc4" cols="60" rows="10" class="frmtxt" id="adsc4"><?php print mysql_result($check,0,'adsbody4'); ?></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Ads Script 5:</td>
                    <td><textarea name="adsc5" cols="60" rows="10" class="frmtxt" id="adsc5"><?php print mysql_result($check,0,'adsbody5'); ?></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Ads Script 6:</td>
                    <td><textarea name="adsc6" cols="60" rows="10" class="frmtxt" id="adsc6"><?php print mysql_result($check,0,'adsbody6'); ?></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Ads Script 7:</td>
                    <td><textarea name="adsc7" cols="60" rows="10" class="frmtxt" id="adsc7"><?php print mysql_result($check,0,'adsbody7'); ?></textarea></td>
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
		  </form>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">&nbsp;<?php if($action=='up') { echo "$mes"; } ?>&nbsp;</td>
      </tr>
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
