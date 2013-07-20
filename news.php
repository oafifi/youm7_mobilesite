<?php
require_once 'core/dataaccess.php';
header ( "content-type: text/html; charset=utf-8" );

$newsId = $_GET['NewsID'];

if($newsId){
	$dao = DaoFactory::getDao ( DaoFactory::NEWS_SERVICE_DAO );
	$news = $dao->getNewsContent ( $newsId );
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="Stylesheets/news.css">
<script type="text/javascript" src="Scripts/header.js"></script>
<title><?php echo $news->getTitle()?></title>
</head>
<body>
	<div id="global_container">
		<div id="white_background">
			<?php include "header.php"; ?>
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
								<div id="story_reporter"><img width="11px" height="11px" alt="reporter" src="Images/writer.png">
								</div>
								<div id="story_date">
									<?php echo $news->getDate()?><img width="11px" height="11px" alt="date" src="Images/time.png">
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
			</div>
		</div>
	</div>
</body>
</html>