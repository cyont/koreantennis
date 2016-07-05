<?php 
$page_title = "Game Rules"; 
$file_name = "game_rules_A.php";
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
       <h3>Game Rules</h3>
	   <p>
       <div id="giveleftpadding">
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;Standard official tennis game rules<br />
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;6 games 1 set<br />
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;7 point tie-break for the 6-6 game<br />
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;If the number of players in each group is<br />
            <div id="leftmargin_40">
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;<span class="contenttitle_blue">3 - 5:</span> league style (each player will play against each other)<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;<span class="contenttitle_blue">6, 8 and 10:</span> divide into 2 groups and the winner of each group will play to be the winner<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;<span class="contenttitle_blue">7:</span> divide into 2 groups (4 & 3) and the winner of each group will play to be the winner<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;<span class="contenttitle_blue">9:</span> divide into 2 groups (5 & 4) and the winner of each group will play to be the winner<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;<span class="contenttitle_blue">11:</span> divide into 3 groups (4 & 4 & 3) and the winner of each group will play against each other<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;<span class="contenttitle_blue">12 and more:</span> divide into 4 groups and the 4 winners will play in tournament style<br />
            </div>
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;If there is more than one person with the same wins and losses<br />
            <div id="leftmargin_40">
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;For example, all 3 players are (1 win/1 loss) in 3 player matches, or 2 players are (2 win/1 loss) in 4 player matches<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;Then calculate the (score difference x 10) of each game and the person with more points wins.<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;For example, if the game score is 6 to 4, 20 points will be added to the winner for the game.<br />
            </div>
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;If a player withdraws from a match<br />
            <div id="leftmargin_40">
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;If a player withdraws in the middle of the match, the score difference will be calcurated as it is.  For example, if a match ends with 3 to 1 scores, 20 points will be added to the winner.<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;If a player withdraws before starting the match, 30 points will be added to the winner.<br />
            </div>
       </div>

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