<?php
class News{

    protected $title;
    protected $id;
    protected $pubDate;
    protected $date;
    protected $mainImage;
    
    public function getTitle(){
        return $this->title;
    }
    public function setTitle($t){
        $this->title = $t;
    }
    public function getId(){
        return $this->id;
    }
    public function setId($newId){
        $this->id = $newId;
    }
    public function getPubDate(){
        return $this->pubDate;
    }
    public function setPubDate($newPubDate){
        $this->pubDate = $newPubDate;
    }
    public function getDate(){
        return $this->date;
    }
    public function setDate($newDate){
        $this->date = $newDate;
    }
    public function getMainImage(){
        return $this->mainImage;
    }
    public function setMainImage($newMainImage){
        $this->mainImage = $newMainImage;
    }

}

class NewsAbstract extends News{
    protected $image;
    protected $newsAbstract;
    protected $rowNum;
    protected $imagesOnly;
    
    public function getImage(){
        return $this->image;
    }
    public function setImage($i){
        $this->image = $i;
    }
    public function getNewsAbstract(){
        return $this->newsAbstract;
    }
    public function setNewsAbstract($a){
        $this->newsAbstract = $a;
    }
    public function getRowNum(){
        return $this->rowNum;
    }
    public function setRowNum($n){
        $this->rowNum = $n;
    }
    public function getImagesOnly(){
        return $this->imagesOnly;
    }
    public function setImagesOnly($o){
        $this->imagesOnly = $o;
    }
}

class NewsContent extends News {
    protected $link;
    protected $body;
    protected $commentsNo;
    protected $imageList;   //array of images links
    protected $videoList;   //array of video links
    protected $relNewsList; //array of related news stored in News objects
    
    public function getLink(){
        return $this->link;
    }
    public function setLink($l){
        $this->link = $l;
    }
    public function getBody(){
        return $this->body;
    }
    public function setBody($b){
        $this->body = $b;
    }
    public function getCommentsNo(){
        return $this->commentsNo;
    }
    public function setCommentsNo($n){
        $this->commentsNo = $n;
    }
    public function getImageList(){
        return $this->imageList;
    }
    public function setImageList($list){
        $this->imageList = $list;
    }
    public function getVideoList(){
        return $this->videoList;
    }
    public function setVideoList($list){
        $this->videoList = $list;
    }
    public function getRelNewsList(){
        return $this->relNewsList;
    }
    public function setRelNewsList($list){
        $this->relNewsList = $list;
    }
}
?>