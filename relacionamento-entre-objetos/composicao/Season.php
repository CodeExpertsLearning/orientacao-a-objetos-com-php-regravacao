<?php

class Season
{
	private $episode;
	private $seasonTitle;

	public function __construct($seasonTitle)
	{
		$this->episode = new Episode();
		$this->seasonTitle = $seasonTitle;
	}

	public function setEpisode($title, $description)
	{
		$this->episode->setTitle($title);
		$this->episode->setDescription($description);
	}

	public function getEpisode()
	{
		return $this->episode;
	}
}