<?php
require_once 'Core/dataaccess.php';
require_once 'Core/utility.php';
header ( "content-type: text/html; charset=utf-8" );

$dao = DaoFactory::getDao ( DaoFactory::NEWS_SERVICE_DAO );

$newsURL = './news.php?';

function echoHomeSection($secId,$float){
	
	global $newsURL;
	global $dao;
	
	$secName = Utility::getSecName($secId);
	$newsList = $dao->getSectionNews( $secId );
	
	
	echo "<div class=\"home_section $float\" >";
	echo "<div class=\"home_section_title\" >
	$secName
	</div>";
	
	$item = $newsList[0];
	$title = $item->getTitle();
	$link = $newsURL.'NewsID='.$item->getId();
	$img = $item->getMainImage();
	
	echo "<div class=\"home_section_main\" >";
	echo "<div class=\"sec_img\"><img alt=$title src=$img></div>";
	echo "<div class=\"sec_title\"><a href= $link >$title</a></div>
		  </div>";
		  		
	$item = $newsList[1];
	$title = $item->getTitle();
	$link = $newsURL.'NewsID='.$item->getId();
	
	echo  "<div class=\"home_section_item\">
		  <div class=\"sec_title\"><a href=$link >$title</a></div>
			</div>
			</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="Stylesheets/template.css">
<link rel="stylesheet" href="Stylesheets/home.css">
<script type="text/javascript" src="Scripts/header.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="Scripts/responsiveslides.min.js"></script>
<link rel="stylesheet" href="Stylesheets/responsiveslides.css">
<link rel="stylesheet" href="Stylesheets/slider.css">
 <script>
  $(function() {
    $("#top_slider").responsiveSlides({
        manualControls: '#top_slider_pager',
      });
  });
</script>
 
<title>اليوم السابع: الرئيسية</title>
</head>
<body>
	<div id="global_container">
		<?php include "header.php"; ?>
		<div id="white_background">
			<div id="container">
				<div id="content">
					<?php $newsList = $dao->getTopNews();?>
					<div id="top_wrapper">
						<ul class="rslides" id="top_slider">
							<?php for($i=0; $i<4; $i++){
								$item=$newsList[$i];
							?>
  							<li>
  								<a href=<?php echo $newsURL.'NewsID='.$item->getId();?>>
  									<img src=<?php echo $item->getMainImage();?> alt=<?php echo $item->getTitle();?>>
  									<div class="caption"><?php echo $item->getTitle();?></div>
  								</a>
  							</li>
  							<?php }?>
					</div>
						<ul id="top_slider_pager">
  							<li><a href="#"><div></div></a></li>
  							<li><a href="#"><div></div></a></li>
 							<li><a href="#"><div></div></a></li>
 							<li><a href="#"><div></div></a></li>
						</ul>
					<div id="mogaz_wrapper">
					</div>
					<div id="home_sections">
						<?php echoHomeSection(65, 'float_right')?>
						<?php echoHomeSection(319, 'float_left')?>
						<?php echoHomeSection(97, 'float_right')?>
						<?php echoHomeSection(203, 'float_left')?>
						<?php echoHomeSection(296, 'float_right')?>
						<?php echoHomeSection(88, 'float_left')?>
						<?php echoHomeSection(24, 'float_right')?>
						<?php echoHomeSection(297, 'float_left')?>
						<?php echoHomeSection(286, 'float_right')?>
						<?php echoHomeSection(298, 'float_left')?>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>