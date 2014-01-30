<?php

Plugin::setInfos(array(
		'id' => 'youtube_api',
		'title' => 'YoutubeAPI Class',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'GET class for Youtube Gdata API.'));
		

class YouTubeApi {

	public $id;
	public $title;
	public $description;
	public $rating;
	public $thumbnail1;
	public $thumbnail2;
	public $thumbnail3;
	public $thumbnail;
	public $views;
	public $duration_m;
	public $duration_s;
	public $url;

	function __construct( $url = NULL ) {

		$_id = $this->getYTid($url);
		$_url = "http://gdata.youtube.com/feeds/api/videos/".$_id;
		$api = new DOMDocument;
		$api->load($_url);
		
		$this->id = $_id;
		$this->title = $api->getElementsByTagName('title')->item(0)->nodeValue;
		$this->description = $api->getElementsByTagName('description')->item(0)->nodeValue;
		if($this->description == " " OR empty($this->description))
			$this->description = "Unfortunately <i>".$this->title."</i> has no description.";
		$this->thumbnail2 = $api->getElementsByTagName('thumbnail')->item(0)->getAttribute('url');
		$this->thumbnail1 = str_replace("2.jpg", "1.jpg", $this->thumbnail2);
		$this->thumbnail3 = str_replace("2.jpg", "3.jpg", $this->thumbnail2);
		$this->thumbnail = str_replace("2.jpg", "0.jpg", $this->thumbnail2);
		if($api->getElementsByTagName("rating")->length != 0) {
			$this->rating = substr($api->getElementsByTagName("rating")->item(0)->getAttribute('average'), 0, -5);
		}
		else
			$this->rating = 0;
		$this->views = $api->getElementsByTagName("statistics")->item(0)->getAttribute('viewCount');
		$this->url = $api->getElementsByTagName("content")->item(1)->getAttribute('url');
		
		$duration = $this->secondsToTime($api->getElementsByTagName("content")->item(1)->getAttribute('duration'));
		
		$this->duration_m = $duration['m'];
		$this->duration_s = $duration['s'];
	}

 	private function getYTid( $url ) {

		$ytvIDlen = 11;
		$idStarts = strpos($url, "?v=");
		if($idStarts === FALSE)
			$idStarts = strpos($url, "&v=");
		if($idStarts === FALSE)
			return $url;

		$idStarts +=3;
		$ytvID = substr($url, $idStarts, $ytvIDlen);

		return $ytvID;

	}

	private function secondsToTime($seconds)
	{
		// extract hours
		$hours = floor($seconds / (60 * 60));

		// extract minutes
		$divisor_for_minutes = $seconds % (60 * 60);
		$minutes = floor($divisor_for_minutes / 60);

		// extract the remaining seconds
		$divisor_for_seconds = $divisor_for_minutes % 60;
		$seconds = ceil($divisor_for_seconds);

		// return the final array
		$obj = array(
			"h" => (int) $hours,
			"m" => (int) $minutes,
			"s" => (int) $seconds,
		);
		return $obj;
	}

}