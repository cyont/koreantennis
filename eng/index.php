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
//mysqli_select_db($database_connTennis, $connTennis);
// mysqli_select_db (mysqli $link, string $database_connTennis);
mysqli_select_db($connTennis, $database_connTennis);
// echo "Conneted Successfully";

$query_rsAnnouncement = "SELECT * FROM announcement WHERE lid = 21 and koreantennis = 1 and active=1 ORDER BY `timestamp` DESC";
$rsAnnouncement = mysqli_query($query_rsAnnouncement, $connTennis) or die(mysql_error());
$row_rsAnnouncement = mysql_fetch_assoc($rsAnnouncement);
$totalRows_rsAnnouncement = mysql_num_rows($rsAnnouncement);
 
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html40/strict.dtd">
<html>
<head>
<?php include('header.php'); ?>
<link rel="stylesheet" type="text/css" media="screen" href="../styles/lightbox.css"  />
<script type="text/javascript" src="../scripts/scriptaculous/lib/prototype.js"></script>
<script type="text/javascript" src="../scripts/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="../scripts/lightbox.js"></script>
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
       <div class="subtitle_black">Announcements <span class="textsmall_black" classs=""><a href="announcement_archives.php">(Announcement Archives)</a></span> </div>
       <?php if ($row_rsAnnouncement['id'] > 0) { ?>
       <ul>
       	 <?php do { ?>
       	   <li><span class="contenttitle_green"><?php echo $row_rsAnnouncement['title']; ?></span> (posted on <span class="text_red"><?php echo date('n/j/Y, h:i A', strtotime($row_rsAnnouncement['timestamp'])); ?></span>)<br />
		   <?php echo $row_rsAnnouncement['announcement']; ?><br /><br /></li>
       	   <?php } while ($row_rsAnnouncement = mysql_fetch_assoc($rsAnnouncement)); ?></ul>
         <?php } else { ?>
         Currently there is no active announcement.
         <?php } ?>
       </p>

	   <!--Tennis Lesson Section
       <p>
       <div class="subtitle_black">Tennis Lessons</div>
       <span class="contenttitle_orange">Free tennis lessons will be held for one hour every Friday.</span>  <br />
       All Tucson Korean Tennis Association members and any new visitors, young and old, men and women are welcome to participate.  New participants will be automatically registered as members.  The lessons are free and the membership fee is $10 per month.  <br />
       <br />
       
       <div id="givepadding_more">
       <span class="contenttitle_blue">Time:</span> Every Friday  8:00 - 9:00 PM <br />
       <span class="contenttitle_blue">Location:</span> Fort Lowell Park Tennis Center<br />
       		<div id="leftmargin_40"><a href="timelocation.php" target="_blank">2900 North Craycroft Rd, Tucson, AZ 85712</a> (NE corner of Craycroft & Glenn)</div>
       
		</div>
       </p>
       -->

<!--
       <p>
       <div class="subtitle_black">Singles Match Night</div>
       <span class="contenttitle_orange">Sep. 16 is a singles match night.</span>  <br />
       We decided to play singles on Sep. 16 among members. Check-ins and drawings will start from 7:15 pm until 7:45 pm, and games should start at 7:45 pm.  Since we will have a limited time to finish the whole games, there will be no deuce, in other words, after 40-40 the next point will decide the game, and 5 games will be considered as 1 set. <br />
       <br />
       
       <div id="givepadding_more">
       <span class="contenttitle_blue">Check-ins/Drawings:</span> 7:15 - 7:45 PM <br />
       <span class="contenttitle_blue">Game Time:</span> Sep. 16 (Fri), 7:45 PM - 10:00 PM<br />
       <span class="contenttitle_blue">Groups:</span> A (advanced), B (intermediate) and C (beginner)<br />
       <span class="contenttitle_blue">Prizes:</span> $20 for the winner and $10 for the 2nd winner of each group <br />
       <span class="contenttitle_blue">No Entry Fee</span><br />
       <span class="contenttitle_blue">Game Rules:</span> <br />
       		<div id="leftmargin_40">
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;No Ad-in (No deuce)<br />
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;5 games 1 set<br />
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;If the number of players in each group is<br />
            <div id="leftmargin_40">
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;3 - 5: league style (each player will play against each other)<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;6 - 8: divide into 2 groups and the winner of each group will play to be the winner<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;9 or more: tournament style
            </div>
            </div>
        <span class="contenttitle_blue">Game Result:</span> <br />
        	<div id="leftmargin_40">
            Winners of each group: Henry Kim (A), Kihwan Nam (B), Minsoo Kim (C)
            </div>
		</div>
       </p>
-->

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