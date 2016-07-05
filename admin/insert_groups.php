<?php require_once('../Connections/connTennis.php'); ?>


<?php
// initialize the session
if (!isset($_SESSION)) {
   session_start();
}

// Here goes the query to add extra records.
// Update Person 1 for the Win
mysql_select_db($database_connTennis, $connTennis);
$query_rsPerson1 = "SELECT total_wins, current_wins, points FROM groups WHERE Id = " . $_SESSION['person1'] . " ";
$rsPerson1 = mysql_query($query_rsPerson1, $connTennis) or die(mysql_error());
$row_rsPerson1 = mysql_fetch_assoc($rsPerson1);
$person1_total_wins = $row_rsPerson1['total_wins'] + 1;
$person1_current_wins = $row_rsPerson1['current_wins'] + 1;
$person1_points = $row_rsPerson1['points'] + $_SESSION['points'];
$updateSQL = "UPDATE groups SET total_wins = " . $person1_total_wins . ", current_wins = " . $person1_current_wins . ", points = " . $person1_points . " WHERE Id = " . $_SESSION['person1'] . " ";
$Result = mysql_query($updateSQL, $connTennis) or die(mysql_error());

// Update Person 2 for the Loss
$query_rsPerson2 = "SELECT total_losses, current_losses, points FROM groups WHERE Id = " . $_SESSION['person2'] . " ";
$rsPerson2 = mysql_query($query_rsPerson2, $connTennis) or die(mysql_error());
$row_rsPerson2 = mysql_fetch_assoc($rsPerson2);
$person2_total_losses = $row_rsPerson2['total_losses'] + 1;
$person2_current_losses = $row_rsPerson2['current_losses'] + 1;
$person2_points = $row_rsPerson2['points'] - $_SESSION['points'];
$updateSQL = "UPDATE groups SET total_losses = " . $person2_total_losses . ", current_losses = " . $person2_current_losses . ", points = " . $person2_points . " WHERE Id = " . $_SESSION['person2'] . " ";
$Result = mysql_query($updateSQL, $connTennis) or die(mysql_error());

?>
<?php
mysql_free_result($rsPerson1);
mysql_free_result($rsPerson2);
?>
<?php
header('Location: temp2.htm' ) ;
?>
