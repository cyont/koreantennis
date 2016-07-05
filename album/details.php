<?php include("db/db.php"); ?>
<?php
$idg=$_REQUEST["action"];
?>
<?php
$sqlg="select * from pics WHERE id='$idg'";
if(mysql_query($sqlg))
{
$checkg=mysql_query($sqlg);
$nog=mysql_num_rows($checkg);
}
?>


<?php
// for min
$sqlmin="select * from pics ORDER by id asc";
if(mysql_query($sqlmin))
{
$checkmin=mysql_query($sqlmin);
$nomin=mysql_num_rows($checkmin);
}
?>
<?php
// for max
$sqlmax="select * from pics ORDER by id desc";
if(mysql_query($sqlmax))
{
$checkmax=mysql_query($sqlmax);
$nomax=mysql_num_rows($checkmax);
}
?>
<?php
// for next
$sqlnext="select * from pics WHERE id>'$idg' ORDER by id asc";
if(mysql_query($sqlnext))
{
$checknext=mysql_query($sqlnext);
$nonext=mysql_num_rows($checknext);
}
?>
<?php
// for previous
$sqlback="select * from pics WHERE id<'$idg' ORDER by id desc";
if(mysql_query($sqlback))
{
$checkback=mysql_query($sqlback);
$noback=mysql_num_rows($checkback);
}
?>
<?php
// Add a random function to block the annoying spammer.
$num_1 = rand(0, 50);
$num_2 = rand(0, 50);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Tucson Korean Tennis Photo Album</title>
<meta name="keywords" content="Tucson Korean Tennis Association Photo Album">
<meta name="keyphrases" content="Tucson Korean Tennis Association Photo Album">
<meta name="subject" CONTENT="Tucson Korean Tennis Association Photo Album">
<meta name="topic" content="Tucson Korean Tennis Association Photo Album">
<meta name="summary" CONTENT="Tucson Korean Tennis Association Photo Album">

<script type="text/javascript" language="javascript" src="scripts/status.js"></script>
<script type="text/javascript" language="javascript" src="scripts/d.js"></script>
<script type="text/JavaScript">
function checkForm() {
	var name = document.frm_comment.name.value;
	var comment = document.frm_comment.comments.value;
	var num_total = document.frm_comment.num_total.value;
	var num_1 = document.frm_comment.num_1.value;
	var num_2 = document.frm_comment.num_2.value;
	var num_3 = parseInt(num_1) + parseInt(num_2);
	
    if (name == "") {
    alert("Please enter 'Name' and re-Submit.");
	document.frm_comment.name.focus();
    return false;
	} 
    if (comment == "") {
    alert("Please enter 'Comment' and re-Submit.");
	document.frm_comment.comments.focus();
    return false;
	} 
    if (num_total != num_3) {
    alert("Please add the two numbers correctly.");
	document.frm_comment.num_total.focus();
    return false;
	} 
	return true;
}
</script>
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="44" align="center" valign="middle" class="headerbg"><h2><a href="index.php">Photo Album</a></h2></td>
      </tr>
    </table>
      <table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="left"><span class="color2">Views:
            <?php
// add pic hits
$sqlh="select * from pics WHERE id='$idg'";
if(mysql_query($sqlh))
{
$checkh=mysql_query($sqlh);
$noh=mysql_num_rows($checkh);
}

$counter=mysql_result($checkh,0,"hits");
$addcounter=$counter+1;
$sql1add="update pics set hits='$addcounter' WHERE id='$idg'";
$result1=mysql_query($sql1add);

$sql="select * from pics WHERE id='$idg'";
if(mysql_query($sql))
{
$check=mysql_query($sql);
$no=mysql_num_rows($check);
}
?>
            <span class="color3"><?php print mysql_result($check,0,"hits"); ?></span></span></td>
      </tr>
      <!--
      <tr>
        <td align="center"><span class="color2">Caption:</span> <?php print mysql_result($checkg,0,"caption"); ?></td>
      </tr>
      -->
      <tr>
        <td>&nbsp;</td>
      </tr>

	  <tr>
<td align="center">
<a href="details.php?action=<?php
if($nonext=='0')
{
print mysql_result($checkmin,0,"id");
}
else
{
print mysql_result($checknext,0,"id");
}
?>">
<img src="photos/<?php print mysql_result($checkg,0,"img"); ?>" border="0" width="<?php print mysql_result($checkg,0,"width_big"); ?>" height="<?php print mysql_result($checkg,0,"height_big"); ?>" class="imgst" alt="<?php print mysql_result($checkg,0,"caption"); ?>" title="<?php print mysql_result($checkg,0,"caption"); ?>"></a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">
        <span class="color2"></span> <?php print mysql_result($checkg,0,"caption"); ?> (<?php echo date('n/j/Y', strtotime(mysql_result($checkg,0,"date_uploaded"))); ?>)</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
<td align="center"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="brdboth">
    
    <!--Thumb navigation-->
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
      
      
        
        
        <td width="100" align="right" valign="middle">
        <a href="details.php?action=<?php
if($nonext=='0')
{
print mysql_result($checkmin,0,"id");
}
else
{
print mysql_result($checknext,0,"id");
}
?>">
          <?php
if($nonext=='0')
{
?>
          <img src="javed2.php?filename=photos/<?php print mysql_result($checkmin,0,"img"); ?>&width=80&height=80" border="0" class="imgst">
          <?php
}
else
{
?>
          <img src="javed2.php?filename=photos/<?php print mysql_result($checknext,0,"img"); ?>&width=80&height=80" border="0" class="imgst">
          <?php
}
?>
        </a> 
        </td>
        
        <td align="center" class="controls">
       
<!--Navigation Next starts here.-->
<a href="details.php?action=<?php
if($nonext=='0')
{
print mysql_result($checkmin,0,"id");
}
else
{
print mysql_result($checknext,0,"id");
}
?>">Previous</a> | 

<!--Navigation Thumb Home-->
<a href="index.php">Album Home</a> | 

<a href="details.php?action=<?php
if($noback=='0')
{
print mysql_result($checkmax,0,"id");
}
else
{
print mysql_result($checkback,0,"id");
}
?>">Next</a> 
          </td>
          
          
        <!--Navigation Privious starts here.-->
        <td width="100" align="left" valign="middle"><a href="details.php?action=<?php
if($noback=='0')
{
print mysql_result($checkmax,0,"id");
}
else
{
print mysql_result($checkback,0,"id");
}
?>">
          <?php
if($noback=='0')
{
?>
          <img src="javed2.php?filename=photos/<?php print mysql_result($checkmax,0,"img"); ?>&width=80&height=80" border="0" class="imgst">
          <?php
}
else
{
?>
          <img src="javed2.php?filename=photos/<?php print mysql_result($checkback,0,"img"); ?>&width=80&height=80" border="0" class="imgst">
          <?php
}
?>
        </a> 
        </td>
                
      </tr>
    </table>
    <!--Thumb navigation ends-->
    
    </td>
  </tr>
</table></td>
      </tr>
      <tr>
        <td align="center" class="controls">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;		</td>
      </tr>

<!--  Shutting down comments because of spams
	  <tr>
        <form action="saveComment.php" method="post" name="frm_comment" id="frm_comment" onSubmit="return checkForm();">
		<td align="center"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" class="brd3"><table width="600" border="0" cellspacing="1" cellpadding="4">
                <tr>
                  <td width="120" align="left" class="color1">Leave a comment</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="right">Name:</td>
                  <td>
                    <input name="name" type="text" class="frmtxt" id="name" size="40"> <span class="color3">*</span> 
                  </td>
                </tr>
                <tr>
                  <td width="120" align="right" valign="top">Comment:</td>
                  <td><textarea name="comments" cols="59" rows="5" class="frmtxt" id="comments"></textarea> <span class="color3">*</span></td>
                </tr>
                <tr>
                  <td align="right"><?php print($num_1); ?>  +  <?php print($num_2); ?> = </td>
                  <td>
                    <input name="num_1" type="hidden" value="<?php print($num_1); ?>">
                    <input name="num_2" type="hidden" value="<?php print($num_2); ?>">
                    <input name="num_total" type="text" size="5"> <span class="color3">*</span> Please enter the number to block spammers.
                  </td>
                </tr>

                <tr>
                  <td width="120" align="right">&nbsp;</td>
                  <td><label>
                    <input name="Submit" type="submit" class="btn" value="Submit" onClick="return validateFormd( );">
                    </label></td>
                </tr>
            </table></td>
          </tr>
        </table></td>
		<input name="imgid" type="hidden" value="<?php print mysql_result($checkg,0,"id"); ?>">
		</form>
      </tr>
-->     
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
        <div id="give_indent">
        Comments Posted:
		<?php
        $mid=mysql_result($checkg,0,"id");
        $sqlc="select * from comments WHERE imgid='$mid' AND status='1' order by id desc";
        if(mysql_query($sqlc))
        {
        $checkc=mysql_query($sqlc);
        $noc=mysql_num_rows($checkc);
        }
        ?><span class="color3"><?php echo "$noc"; ?></span>
        </div>
    	</td>
    </tr>
<?php
for($i=0; $i<$noc; $i++)
{
?>
	  <tr>
        <td class="pad2"><table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td class="brd2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left">Name: <span class="wh"><?php print mysql_result($checkc,0+$i,"name"); ?></span></td>
                <td align="right"><span class="color2"><?php print mysql_result($checkc,0+$i,"date"); ?></span></td>
              </tr>
              <tr>
                <td colspan="2">Comment: <br><span class="wh"><?php print mysql_result($checkc,0+$i,"comment"); ?></span></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>

<?php
}
?>




      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">

   
    </table></td>
  </tr>
  <tr>
    <td align="center" valign="bottom"> <tr>
        <td align="center" bgcolor="#1B1B1B" class="footer">
        <h3><a href="index.php"><u>Back to Album Home</u></a> | <a href="../eng/index.php"><u>Back to Korean Tennis Home</u></a></h3>
         </td>
      </tr>
      </td>
  </tr>
</table>
</body>
</html>
