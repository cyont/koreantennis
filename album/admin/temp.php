<?php

// Need a class to create thumbnail.
include_once('thumbnail.php');
	
// Create a new file name for the uploaded file.
	$file_name=$_FILES['file1']['name'];
	$string_length = strlen($file_name);
	$new_string = substr($file_name, $string_length - 6, $string_length);
	$extension = strstr($new_string, '.');
	$extension_length = strlen($extension) - 1;
	$string_base = substr($file_name, 0, $string_length - ($extension_length + 1));
	$filename_new =  $string_base . "_" . date("Gis") . $extension;


	
	if ($filename_new != "")
	{
	$sUploadDir = '../photos/';
	$sUploadedFile = $sUploadDir . $filename_new;

	
	// Upload file(s) on server.
	move_uploaded_file($_FILES['file1']['tmp_name'], $sUploadedFile);


	// Get width and height of the image.
	list($width, $height)=getimagesize($sUploadedFile); 

	// If it's too big, make it smaller.
	if ($width > 8800) {
	$thumb=new thumbnail($sUploadedFile);		
	$thumb->size_width(800);		
	$thumb->size_height(1000);		
	$thumb->size_auto(800);			
	$thumb->jpeg_quality(100);			
	$thumb->save($sUploadedFile);
	}	
	list($width_big, $height_big)=getimagesize($sUploadedFile);
	
	// Create thumbnail.
	$thumb=new thumbnail($sUploadedFile);		
	$thumb->size_width(200);		// set width for thumbnail, or
	$thumb->size_height(300);		// set height for thumbnail, or
	$thumb->size_auto(150);			// set the biggest width or height for thumbnail
	$thumb->jpeg_quality(75);		// [OPTIONAL] set quality for jpeg only (0 - 100) (worst - best), default = 75
	$thumb->save('../photos/thumb/' . $filename_new);
	// $thumb->show();	
	list($width_small, $height_small)=getimagesize('../photos/thumb/' . $filename_new); 
	}

// Insert records in the database.
$sqlup="INSERT INTO pics (caption, descc, img, width_big, height_big, width_small, height_small, hits) values('$cap','$descc','$filename_new', $width_big, $height_big, $width_small, $height_small, 1)";
$update=mysql_query($sqlup);

header("location: managePhotos.php");

//echo "File Uploaded Successfully";
//echo "width: " . $width_big;
//echo "<br />";
//echo "height: " . $height_big;
//echo "<br />";
//echo "type: " . $width_small;
//echo "<br />";
//echo "attr: " . $height_small;



?>		
		