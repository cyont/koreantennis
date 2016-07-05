<?php 
$page_title = "Tucson Korean Tennis Association Ranking System"; 
$file_name = "ranking_system.php";
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
       <h3>Tucson Korean Tennis Association Ranking System</h3>
       <p>
       <div class="subtitle_black">Introducing the Ranking System</div>
       The purpose of introducing the ranking system is to improve tennis skils and to find more opportunities to interact with other members.  We believe playing singles is as much important as playing doubles and playing real games under competitive pressure will be a good practice.  Since all official single matches will be stored in the database and you can easily track your game history with the ranking system, we hope this will be an effective motivation to exert more efforts to improve your tennis skills
</p>
       <p>
       <div class="subtitle_black">How Does It Work?</div>
       So this is how to use the Ranking System.  It's quite simple.  Play singles, record it and check it!
       <ul>
       	<li class="contenttitle_green">Play Singles</li>
           <ul>
           <li>On the first Monday and Friday of each month, play singles with people who belong to the same group as yours. </li>
           <li>Games can be played at any court and any time when the two players agree to play for an official ranking match.</li>
           <li>The rules of the game such as how many games for a set are totally dependent on the agreement between the two players.</li>
           <li>Check <a href="member_list.php">Member List</a> to see who belong to the same group.</li>
           </ul>
		<li class="contenttitle_green">Record It</li>
        	<ul>
            <li>Every official ranking match must be reported to the game recorder.</li>
            <li>If the recorder is not around or if you have played the game at different location, just email the result to <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>.</li>
            </ul>
        <li class="contenttitle_green">Check It - Check the website for</li>
        	<ul>
            <li><a href="rankings.php">Ranking List</a> - a list by the ranking order with records of wins, losses, winning percentage and points.</li>
            <li><a href="games.php">Game List</a> - a list of game results with player names and scores</li>
            <li><a href="ranking_system_rules.php">Ranking System Rules</a> - detailed rules of the system</li>
            </ul>
       </ul>           
       </p>
       <p>
       <div class="subtitle_orange">Playing for the Ranking System is only optional!</div>
       <span class="text_red">This is very important!  You don't have to play for the Ranking System if you don't want.</span>  <br />You can still come and play as usual whether it's singles or doubles ignoring the Rankng System.  <br />We just want you to enjoy playing tennis.      
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