<?php
require_once 'core/dataaccess.php';
header ( "content-type: text/html; charset=utf-8" );

$secId = $_GET['NewsID'];

if($secId){
	$dao = DaoFactory::getDao ( DaoFactory::NEWS_SERVICE_DAO );
	$news = $dao->getNewsContent ( $secId );
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="Stylesheets/article.css">
<script type="text/javascript" src="Scripts/header.js"></script>
<title><?php echo $news->getTitle()?></title>
</head>
<body>
	<div id="global_container">
		<?php include "header.html"; ?>
		<div id="container">
			<div id="content">
				<div id="story">
					<div id="story_main_image_wrapper">
						<div id="story_main_image">
							<img width="100%" height="56.25%" alt="Story Main Image" src=<?php echo $news->getMainImage()?>>
						</div>
					</div>
					<div id="story_body">
						<div id="story_title">
							<h3><?php echo $news->getTitle()?></h3>
						</div>
						<div id="story_info">
							<div id="story_reporter">
							</div>
							<div id="story_date">
								<?php echo $news->getDate()?>
							</div>
							<div class="clearfix"></div>
							<hr>
						</div>
						<div id="story_text">
							<?php echo $news->getBody()?>
						</div>
					</div>
				</div>
			</div>
			<div id="footer">
			</div>
		</div>
	</div>
</body>
</html>