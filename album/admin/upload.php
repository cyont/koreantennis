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
      <tr>
        
		  <form action="upload.php?action=go" method="post" enctype="multipart/form-data" name="img" id="img">
		  <td align="center"><table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center" class="brd1"><table width="600" border="0" cellspacing="1" cellpadding="4">
                  <tr>
                    <td width="120" align="left" class="color1">Upload</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right">Caption:</td>
                    <td><label>
                      <input name="cap" type="text" class="frmtxt" id="cap" size="60">
                    </label></td>
                  </tr>
                  <tr>
                    <td width="120" align="right" valign="top">Description:</td>
                    <td><textarea name="descc" cols="59" rows="5" class="frmtxt" id="descc"></textarea></td>
                  </tr>
                  <tr>
                    <td align="right">Picture Date:</td>
                    <td><label>
                      <input name="picture_date" type="text" class="frmtxt" id="picture_date" size="30" value="<?php echo date("Y-n-j") . " " . "00:00:00"; ?>">
                    </label></td>
                  </tr>
                  <tr>
                    <td align="right">Image File:</td>
                    <td><label>
                      <input name="file1" type="file" class="frmtxt" id="file1" size="46">
                    </label></td>
                  </tr>

                  <tr>
                    <td width="120" align="right">&nbsp;</td>
                    <td><label>
                      <input name="Submit" type="submit" class="btn" value="Upload">
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
        <td align="center">&nbsp;
		
<?php
if((isset($_REQUEST["action"])) && ($_REQUEST["action"]=='go'))
{
// Need a class to create thumbnail.
   include('SimpleImage.php');
   // http://www.white-hat-web-design.co.uk/blog/resizing-images-with-php/
	
// Create a new file name for the uploaded file.
	$file_name=$_FILES['file1']['name'];
	$string_length = strlen($file_name);
	$new_string = substr($file_name, $string_length - 6, $string_length);
	$extension = strstr($new_string, '.');
	$extension_length = strlen($extension) - 1;
	$string_base = substr($file_name, 0, $string_length - ($extension_length + 1));
	$filename_new =  $string_base . "_" . date("Gis") . $extension;
	if ($filename_new != "")
	{
	$sUploadDir = '../photos/';
	$sUploadedFile = $sUploadDir . $filename_new;
	
	// Upload file(s) on server
	move_uploaded_file($_FILES['file1']['tmp_name'], $sUploadedFile);

	// Get width and height of the image.
	list($width, $height)=getimagesize($sUploadedFile); 
	
	// If it's too big, make it smaller.
	if ($width > 800) {
	$image = new SimpleImage();
	$image->load($sUploadedFile);
	// $image->resize(650,400);
	// $image->scale(50);
	$image->resizeToWidth(800);
	$image->save($sUploadedFile);
	}	
	list($width_big, $height_big)=getimagesize($sUploadedFile);
	
	// Create thumbnail.
	$image = new SimpleImage();
	$image->load($sUploadedFile);
	$image->resizeToWidth(150);
	$image->save('../photos/thumb/' . $filename_new);
	list($width_small, $height_small)=getimagesize('../photos/thumb/' . $filename_new); 
	}

$cap=$_REQUEST["cap"];
$descc=$_REQUEST["descc"];
$picture_date=$_REQUEST["picture_date"];
// $picture_date = date("Y-n-j") . " " . "00:00:00";
if (isset($width_big)) {
$width_big = $width_big;
$height_big = $height_big;
} else {
$width_big = 0;
$height_big = 0;
}

if (isset($width_small)) {
$width_small = $width_small;
$height_small = $height_small;
} else {
$width_small = 0;
$height_small = 0;
}
// Insert records in the database.
$sqlup="INSERT INTO pics (caption, descc, img, width_big, height_big, width_small, height_small, hits, date_uploaded) values('$cap','$descc','$filename_new', $width_big, $height_big, $width_small, $height_small, 1, '$picture_date')";
$update=mysql_query($sqlup);

header("location: managePhotos.php");
}
?>		

		&nbsp;</td>
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
