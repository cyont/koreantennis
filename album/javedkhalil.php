<?php
/**
 * show_image.php
 *
 * Example utility file for dynamically displaying images
 *
 * @author      Ian Selby
 * @version     1.0 (php 4 version)
 */


include_once('thumbnail.inc.php');
$thumb = new Thumbnail($_GET['filename']);
// $thumb->cropFromCenter(850);
// $thumb->resize($_GET['width'],$_GET['height']);
// $thumb->resizePercent(100);
// $thumb->createReflection(40,40,80,true,'#a4a4a4');
$thumb->quality = 100;
$thumb->show();
$thumb->destruct();
exit;
?>