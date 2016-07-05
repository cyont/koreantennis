<?php include("../db/db.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Photo Album Admin</title>
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="document.admin.name.focus();">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="44" align="center" valign="middle" class="headerbg"><h1><a href="../index.php">Korean Tennis Photo Album Admin</a></h1></td>
      </tr>
    </table>
      <table width="759" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" align="center" valign="top" class="menuline">
		<h4><a href="index.php">Admin Login </a></h4>
		 | 
		<h4><a href="main.php">Admin Home</a></h4></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <form action="adminAuth.php" method="post" name="admin" id="admin">
		<td align="center"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" class="brd1"><table width="600" border="0" cellspacing="1" cellpadding="4">
                <tr>
                  <td width="120" align="left" class="color1">Login</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="right">User Name:</td>
                  <td><label>
                  <input name="name" type="text" class="frmtxt" id="name" size="60">
                  </label></td>
                </tr>
                <tr>
                  <td width="120" align="right">Password:</td>
                  <td><input name="password" type="password" class="frmtxt" id="password" size="60"></td>
                </tr>

                <tr>
                  <td width="120" align="right">&nbsp;</td>
                  <td><label>
                    <input name="Submit" type="submit" class="btn" value="Login">
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
        <form action="index.php?action=send" method="post" name="request" id="request">
		<td align="center"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" class="brd1"><table width="600" border="0" cellspacing="1" cellpadding="4">
                <tr>
                  <td width="120" align="left" class="color1">Lost Password?</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="right">User Name:</td>
                  <td><label>
                  <input name="una" type="text" class="frmtxt" id="una" size="60">
                  </label></td>
                </tr>
                <tr>
                  <td width="120" align="right">Email:</td>
                  <td><input name="uem" type="text" class="frmtxt" id="uem" size="60"></td>
                </tr>
                <tr>
                  <td width="120" align="right">&nbsp;</td>
                  <td><label>
                    <input name="Submit3" type="submit" class="btn" value="Request">
                    <input name="Submit22" type="reset" class="btn" value="Clear">
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
        <td align="center">
		
		
		
		
		
<?php
$_REQUEST["action"] = "";
$_REQUEST["una"] = "";
$_REQUEST["uem"] = "";

$action=$_REQUEST["action"];
$una=$_REQUEST["una"];
$uem=$_REQUEST["uem"];


				if($action=='Arelogin')
				{
				echo "<font color='#ff0000'>Invalid User Name or Password, Please Try Again</font>";
				}
				?>
          <?php
				if($action=='Apl')
				{
				echo "<font color='#ff0000'>Please Login</font>";
				}
				?>          <?php
				if($action=='Aloggedout')
				{
				echo "You have successfully logged out";
				}
				?>


			<?php
			if($action=='send')
			{
			$sql="select * from admin where admin='$una' AND email='$uem'";
			$resultset=mysql_query($sql);
			$c=mysql_num_rows($resultset);
			if($c>0)
			{
				$tuser=mysql_result($resultset,0,"admin");
				$password=mysql_result($resultset,0,"pass");
				$temail=mysql_result($resultset,0,"email");

				// mail info
				$to=$temail;
				$subject="Your Password Informations";
				$message="Here is your login information
				Username : $tuser
				Password : $password

				";
				$from="admin";
				$headers = 'From: admin';
				mail($to,$subject,$message,$from,$headers);
				echo "Your Password has been sent to email you provided. Login to your email account to get your password informations.
				 ";

			}
			else
			{
				echo "<font color='#ff0000'>User Name or Email Invalid! </font>";
			}

			}
			?>		</td>
      </tr>
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
