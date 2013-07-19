<?php
header('Content-Type: text/xml; charset=utf-8');

require_once 'Lib/QueryPath/src/qp.php';

$xml = "";

$url = 'http://youm7.com/newsbar_files/file/mogazzzzz2352012.asp';
$htmlp = htmlqp($url);

$xml .= "<feed>";

foreach ($htmlp->find('img') as $image)
{
	$xml .= "<item>";
	$xml .= "<image>";
	$xml .= $image->attr('src');
	$xml .= "</image>";
	$xml .= "<link>";
	$xml .= $image->attr('longdesc');
	$xml .= "</link>";
	$xml .= "<alt>";
	$xml .= $image->attr('alt');
	$xml .= "</alt>";
	$xml .= "</item>";
}

$xml .= "</feed>";

echo $xml;

?>