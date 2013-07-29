<?php
require_once 'Core/dataaccess.php';
require_once 'Core/utility.php';
require_once 'Cache/Output.php';

header ( "content-type: text/html; charset=utf-8" );

error_reporting(0);

$cache = new Cache_Output("file", array("cache_dir" => "cache/") );

$dao = DaoFactory::getDao ( DaoFactory::NEWS_SERVICE_DAO );

$homeSecIdList = array(65,319,97,203,296,88,24,297,286,298);	//home sections to be viewed on home page

$newsURL = './news.php?';

function echoHomeSections(){
	global $dao;
	global $homeSecIdList;
	
	$secCount=count($homeSecIdList);
	
	$homeSectionsList=$dao->getSections($homeSecIdList);
	
	for($i=0; $i<$secCount; $i++){
		if($i%2){
			echoHomeSection($homeSecIdList[$i], $homeSectionsList[$i], 'float_left');
		}
		else{
			echoHomeSection($homeSecIdList[$i], $homeSectionsList[$i], 'float_right');
		}
	}
}
function echoHomeSection($secId,$newsList,$float){
	
	global $newsURL;
	
	$secName = Utility::getSecName($secId);


	echo "<div class=\"home_section $float\" >";
	echo "<div class=\"home_section_title title\" >
	$secName
	</div>";
	
	$item = $newsList[0];
	$title = $item->getTitle();
	$link = $newsURL.'NewsID='.$item->getId();
	$img = $item->getMainImage();
	
	echo "<div class=\"home_section_main\" >";
	echo "<div class=\"sec_img\"><img alt=$title src=$img></div>";
	echo "<div class=\"sec_title title ellipsis\"><a href= $link >$title</a></div>
		  </div>";
		  		
	$item = $newsList[1];
	$title = $item->getTitle();
	$link = $newsURL.'NewsID='.$item->getId();
	
	echo  "<div class=\"home_section_item\">
		  <div class=\"sec_title title ellipsis\"><a href=$link >$title</a></div>
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

<script type="text/javascript" language="javascript" src="Scripts/jquery.dotdotdot.min.js"></script>
<script type="text/javascript" language="javascript" src="Scripts/ellipsis.js"></script>

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
					<?php 
						$newsList = $dao->getTopNews();
						$newsCount = count($newsList);
					?>
					<div id="top_wrapper">
						<ul class="rslides" id="top_slider">
							<?php for($i=0; $i<$newsCount; $i++){
								$item=$newsList[$i];
							?>
  							<li>
  								<a href=<?php echo $newsURL.'NewsID='.$item->getId();?>>
  									<img src=<?php echo $item->getMainImage();?> alt=<?php echo $item->getTitle();?>>
  									<div class="caption title ellipsis"><?php echo $item->getTitle();?></div>
  								</a>
  							</li>
  							<?php }?>
					</div>
						<ul id="top_slider_pager">
							<?php for($i=0; $i<$newsCount; $i++){?>
  								<li><a href="#"><div></div></a></li>
  							<?php }?>
						</ul>
					<div id="mogaz_wrapper">
					</div>
					<div id="home_sections">
						<?php 
							if ($contents = $cache->start(md5("youm7 mobile site home"))) {
								echo($contents);
							} else {
								
									echoHomeSections();

								echo $cache->end(60);
							}
						?>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>