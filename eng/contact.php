<?php 
$page_title = "Contact Us - Tucson Korean Tennis Association"; 
$file_name = "contact.php";

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $form_subject = $_POST['subject'];
  $message = $_POST['message'];
  $form_time = date("n/j/Y") . ", " . date("g:i A");

// Send confirmation email.
	$mailto =  "contact@koreantennis.org";
    $subject =  "Tucson Korean Tennis: Contact US";
    $mailbody =  "New message on Tucson Korean Tennis: Contact US. \n\n";
    $mailbody .=  "Name: $name\n";
    $mailbody .=  "Email: $email\n";
	$mailbody .=  "Subject: $form_subject\n";
	$mailbody .=  "Message:\n $message\n";
	$mailbody .=  "Time: $form_time\n";
    mail($mailto, $subject, $mailbody);

// Redirect after submission.
  $insertGoTo = "contact.php?submit=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html40/strict.dtd">
<html>
<head>
<?php include('header.php'); ?>
<script type="text/JavaScript">
function checkForm() {
	var subject = document.form.subject.value;
	var message = document.form.message.value;
	
    if (subject == "") {
    alert("Please enter 'Subject' and re-Submit.");
	document.form.subject.focus();
    return false;
	} 
    if (message == "") {
    alert("Please enter 'Message' and re-Submit.");
	document.form.message.focus();
    return false;
	} 
	return true;
}
</script>
</head>
<body id="main_body" onLoad="document.form.name.focus();">
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
       <h3>Contact Us</h3>
	   <p>
        <?php if ((isset($_GET['submit'])) && ($_GET['submit'] == 1)) { ?>
        <span class="text_red">Thank you!  Your message has been submitted successfully. </span>
        <?php } ?>
	   </p>
       <p>Use this form to send us your questions, comments, or suggestions.  <br />You can also send email us at <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a> if you prefer.</p>
       <p>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form" onSubmit="return checkForm();">
<table width="95%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td width="20%">Name</td>
    <td width="80%"><input name="name" type="text" size="60" /></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input name="email" type="text" size="60" /></td>
  </tr>
  <tr>
    <td>Subject <span class="contentsubtitle_red">*</span></td>
    <td><input name="subject" type="text" size="80" /></td>
  </tr>
  <tr>
    <td valign="top">Message <span class="contentsubtitle_red">*</span></td>
    <td><textarea name="message" cols="80" rows="8"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
        <input type="submit" name="button" id="button" value="Submit" />
    </td>
  </tr>
</table>
<input type="hidden" name="MM_insert" value="form" />
</form>
       
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