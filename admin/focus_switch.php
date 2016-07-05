<?php
// Instead of this, just  use a parameter.
// $string_name =   $_SERVER[URL];
// $page_name = str_replace("/admin/","",$string_name);

if (isset($page_name)) {
	switch ($page_name) {
		case "login.php":
			$form_name = "form";
			$focus_item = "username";
			break;
		case "membersadd.php":
			$form_name = "fmembersadd";
			$focus_item = "x_first_name";
			break;
	}
}
?> 