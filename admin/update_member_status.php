<?php require_once('../Connections/connTennis.php'); ?>
<?php
$member_status = $_GET["active"];
$member_id = $_GET["id"];
// update member status.
mysql_select_db($database_connTennis, $connTennis);
if ($member_status == 1) {
	$updateStatus = "UPDATE members SET active_member = 0 WHERE Id = " . $member_id . "";
	$updateGroupStatus = "UPDATE groups SET inactive = 1 WHERE id = " . $member_id . "";
	$Result2 = mysql_query($updateGroupStatus, $connTennis) or die(mysql_error());
} else {
	$updateStatus = "UPDATE members SET active_member = 1 WHERE Id = " . $member_id . "";
}
$Result1 = mysql_query($updateStatus, $connTennis) or die(mysql_error());

// Redirect after updating.
$page_redirect = "memberslist.php#id_" . $member_id;
header(sprintf("Location: %s", $page_redirect));
?>
