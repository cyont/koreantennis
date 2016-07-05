<?php require_once('../Connections/connTennis.php'); ?>
<?php
$page_title = "Home - Tucson Korean Tennis Association"; 
$file_name = "index.php";

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rsAnnouncement = "-1";
if (isset($_GET['lid'])) {
  $colname_rsAnnouncement = $_GET['lid'];
}
mysql_select_db($database_connTennis, $connTennis);
$query_rsAnnouncement = "SELECT * FROM announcement WHERE lid = 21 and koreantennis = 1 and active=1 ORDER BY `timestamp` DESC";
$rsAnnouncement = mysql_query($query_rsAnnouncement, $connTennis) or die(mysql_error());
$row_rsAnnouncement = mysql_fetch_assoc($rsAnnouncement);
$totalRows_rsAnnouncement = mysql_num_rows($rsAnnouncement);
 
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html40/strict.dtd">
<html>
<head>
<?php include('header.php'); ?>
</head>
<body id="main_body">
   <div id="container">
   <div id="header">
   <?php include('language_choice.php'); ?>
   <div id="key_visual">
   <?php include('logo.php'); ?>
   </div>
   </div>
   <div id="main_container">
   <table>
       <tr>
       <td colspan="1" id="sub_nav_column" rowspan="1">
       <div id="left_column_container">
       <div id="main_nav_container">
       <?php include('navigation.php'); ?>
       </div>
       <div id="sub_container1"></div>
       </div>
       </td>
       <td colspan="1" id="content_column" rowspan="1">
       <div id="sub_container2">
       <div class="content" id="content_container">
       <h3>Tucson Korean Tennis Association</h3>
       <p>
       <div class="subtitle_black">Announcement</div>
       <?php if ($row_rsAnnouncement['id'] > 0) { ?>
       <ul>
       	 <?php do { ?>
       	   <li><span class="contenttitle_green"><?php echo $row_rsAnnouncement['title']; ?></span> (posted on <span class="text_red"><?php echo date('n/j/Y, h:i A', strtotime($row_rsAnnouncement['timestamp'])); ?></span>)<br />
		   <?php echo $row_rsAnnouncement['announcement']; ?></li>
       	   <?php } while ($row_rsAnnouncement = mysql_fetch_assoc($rsAnnouncement)); ?></ul>
         <?php } else { ?>
         Currently there is no active announcement.
         <?php } ?>
       </p>

       <p>
       <div class="contentsubtitle_orange">Tennis Tournament Coming!!</div>
       The second Arizona Korean Tennis Tournament sponsored by Southern Arizona Korean Assoication President is scheduled on Apr. 24, 2010. <br /><br />
       <div align="center"><img src="../images/280E1901.jpg" width="500" height="205" alt="2009 Korean Tennis Tournament" title="2009 Korean Tennis Tournament">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
       2009 Korean Tennis Tournament&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	   <p>
       <div id="givepadding_more">
       <span class="contenttitle_blue">TIME:</span> Apr. 24 (Sat).  11:00 AM <br />
       <span class="contenttitle_blue">LOCATION:</span> Fort Lowell Park Tennis Center<br />
       <div id="leftmargin_40"><a href="timelocation.php" target="_blank">2900 North Craycroft Rd, Tucson, AZ 85712</a> <br />(NE corner of Craycroft & Glenn)</div>
       <span class="contenttitle_blue">Prizes:</span> Prizes will be awarded at Korea House after dinner.
       <div id="leftmargin_40">
       <table width="400px" border="1" cellspacing="0" cellpadding="3">
          <tr align="center">
            <td rowspan="4" class="contenttitle_black">Singles</td>
            <td class="contenttitle_black">Groups</td>
            <td class="contenttitle_black">1st Winner</td>
            <td class="contenttitle_black">2nd Winner</td>
          </tr>
          <tr align="center">
            <td align="left">A (Advanced)</td>
            <td>$80</td>
            <td>$40</td>
          </tr>
          <tr align="center">
            <td align="left">B (Intermediate)</td>
            <td>$60</td>
            <td>$30</td>
          </tr>
          <tr align="center">
            <td align="left">C (Beginner)</td>
            <td>$40</td>
            <td>$20</td>
          </tr>
          <tr align="center">
            <td class="contenttitle_black">Doubles</td>
            <td>&nbsp;</td>
            <td>$100</td>
            <td>$60</td>
          </tr>
        </table>
		</div>
       <span class="contenttitle_blue">Participation Fee:</span> 
       <div id="leftmargin_40">
       <span class="contenttitle_black">Singles:</span> Students ($15), Others ($20)<br />
       <span class="contenttitle_black">Doubles:</span> $15 each<br />
       <span class="contenttitle_black">Singles and Doubles both:</span> $25<br />
       </div>
       <span class="contenttitle_blue">Qualifications for Participation:</span> <br />
       <div id="leftmargin_40">Tucson Korean Tennis Assoication members including non-Koreans and <br />any Koreans and their children residing in Arizona</div>
       <span class="contenttitle_blue">Dinner:</span> After all games are done, free dinner will be served at Korea House.<br />
       <div id="leftmargin_40"><a href="http://maps.google.com/maps?rls=com.microsoft:en-us:IE-SearchBox&oe=UTF-8&rlz=1I7GGLL_en&um=1&ie=UTF-8&q=korean+house+in+tucson&fb=1&gl=us&hq=korean+house&hnear=tucson&cid=0,0,6072910033209302188&ei=XTrCS8GxHc38nAeq_Zn-CQ&sa=X&oi=local_result&ct=image&resnum=1&ved=0CAoQnwIwAA" target="_blank">4030 East Speedway Blvd., Tucson, AZ 85712</a> <br />(on Speedway between Alvernon and Columbus)</div>
       <span class="contenttitle_blue">Registration:</span>  Please register in advance for the convenience on the game day.
       <div id="leftmargin_40">
       <span class="contenttitle_black">Phone:</span> 520-750-9009<br />
       <span class="contenttitle_black">Email:</span> <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a><br />Email with the participant's name, phone number, address, email address and the group, including singles or doubles, to play in.
       The participation fee can be paid on the game day before the game.  This will be a registration without commitment.  Somehow if you can't join the tournament after registration, the registration will be automatically canceled so that you don't owe any money.
       </div>
       </div>
       </p>
       </p>

       <p>
       <div class="subtitle_black">Welcome!</div>
       Tucson Korean Tennis Association is an open community which welcomes anyone that loves playing tennis.  The association consists of people with vaious occupations, students, young and old, men and women, and players with all different levels of tennis skills.  Most of the members are Koreans, but it's not exclusive to non-Koreans.  Anybody can join and play.  So just come and you will have somebody to play with.
       </p>
       </div>
       </div>
       </td>
       </tr>
   </table>
   </div>
   <div id="content_b"></div>
   <?php include('footer.php'); ?>
   </div>
</body>
</html>
<?php
mysql_free_result($rsAnnouncement);
?>