<?php if (!defined('WEBPATH')) die(); 
header('Last-Modified: ' . gmdate('D, d M Y H:i:s').' GMT');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo gettext("News"); ?> <?php echo getBareNewsTitle(""); ?><?php printCurrentNewsCategory(" | "); printCurrentNewsArchive(); ?> | <?php echo getBareGalleryTitle(); ?></title>
	<meta http-equiv="content-type" content="text/html; charset=<?php echo getOption('charset'); ?>" />
	<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/style.css" type="text/css" />
	<?php printZenpageRSSHeaderLink("News","", "Zenpage news", ""); ?>
	<?php zenJavascript(); ?>
	<?php printZDRoundedCornerJS(); ?>
</head>

<body>

<div id="main">

	<?php include("header.php"); ?>
				
<div id="content">

	<div id="breadcrumb">
	<h2>
    <?php if (is_NewsArticle()) { ?>
    <a href="<?php echo getGalleryIndexURL(false); ?>"><?php echo gettext("Index"); ?></a> <?php printNewsIndexURL("News"," &raquo; "); ?><strong><?php printCurrentNewsCategory(" &raquo; Category - "); ?><?php printNewsTitle(" &raquo; "); printCurrentNewsArchive(" &raquo; "); ?></strong>
    <? } else { ?>
    <a href="<?php echo getGalleryIndexURL(false); ?>"><?php echo gettext("Index"); ?></a> &raquo; <strong><?php echo gettext("News"); ?></strong>
    <? } ?>
	</h2>
	</div>
	
<div id="content-left">

<?php printNewsPageListWithNav(gettext('next &raquo;'), gettext('&laquo; prev')); ?>
<?php 
// single news article
if(is_NewsArticle()) { 
	?>  
    
  <?php if(getPrevNewsURL()) { ?><div class="singlenews_prev"><?php printPrevNewsLink(); ?></div><?php } ?>
  <?php if(getNextNewsURL()) { ?><div class="singlenews_next"><?php printNextNewsLink(); ?></div><?php } ?>
  <?php if(getPrevNewsURL() OR getNextNewsURL()) { ?><br style="clear:both" /><?php } ?>
  <div class="newsarticlewrapper" style="margin-top: 1em; padding-bottom:0.4em;"><div class="newsarticle"> 
  <h3 style="color: #82996F;"><?php printNewsTitle(); ?></h3> 
  <div class="newsarticlecredit"><span class="newsarticlecredit-left"><?php printNewsDate();?> | <?php echo gettext("Comments:"); ?> <?php echo getCommentCount(); ?> | </span> <?php printNewsCategories(", ",gettext("Categories: "),"newscategories"); ?></div>
  <?php printNewsContent(); ?>
  </div></div>
  <?php printTags('links', gettext('<strong>Tags:</strong>').' ', 'taglist', ', '); ?>
  <br style="clear:both;" /><br />
  <?php if (function_exists('printRating')) { printRating(); } ?>
<?php 
// COMMENTS TEST
if (function_exists('printCommentForm')) { ?>
	<div id="comments">
		<?php printCommentForm(); ?>
	</div>
	<?php  } // comments allowed - end
} else {
/*echo "<hr />";	*/
// news article loop
echo '<div class="newsarticlewrapper">';
$u = 0;
  while (next_news()): ;
  if ( $u > 0 ) echo '<p class="newsseparator"/>';
  $u++;
  ?>
 <div class="newsarticle"> 
    <h3><?php printNewsTitleLink(); ?></h3>
        <div class="newsarticlecredit"><span class="newsarticlecredit-left"><?php printNewsDate();?> | <?php echo gettext("Comments:"); ?> <?php echo getCommentCount(); ?></span>
<?php
if(is_GalleryNewsType()) {
	if(!is_NewsType("album")) {
		echo " | ".gettext("Album:")."<a href='".getNewsAlbumURL()."' title='".getBareNewsAlbumTitle()."'> ".getNewsAlbumTitle()."</a>";
	} else {
		echo "<br />";
	}
} else {
	echo ' | '; printNewsCategories(", ",gettext("Categories: "),"newscategories");
}
?>
</div>
    <?php printNewsContent(); ?>
    <p><?php printNewsReadMoreLink(); ?></p>
    <?php printCodeblock(1); ?>
    <?php printTags('links', gettext('<strong>Tags:</strong>').' ', 'taglist', ', '); ?>
    <br style="clear:both;" /><br />
    </div>	
    
<?php
  endwhile; 
  echo "</div><br/><hr/>";
  printNewsPageListWithNav(gettext('next &raquo;'), gettext('&laquo; prev'));
} ?> 


</div><!-- content left-->
		
		
	<div id="sidebar">
		<?php include("sidebar.php"); ?>
	</div><!-- sidebar -->


	<div id="footer">
	<?php include("footer.php"); ?>
	</div>

</div><!-- content -->

</div><!-- main -->
<?php printAdminToolbox(); ?>
</body>
</html>
