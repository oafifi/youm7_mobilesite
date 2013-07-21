<?php
require_once 'core/dataaccess.php';
require_once 'Core/datastructures.php';
header ( "content-type: text/html; charset=utf-8" );

$newsURL = './news.php?';

$secId = $_GET['SecID'];

$secName = '';

switch ($secId) {
	case 12 :
		$secName = 'تحقيقات وملفات';
		break;
	case 65 :
		$secName = 'أخبار عاجلة';
		break;
	case 319 :
		$secName = 'تسياسة';
		break;
	case 97 :
		$secName = 'تقارير مصرية';
		break;
	case 203 :
		$secName = 'حوادث';
		break;
	case 296 :
		$secName = 'أخبار المحافظات';
		break;
	case 88 :
		$secName = 'أخبار عربية';
		break;
	case 24 :
		$secName = 'اقتصاد';
		break;
	case 297 :
		$secName = 'بورصة و بنوك';
		break;
	case 286 :
		$secName = 'أخبار عالمية';
		break;
	case 298 :
		$secName = 'أخبار الرياضة';
		break;
	case 48 :
		$secName = 'فن و تليفزيون';
		break;
	case 94 :
		$secName = 'ثقافة';
		break;
	case 89 :
		$secName = 'منوعات و مجتمع';
		break;
	case 245 :
		$secName = 'صحة و طب';
		break;
	case 190 :
		$secName = 'مقالات القراء';
		break;
	case 291 :
		$secName = 'ألبومات اليوم السابع';
		break;
	case 87 :
		$secName = 'مقالات';
		break;
	case 96 :
		$secName = 'صحافة محلية';
		break;
	case 99 :
		$secName = 'صحافة عالمية';
		break;
	case 228 :
		$secName = 'صحافة إسرائيلية';
		break;
	case 299 :
		$secName = 'بقلم رئيس التحرير';
		break;
	case 192 :
		$secName = 'كاريكاتير اليوم';
		break;
	case 251 :
		$secName = 'توك شو';
		break;
}

if($secId){
	$dao = DaoFactory::getDao ( DaoFactory::NEWS_SERVICE_DAO );
	$newsList = $dao->getSectionNews( $secId );
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="Stylesheets/section.css">
<script type="text/javascript" src="Scripts/header.js"></script>
<title><?php echo $secName;?></title>
</head>
<body>
	<div id="global_container">
		<div id="white_background">
			<?php include "header.php"; ?>
			<div id="container">
				<div id="content">
					<div id="section_title"><?php echo $secName;?></div>
					<?php $item = $newsList[0];?>
					<div class="section_top">
						<div class="section_top_image">
							<img
								width="170px"
								height="130px"
								src=<?php echo $item->getMainImage();?>
								alt="صورة أرشيفية">
						</div>
						<div class="section_top_content">
							<div class="section_block_title"><a href=<?php echo $newsURL.'NewsID='.$item->getId();?>><?php echo $item->getTitle();?></a></div>
							<div class="section_block_abstract"><?php echo $item->getNewsAbstract();?></div>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php for($i=1; $i<count($newsList); $i++){
						$item=$newsList[$i];
					?>
					<div class="section_block">
						<div class="section_block_head">
							<div class="section_block_image">
								<img
									width="85px"
									height="65px"
									src=<?php echo $item->getMainImage();?>
									alt="صورة أرشيفية">
							</div>
							<div class="section_block_info">
								<div class="section_block_title"><a href=<?php echo $newsURL.'NewsID='.$item->getId();?>><?php echo $item->getTitle();?></a></div>
								<div class="section_block_date">
									<img width="10px" height="10px" alt="date icon"
										src="Images/sec-date.png"><?php echo $item->getDate();?>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="section_block_abstract"><?php echo $item->getNewsAbstract();?></div>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>