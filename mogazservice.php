<?php
header('Content-Type: text/xml; charset=utf-8');

require_once 'Lib/QueryPath/src/qp.php';


$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";

$url = 'http://youm7.com/newsbar_files/file/mogazzzzz2352012.asp';
$htmlp = htmlqp($url);

$xml .= "<feeds>";

$rowNum=1;
foreach ($htmlp->find('img') as $image)
{
	$splitedURL = explode('=', $image->attr('longdesc'));
	$xml .= "<item>";
	$xml .= "<Title>".utf8_decode($image->attr('alt'))."</Title>";
	$xml .= "<ID>".$splitedURL[1]."</ID>";		
	$xml .=	"<image></image><PubDate></PubDate><date></date>";
	$xml .= "<mainimage>".$image->attr('src')."</mainimage>";
	$xml .= "<abstract></abstract>";
	$xml .= "<rownum>".$rowNum++."</rownum>";
	$xml .= "<ImagesOnly></ImagesOnly></item>";
}

$xml .= "</feeds>";

echo $xml;

?>