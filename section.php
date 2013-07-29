<?php
require_once 'Core/dataaccess.php';
require_once 'Core/datastructures.php';
require_once 'Core/utility.php';

header ( "content-type: text/html; charset=utf-8" );

$newsURL = './news.php?';

$secId = $_GET['SecID'];
//$secId = 190;

$secName = Utility::getSecName($secId);

if($secId){
	$dao = DaoFactory::getDao ( DaoFactory::NEWS_SERVICE_DAO );
	$newsList = $dao->getSectionNews( $secId );
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="Stylesheets/template.css">
<link rel="stylesheet" href="Stylesheets/section.css">
<script type="text/javascript" src="Scripts/header.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="Scripts/jquery.dotdotdot.min.js"></script>
<script type="text/javascript" language="javascript" src="Scripts/ellipsis.js"></script>

<title><?php echo $secName;?></title>
</head>
<body>
	<div id="global_container">
		<?php include "header.php"; ?>
		<div id="white_background">
			<div id="container">
				<div id="content">
					<div class="title" id="section_title"><?php echo $secName;?></div>
					<?php $item = $newsList[0];?>
					<div class="section_top">
						<div class="section_top_image">
							<img src=<?php echo $item->getMainImage();?> alt="صورة أرشيفية">
						</div>
						<div class="section_top_title title ellipsis"><a href=<?php echo $newsURL.'NewsID='.$item->getId();?>><?php echo $item->getTitle();?></a></div>
						<div class="clearfix"></div>
						<div class="section_top_abstract ellipsis"><?php echo $item->getNewsAbstract();?></div>
					</div>
					<?php for($i=1; $i<count($newsList); $i++){
						$item=$newsList[$i];
					?>
					<div class="section_block">
						<div class="section_block_image">
							<img
								width="85px"
								height="65px"
								src=<?php echo $item->getMainImage();?>
								alt="صورة أرشيفية">
						</div>
						<div class="section_block_info">
							<div class="section_block_title title ellipsis"><a href=<?php echo $newsURL.'NewsID='.$item->getId();?>><?php echo $item->getTitle();?></a></div>
							<div class="section_block_date">
								<img width="10px" height="10px" alt="date icon"
									src="Images/sec-date.png"><?php echo $item->getDate();?>
							</div>
						</div>
						<div class="clearfix"></div>
					<div class="section_block_abstract ellipsis"><?php echo $item->getNewsAbstract();?></div>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>