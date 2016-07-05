<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EW_MENUBAR_SUBMENU_CLASSNAME", "", TRUE);
?>
<?php

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(1, $Language->MenuPhrase("1", "MenuText"), "adminlist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(2, $Language->MenuPhrase("2", "MenuText"), "announcementlist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "commentslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(4, $Language->MenuPhrase("4", "MenuText"), "courtslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(5, $Language->MenuPhrase("5", "MenuText"), "gameslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(6, $Language->MenuPhrase("6", "MenuText"), "groupslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(7, $Language->MenuPhrase("7", "MenuText"), "memberslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(8, $Language->MenuPhrase("8", "MenuText"), "picslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(9, "Email List - All", "email_list.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(11, "Email List - A", "email_list_a.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(12, "Email List - B", "email_list_b.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(13, "Email List - C", "email_list_c.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(14, "Email List - Canceled", "email_list_canceled.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(15, "Email List - Students", "email_list_students.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(16, "Member List", "member_list.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(17, "Member List Names", "member_list_names.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(10, "Tennis Home", "../eng/index.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
