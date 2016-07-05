<?php include("db/db.php"); ?>
<?php
define("QS_VAR", "page"); // the variable name inside the query string (dont use this name inside other links)
define("NUM_ROWS", 10); // the number of records on each page

define("STR_FWD", "&nbsp; &#8250;&#8250;"); // the string is used for a link (step forward)
define("STR_BWD", "&#8249;&#8249; &nbsp;"); // the string is used for a link (step backward)

// use the rught pathes to get it working with the php function getimagesize

// define("IMG_FWD", "./forward.gif"); // the image for forward link
// define("IMG_BWD", "./backward.gif"); // the image for backward link

define("NUM_LINKS", 10); // the number of links inside the navigation (the default value)

include("my_pagina_class.php");
$test = new MyPagina;

$test->sql = "SELECT * FROM pics ORDER BY id DESC";

$result = $test->get_page_result(); // result set
$num_rows = $test->get_page_num_rows(); // number of records in result set
$nav_links = $test->navigation(" &nbsp;|&nbsp; ", "currentStyle"); // the navigation links (define a CSS class selector for the current link)
$nav_info = $test->page_info("to"); // information about the number of records on page ("to" is the text between the number)
$simple_nav_links = $test->back_forward_link(true); // the navigation with only the back and forward links, use true to use images
$total_recs = $test->get_total_rows(); // the total number of records
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Tucson Korean Tennis Photo Album</title>
<meta name="keywords" content="Tucson Korean Tennis Association Photo Album">
<meta name="keyphrases" content="Tucson Korean Tennis Association Photo Album">
<meta name="subject" CONTENT="Tucson Korean Tennis Association Photo Album">
<meta name="topic" content="Tucson Korean Tennis Association Photo Album">
<meta name="summary" CONTENT="Tucson Korean Tennis Association Photo Album">
<script type="text/javascript" language="javascript" src="scripts/status.js"></script>
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="44" align="center" valign="middle" class="headerbg"><h2><a href="index.php">Photo Album</a></h2></td>
      </tr>
    </table>
    
      <table width="800" border="0" cellspacing="0" cellpadding="5" bgcolor="#1B1B1B">
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="left"><span class="color2">Total Photos:</span> <span class="color3"><?php echo "$total_recs"; ?></span></td>
      </tr>
      <tr>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">&nbsp;<span class="navlinks"><?php echo $nav_links; ?></span>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>

	  <tr>
        <td align="center">
<?php
for($i = 0; $i < $num_rows; $i++)
{
?>
<a href="details.php?action=<?php print mysql_result($result,$i,"id"); ?>">
<img src="photos/thumb/<?php print mysql_result($result,$i,"img"); ?>" width="<?php print mysql_result($result,$i,"width_small"); ?>" height="<?php print mysql_result($result,$i,"height_small"); ?>" border="0" class="imgst" alt="<?php print mysql_result($result,$i,"caption"); ?>" title="<?php print mysql_result($result,$i,"caption"); ?>"></a>
<?php
}
?>		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">&nbsp;<span class="navlinks"><?php echo $nav_links; ?></span>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td class="brdboth">
</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="center" valign="bottom"> <tr>
        <td align="center" bgcolor="#1B1B1B" class="footer">
        <h3><a href="../eng/index.php"><u>Go Back to Korean Tennis Home</u></a></h3>
         </td>
      </tr>
      </td>
  </tr>
</table>
</body>
</html>