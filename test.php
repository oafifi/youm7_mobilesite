<?php

require_once 'core/dataaccess.php';

header("content-type: text/html; charset=utf-8");

$dao = DaoFactory::getDao(DaoFactory::NEWS_SERVICE_DAO);

//Testing getNewsContent
/*
$nCon = $dao->getNewsContent(1161123);

echo "Get news content test :"."<br/><br/>";
echo "PubDate:"."&nbsp;&nbsp;&nbsp;&nbsp;".$nCon->getPubDate()."<br/>";
echo "Date:"."&nbsp;&nbsp;&nbsp;&nbsp;".$nCon->getDate()."<br/>";
echo "MainImage:"."&nbsp;&nbsp;&nbsp;&nbsp;".$nCon->getMainImage()."<br/>";
echo "Link:"."&nbsp;&nbsp;&nbsp;&nbsp;".$nCon->getLink()."<br/>";
echo "Title:"."&nbsp;&nbsp;&nbsp;&nbsp;".$nCon->getTitle()."<br/>";
echo "Body:"."&nbsp;&nbsp;&nbsp;&nbsp;".$nCon->getBody()."<br/>";
echo "ID:"."&nbsp;&nbsp;&nbsp;&nbsp;".$nCon->getId()."<br/>";
echo "Comments Number:"."&nbsp;&nbsp;&nbsp;&nbsp;".$nCon->getCommentsNo()."<br/>";
echo "Image List:"."<br/>";
foreach($nCon->getImageList() as $i)
	echo $i."<br/>";
echo "Video List:"."<br/>";
foreach($nCon->getVideoList() as $v)
	echo $v."<br/>";
echo "Related News List:"."<br/><br/>";
foreach($nCon->getRelNewsList() as $k){
	echo $k->getId()."&nbsp;&nbsp;&nbsp;&nbsp;".$k->getTitle()."<br/><br/>";
}
echo "<br/>"."<br/>"."<br/>";
*/

//Testing getSectionNews

$nlist = $dao->getSectionNews(190,1);	//first argument: section id, second argument: page number with default=1

echo "Get news content test :"."<br/><br/>";
echo "Count:"."&nbsp;&nbsp;&nbsp;&nbsp;".count($nlist)."<br/>"."<br/>"."<hr/>"."<br/>";
foreach($nlist as $x){
echo "Title:"."&nbsp;&nbsp;&nbsp;&nbsp;".$x->getTitle()."<br/>";
echo "ID:"."&nbsp;&nbsp;&nbsp;&nbsp;".$x->getId()."<br/>";
echo "Image:"."&nbsp;&nbsp;&nbsp;&nbsp;".$x->getImage()."<br/>";
echo "PubDate:"."&nbsp;&nbsp;&nbsp;&nbsp;".$x->getPubDate()."<br/>";
echo "Date:"."&nbsp;&nbsp;&nbsp;&nbsp;".$x->getDate()."<br/>";
echo "Main Image:"."&nbsp;&nbsp;&nbsp;&nbsp;".$x->getMainImage()."<br/>";
echo "Abstract:"."&nbsp;&nbsp;&nbsp;&nbsp;".$x->getNewsAbstract()."<br/>";
echo "Row Num:"."&nbsp;&nbsp;&nbsp;&nbsp;".$x->getRowNum()."<br/>";
echo "Images Only:"."&nbsp;&nbsp;&nbsp;&nbsp;".$x->getImagesOnly()."<br/>"."<br/>"."<hr/>"."<br/>"."<br/>";
}

?>