<?php
require_once "core/datastructures.php";
interface NewsDao {
	function getSectionNews($secId, $page = 1);
	function getNewsContent($newsId);
	function getTopNews();
}
class DaoFactory {
	const NEWS_SERVICE_DAO = 1;
	static function getDao($type) {
		switch ($type) {
			case self::NEWS_SERVICE_DAO :
				return new NewsServiceDao ();
		}
	}
}
class NewsServiceDao implements NewsDao {
	private $tempList; // holds list of values and objects during parsing
	private $currentTag; // holds current tag
	private $tempNewsAbs; // holds temp NewsAbstract objects during parsing
	private $tempNewsCon; // holds temp NewsContent objects during parsing
	private $tempNews; // holds temp News objects during parsing
	private $rNewsFlag; // flag to indicate parsing related news
	private function doGetRequest($url) {
		$ch = curl_init ( $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_TIMEOUT, 300);	//WARNING: this value is in sec, too long time just for testing on local servrer
		ini_set('max_execution_time', 300);	//WARNING: this value is in sec, too long time just for testing on local servrer
		$response = curl_exec ( $ch );
		curl_close ( $ch );
		return $response;
	}
	public function getSectionNews($secId, $page = 1) {
		$url = "http://mobrss.youm7.com/rss/service.svc/SelectForSpecifiedSection/SecID/$secId/page/$page";
		$response = $this->doGetRequest ( $url );
		$parser = xml_parser_create ( "UTF-8" );
		
		xml_set_element_handler ( 		// anonymous handler functions used here
		$parser, function ($parser, $name, $attributes) { // start tag handler
			$name = strtolower ( $name );
			switch ($name) {
				case 'feeds' :
					$this->tempList = array ();
					break;
				case 'item' :
					$this->tempNewsAbs = new NewsAbstract ();
					break;
				default :
					$this->currentTag = $name;
					break;
			}
		}, function ($parser, $name) { // end tag handler
			$name = strtolower ( $name );
			if ($name == 'item')
				$this->tempList [] = $this->tempNewsAbs;
		} );
		
		xml_set_character_data_handler ( 		// anonymous handler functions used here
		$parser, function ($parser, $data) { // character data handler
			switch ($this->currentTag) {
				case 'title' :
					$this->tempNewsAbs->setTitle ( $this->tempNewsAbs->getTitle () . $data );
					break;
				case 'id' :
					$this->tempNewsAbs->setId ( $this->tempNewsAbs->getId () . $data );
					break;
				case 'image' :
					$this->tempNewsAbs->setImage ( $this->tempNewsAbs->getImage () . $data );
					break;
				case 'pubdate' :
					$this->tempNewsAbs->setPubDate ( $this->tempNewsAbs->getPubDate () . $data );
					break;
				case 'date' :
					$this->tempNewsAbs->setDate ( $this->tempNewsAbs->getDate () . $data );
					break;
				case 'mainimage' :
					$this->tempNewsAbs->setMainImage ( $this->tempNewsAbs->getMainImage () . $data );
					break;
				case 'abstract' :
					$this->tempNewsAbs->setNewsAbstract ( $this->tempNewsAbs->getNewsAbstract () . $data );
					break;
				case 'rownum' :
					$this->tempNewsAbs->setRowNum ( $this->tempNewsAbs->getRowNum () . $data );
					break;
				case 'imagesonly' :
					$this->tempNewsAbs->setImagesOnly ( $this->tempNewsAbs->getImagesOnly () . $data );
					break;
			}
		} );
		
		xml_parse ( $parser, $response );
		xml_parser_free ( $parser );
		
		return $this->tempList;
	}
	public function getNewsContent($newsId) {
		$url = "http://mobrss.youm7.com/rss/service.svc/SelectForNewsDetails/id/$newsId";
		$response = $this->doGetRequest ( $url );
		$parser = xml_parser_create ( "UTF-8" );
		$this->rNewsFlag = false;
		
		xml_set_element_handler ( 		// anonymous handler functions used here
		$parser, function ($parser, $name, $attributes) { // start tag handler
			$name = strtolower ( $name );
			switch ($name) {
				case 'item' :
					$this->tempNewsCon = new NewsContent ();
					break;
				case 'images' :
					$this->tempList = array ();
					break;
				case 'videos' :
					$this->tempList = array ();
					break;
				case 'relatednews' :
					$this->tempList = array ();
					$this->rNewsFlag = true;
					break;
				case 'news' :
					$this->tempNews = new News ();
					break;
				default :
					$this->currentTag = $name;
					break;
			}
		}, function ($parser, $name) { // end tag handler
			$name = strtolower ( $name );
			switch ($name) {
				case 'images' :
					$this->tempNewsCon->setImageList ( $this->tempList );
					$this->tempList = null;
					break;
				case 'videos' :
					$this->tempNewsCon->setVideoList ( $this->tempList );
					$this->tempList = null;
					break;
				case 'news' :
					$this->tempList [] = $this->tempNews;
					break;
				case 'relatednews' :
					$this->tempNewsCon->setRelNewsList ( $this->tempList );
					$this->rNewsFlag = false;
					break;
			}
		} );
		
		xml_set_character_data_handler ( 		// anonymous handler functions used here
		$parser, function ($parser, $data) { // character data handler
			switch ($this->currentTag) {
				case 'pubdate' :
					$this->tempNewsCon->setPubDate ( $this->tempNewsCon->getPubDate () . $data );
					break;
				case 'date' :
					$this->tempNewsCon->setDate ( $this->tempNewsCon->getDate () . $data );
					break;
				case 'mainimage' :
					$this->tempNewsCon->setMainImage ( $this->tempNewsCon->getMainImage () . $data );
					break;
				case 'link' :
					$this->tempNewsCon->setLink ( $this->tempNewsCon->getLink () . $data );
					break;
				case 'title' :
					if (! $this->rNewsFlag) {
						$this->tempNewsCon->setTitle ( $this->tempNewsCon->getTitle () . $data );
					} else {
						$this->tempNews->setTitle ( $this->tempNews->getTitle () . $data );
					}
					break;
				case 'body' :
					$this->tempNewsCon->setBody ( $this->tempNewsCon->getBody () . $data );
					break;
				case 'id' :
					if (! $this->rNewsFlag) {
						$this->tempNewsCon->setId ( $this->tempNewsCon->getId () . $data );
					} else {
						$this->tempNews->setId ( $this->tempNews->getId () . $data );
					}
					break;
				case 'numberofcomments' :
					$this->tempNewsCon->setCommentsNo ( $this->tempNewsCon->getCommentsNo () . $data );
					break;
				case 'image' :
					$this->tempList [] = $data;
					break;
				case 'video' :
					$this->tempList [] = $data;
					break;
			}
		} );
		
		xml_parse ( $parser, $response );
		xml_parser_free ( $parser );
		
		return $this->tempNewsCon;
	}
	public function getTopNews(){
		$url = "http://mobrss.youm7.com/rss/Service.svc/NewsTopStories";
		$response = $this->doGetRequest ( $url );
		$parser = xml_parser_create ( "UTF-8" );
	
		xml_set_element_handler ( 		// anonymous handler functions used here
		$parser, function ($parser, $name, $attributes) { // start tag handler
			$name = strtolower ( $name );
			switch ($name) {
				case 'feeds' :
					$this->tempList = array ();
					break;
				case 'item' :
					$this->tempNewsAbs = new NewsAbstract ();
					break;
				default :
					$this->currentTag = $name;
					break;
			}
		}, function ($parser, $name) { // end tag handler
			$name = strtolower ( $name );
			if ($name == 'item')
				$this->tempList [] = $this->tempNewsAbs;
		} );
	
		xml_set_character_data_handler ( 		// anonymous handler functions used here
		$parser, function ($parser, $data) { // character data handler
			switch ($this->currentTag) {
				case 'title' :
					$this->tempNewsAbs->setTitle ( $this->tempNewsAbs->getTitle () . $data );
					break;
				case 'id' :
					$this->tempNewsAbs->setId ( $this->tempNewsAbs->getId () . $data );
					break;
				case 'image' :
					$this->tempNewsAbs->setImage ( $this->tempNewsAbs->getImage () . $data );
					break;
				case 'pubdate' :
					$this->tempNewsAbs->setPubDate ( $this->tempNewsAbs->getPubDate () . $data );
					break;
				case 'date' :
					$this->tempNewsAbs->setDate ( $this->tempNewsAbs->getDate () . $data );
					break;
				case 'mainimage' :
					$this->tempNewsAbs->setMainImage ( $this->tempNewsAbs->getMainImage () . $data );
					break;
				case 'abstract' :
					$this->tempNewsAbs->setNewsAbstract ( $this->tempNewsAbs->getNewsAbstract () . $data );
					break;
				case 'rownum' :
					$this->tempNewsAbs->setRowNum ( $this->tempNewsAbs->getRowNum () . $data );
					break;
				case 'imagesonly' :
					$this->tempNewsAbs->setImagesOnly ( $this->tempNewsAbs->getImagesOnly () . $data );
					break;
			}
		} );
	
		xml_parse ( $parser, $response );
		xml_parser_free ( $parser );
	
		return $this->tempList;
	}
}

?>