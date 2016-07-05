

<ul id="main_nav_list">
   <li><a class="<?php if ($file_name == "index.php") { ?>main_nav_active_item<?php } else { ?>main_nav_item<?php } ?>" href="index.php" id="mnai1" shape="rect">Home</a></li>

<!--Navigation for About Us -->
   <li><a class="<?php if (($file_name == "aboutus.php") || ($file_name == "members.php") || ($file_name == "members_active.php") || ($file_name == "timelocation.php") ) { ?>main_nav_active_item<?php } else { ?>main_nav_item<?php } ?>" href="aboutus.php" id="mni2" shape="rect">About Us</a></li>
	<?php if (($file_name == "aboutus.php") || ($file_name == "members.php") || ($file_name == "members_active.php") || ($file_name == "timelocation.php") ) { ?>
       <div class="sub_nav_container">
       <ul class="sub_nav_list" id="sub_nav_list1">
       <li><a class="<?php if ($file_name == "members.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="members.php" id="sni2" shape="rect">All Members</a></li>
       <li><a class="<?php if ($file_name == "members_active.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="members_active.php" id="sni2" shape="rect">Active Members</a></li>
       <li><a class="<?php if ($file_name == "timelocation.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="timelocation.php" id="sni2" shape="rect">Time & Location</a></li>
       </ul>
       </div>
	<?php } ?>

<?php /*?>
<!--Navigation for Rankings -->
   <li><a class="<?php if (($file_name == "ranking_system.php") || ($file_name == "member_list.php") || ($file_name == "ranking_system_rules.php")) { ?>main_nav_active_item<?php } else { ?>main_nav_item<?php } ?>" href="ranking_system.php" id="sni2" shape="rect">Rankings</a></li>
	<?php if (($file_name == "ranking_system.php") || ($file_name == "member_list.php") || ($file_name == "ranking_system_rules.php") ) { ?>
       <div class="sub_nav_container">
       <ul class="sub_nav_list" id="sub_nav_list1">
       <li><a class="<?php if ($file_name == "member_list.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="member_list.php">Member List</a></li>
        <li><a class="<?php if ($file_name == "ranking_system_rules.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="ranking_system_rules.php">Ranking System Rules</a></li>     
       </ul>
       </div>
	<?php } ?>

<li><a class="<?php if (($file_name == "ranking_system.php") || ($file_name == "member_list.php") || ($file_name == "rankings.php") || ($file_name == "games.php") || ($file_name == "ranking_system_rules.php") || ($file_name == "member_details.php")) { ?>main_nav_active_item<?php } else { ?>main_nav_item<?php } ?>" href="ranking_system.php" id="sni2" shape="rect">Rankings</a></li>
	<?php if (($file_name == "ranking_system.php") || ($file_name == "member_list.php") || ($file_name == "rankings.php") || ($file_name == "games.php") || ($file_name == "ranking_system_rules.php") || ($file_name == "member_details.php") ) { ?>
       <div class="sub_nav_container">
       <ul class="sub_nav_list" id="sub_nav_list1">
       <li><a class="<?php if ($file_name == "member_list.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="member_list.php">Member List</a></li>
       <li><a class="<?php if ($file_name == "rankings.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="rankings.php">Ranking List</a></li>
        <li><a class="<?php if ($file_name == "games.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="games.php">Game List</a></li>
        <li><a class="<?php if ($file_name == "ranking_system_rules.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="ranking_system_rules.php">Ranking System Rules</a></li>     
       </ul>
       </div>
	<?php } ?>
<?php */?>

<!--Navigation for Playing Tennis in Tucson-->
   <li><a class="<?php if (($file_name == "tucson.php") || ($file_name == "courts.php") || ($file_name == "classes.php")) { ?>main_nav_active_item<?php } else { ?>main_nav_item<?php } ?>" href="tucson.php" id="mni2" shape="rect">Playing Tennis in Tucson</a></li>
	<?php if (($file_name == "tucson.php") || ($file_name == "courts.php") || ($file_name == "classes.php")) { ?>
       <div class="sub_nav_container">
       <ul class="sub_nav_list" id="sub_nav_list1">
       <li><a class="<?php if ($file_name == "courts.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="courts.php" id="sni2" shape="rect">Tennis Courts</a></li>
       <li><a class="<?php if ($file_name == "classes.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="classes.php" id="sni2" shape="rect">Tennis Classes
</a></li>
       </ul>
       </div>
	<?php } ?>

<!--Navigation for Tournaments-->
<?php
$latest_tournament = "tournament_2011_fall.php";	// Open the latest tournament available when selected.
$main_nav_class = "main_nav_item";					// By default, the menu is not selected.
  switch ($file_name) {
    case "tournament_2009.php":
      $main_nav_class = "main_nav_active_item";
      break;    
    case "tournament_2010.php":
      $main_nav_class = "main_nav_active_item";
      break;
    case "tournament_2010_fall.php":
      $main_nav_class = "main_nav_active_item";
	  break;
    case "tournament_2011_spring.php":
      $main_nav_class = "main_nav_active_item";
      break;
    case "tournament_2011_fall.php":
      $main_nav_class = "main_nav_active_item";
      break;
  }
?>

   <li><a class="<?php echo $main_nav_class; ?>" href="<?php echo $latest_tournament; ?>">Tennis Tournaments</a></li>
	<?php if (($file_name == "tournament_2009.php") || ($file_name == "tournament_2010.php") || ($file_name == "tournament_2010_fall.php") || ($file_name == "tournament_2011_spring.php") || ($file_name == "tournament_2011_fall.php")) { ?>
       <div class="sub_nav_container">
       <ul class="sub_nav_list" id="sub_nav_list1">
       <li><a class="<?php if ($file_name == "tournament_2011_fall.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="tournament_2011_fall.php">Tournament in 2011 Fall</a></li>
       <li><a class="<?php if ($file_name == "tournament_2011_spring.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="tournament_2011_spring.php">Tournament in 2011 Spring</a></li>
       <li><a class="<?php if ($file_name == "tournament_2010_fall.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="tournament_2010_fall.php">Tournament in 2010 Fall</a></li>
       <li><a class="<?php if ($file_name == "tournament_2010.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="tournament_2010.php">Tournament in 2010 Spring</a></li>
       <li><a class="<?php if ($file_name == "tournament_2009.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="tournament_2009.php">Tournament in 2009</a></li>
       </ul>
       </div>
	<?php } ?>

<!--Navigation for Tennis Ball Machine-->
   <li><a class="<?php if ($file_name == "ballmachine.php") { ?>main_nav_active_item<?php } else { ?>main_nav_item<?php } ?>" href="ballmachine.php" id="mnai1" shape="rect">Tennis Ball Machine</a></li>

   <?php /*?>

<!--Navigation for Pictures-->
   <li><a class="<?php if ($file_name == "pictures.php") { ?>main_nav_active_item<?php } else { ?>main_nav_item<?php } ?>" href="../album/index.php" id="mni2" shape="rect">Pictures</a></li>

   <li><a class="<?php if ($file_name == "forum.php") { ?>main_nav_active_item<?php } else { ?>main_nav_item<?php } ?>" href="../board/index.php" id="mni2" shape="rect" target="_blank">Forum</a></li>
   <?php */?>

<?php /*?>
<!--Navigation for Sponsor-->
   <li><a class="<?php if ($nav_section == "sponsors") { ?>main_nav_active_item<?php } else { ?>main_nav_item<?php } ?>" href="sponsors.php" id="mni2" shape="rect">Sponsors</a></li>
	<?php if ($nav_section == "sponsors") { ?>
       <div class="sub_nav_container">
       <ul class="sub_nav_list" id="sub_nav_list1">
       <li><a class="<?php if ($file_name == "kimpo.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="kimpo.php" id="sni2" shape="rect">Kimpo Oriental Market</a></li>
       <li><a class="<?php if ($file_name == "arizonacommunityphysicians.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="arizonacommunityphysicians.php" id="sni2" shape="rect">AZ Community Physicians</a></li>
       
       <li><a class="<?php if ($file_name == "sushiten.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="sushiten.php" id="sni2" shape="rect">Sushi Ten Restaurant</a></li>
       <li><a class="<?php if ($file_name == "koreahouse.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="koreahouse.php" id="sni2" shape="rect">Korea House Restaurant</a></li>
       <li><a class="<?php if ($file_name == "carspecialist.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="carspecialist.php" id="sni2" shape="rect">Foreign Car Specialists</a></li>
       <li><a class="<?php if ($file_name == "lazexpress.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="lazexpress.php" id="sni2" shape="rect">LAZ Express - Moving</a></li>
       <li><a class="<?php if ($file_name == "heritageshoerepair.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="heritageshoerepair.php" id="sni2" shape="rect">Heritage Shoe Repair</a></li>
       <li><a class="<?php if ($file_name == "realtoryounglee.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="realtoryounglee.php" id="sni2" shape="rect">Realtor Young Lee</a></li>
       <li><a class="<?php if ($file_name == "TVcleaners.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="TVcleaners.php">Tanque Verde Cleaners</a></li>
       <li><a class="<?php if ($file_name == "championauto.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="championauto.php">Champion Auto</a></li>
       <li><a class="<?php if ($file_name == "northpointedental.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="northpointedental.php">North Pointe Dental</a></li>
       <li><a class="<?php if ($file_name == "beautysalon.php") { ?>sub_nav_active_item<?php } else { ?>sub_nav_item<?php } ?>" href="beautysalon.php">Beauty Salon</a></li>
       </ul>
       </div>
	<?php } ?>
<?php */?>

<!--Navigation for Contact Us-->
   <li><a class="<?php if ($file_name == "contact.php") { ?>main_nav_active_item<?php } else { ?>main_nav_item<?php } ?>" href="contact.php" id="mni2" shape="rect">Contact Us</a></li>
</ul>


<!--<a href="http://www.la21c.com" target="_blank"><img src="../images/la21c_logo.png" border="0" /></a><br />-->

<!--<a href="http://www.1and1.com/?k_id=152248715" target="_blank"><img src="http://www.1and1affiliate.com/uploads/pics/US_Green_Logo.jpg?aid=253285" style="border: 0 none;"/></a>-->


<!--
<div id="la21c_logo" >
This site is sponsored by <a href="http://www.la21c.com" target="_blank">LA21C.</a>
</div>
-->


