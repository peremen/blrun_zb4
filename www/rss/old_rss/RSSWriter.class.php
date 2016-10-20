<?
/*///////////////////////////////////////////////////////////////

	프로그램명	: RSSWriter.class
	버전		: 0.9
	작성자		: 손상모
	최초작성일	: 2004.10.20

	*** 설명 ***

	RSS(Real Simple Syndication,Rich Site Summary) Writer

	1. RSS 2.0 Specification 지원

	*** 변경 내역 ***

/////////////////////////////////////////////////////////////////*/

class RSSWriter {
	var $charset = "utf-8";
	var $title;
	var $link;
	var $description;
	var $ChannelOptionalElements = array();
	var $items = array();

	function RSSWriter($title,$link,$description = null,$ChannelOptionalElements = array()){
		$this->setChannel($title,$link,$description);
		$this->setChannelOptionalElements($ChannelOptionalElements);
	}

	function setCharset($charset){
		$this->charset = $charset;
	}

	function setChannel($title,$link,$description = ""){
		$this->title		= $title;
		$this->link			= $link;
		$this->description	= $description;
	}

	function setChannelOptionalElements($ChannelOptionalElements){
		$this->$ChannelOptionalElements = $ChannelOptionalElements;
	}

	function setTitle($title){
		$this->title = $title;
	}

	function setLink($link){
		$this->link = htmlspecialchars($link);
	}

	function setDescription($description){
		$this->description = $description;
	}

	function setLanguage($language){
		$this->ChannelOptionalElements["language"] = $language;
	}

	function setCopyright($copyright){
		$this->ChannelOptionalElements["copyright"] = $copyright;
	}

	function setManagingEditor($managingEditor){
		$this->ChannelOptionalElements["managingEditor"] = $managingEditor;
	}

	function setWebmaster($webMaster){
		$this->ChannelOptionalElements["webMaster"] = $webMaster;
	}

	// date format YYYY-MM-DD HH:mm:ss 또는 YYYY-MM-DD (예 : 2000-11-01 00:00:00)
	function setPubDate($pubDate){
		$this->ChannelOptionalElements["pubDate"] 
			= sprintf("%s KST",date("Y-m-d H:i:s",$this->GetTimeStamp($pubDate)));
	}


	// date format YYYY-MM-DD HH:mm:ss 또는 YYYY-MM-DD (예 : 2000-11-01 00:00:00)
	function setLastBuildDate($lastBuildDate){
		$this->ChannelOptionalElements["lastBuildDate"] 
			= sprintf("%s KST",date("Y-m-d H:i:s",$this->GetTimeStamp($lastBuildDate)));
	}

	function setCategory($category){
		$this->ChannelOptionalElements["category"] = $category;
	}

	function setGenerator($generator){
		$this->ChannelOptionalElements["generator"] = $generator;
	}

	function setDocs($docs){
		$this->ChannelOptionalElements["docs"] = $docs;
	}

	function setCloud($cloud){
		$this->ChannelOptionalElements["cloud"] = $cloud;
	}

	function setTtl($ttl){
		$this->ChannelOptionalElements["ttl"] = $ttl;
	}

	function setImage($image){
		$this->ChannelOptionalElements["image"] = $image;
	}

	function setRating($rating){
		$this->ChannelOptionalElements["rating"] = $rating;
	}

	function setTextInput($textInput){
		$this->ChannelOptionalElements["textInput"] = $textInput;
	}

	function setSkipHours($skipHours){
		$this->ChannelOptionalElements["skipHours"] = $skipHours;
	}

	function setSkipDays($skipDays){
		$this->ChannelOptionalElements["skipDays"] = $skipDays;
	}

	function setItem($title,$link,$description ="",$author = "",$pubDate ="",$category ="",
			$guid ="",$source ="",$comments ="",$enclosure =""){
		$item = array();
		$item["title"]		= $title;
		$item["link"]		= $link;
		$item["description"]	= $description;
		$item["author"]		= $author;
		$item["pubDate"]	= sprintf("%s KST",date("Y-m-d H:i:s",$this->GetTimeStamp($pubDate)));
		$item["category"]	= $category;
		$item["guid"]		= $guid;
		$item["source"]		= $source;
		$item["comments"]	= $comments;
		$item["enclosure"]	= $enclosure;

		$this->addItem($item);
	}

	function addItem($item){
		array_push($this->items,$item);
	}

	function println(){
		header("Content-type: text/xml");
		printf("<?xml version=\"1.0\" encoding=\"%s\" ?>\n",$this->charset);
		print("<rss xmlns:dc=\"http://purl.org/dc/elements/1.1/\" version=\"2.0\">\n");

		$this->printChannel();

		print("</rss>\n");
	}

	function printChannel(){
		print("<channel>\n");
		printf("<title>%s</title>\n",$this->title);
		printf("<link>%s</link>\n",$this->link);
		printf("<description>%s</description>\n",$this->description);

		while (list($name,$value) = each ($this->ChannelOptionalElements)) {
			printf("<%s>%s</%s>\n",$name,$value,$name);
		}
		

		$this->printItems();

		print("</channel>\n");
	}

	function printItems(){
		foreach($this->items as $item){
			print("<item>\n");
			while (list($name,$value) = each($item)) {
				if(!empty($item[$name])){
					$value = htmlspecialchars($value);
					printf("<%s>%s</%s>\n",$name,$value,$name); 
				}
			}
			print("</item>\n");
		}
	}

	function GetTimeStamp($date) 
	{
		/* 인자 형식처리
		YYYY-MM-DD
		YYYY-MM-DD HH:mm:ss
		*/
		if (mb_strlen($DATE) == 10) {
			$time = mktime(0,0,0,(int)mb_substr($date,5,2),(int)mb_substr($date,8,2),(int)mb_substr($date,0,4));
		} else {
			$time = mktime((int)mb_substr($date,11,2),(int)mb_substr($date,14,2),
			(int)mb_substr($date,17,2),(int)mb_substr($date,5,2),(int)mb_substr($date,8,2),(int)mb_substr($date,0,4));
		}
		return $time;
	}

}
