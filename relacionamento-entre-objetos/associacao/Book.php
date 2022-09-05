<?php

class Book
{
	private $title;
	private $isbn;
	private $publishing;

	/**
	 * @return mixed
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle( $title ) {
		$this->title = $title;
	}

	/**
	 * @return mixed
	 */
	public function getIsbn() {
		return $this->isbn;
	}

	/**
	 * @param mixed $isbn
	 */
	public function setIsbn( $isbn ) {
		$this->isbn = $isbn;
	}

	/**
	 * @return mixed
	 */
	public function getPublishing() {
		return $this->publishing;
	}

	/**
	 * @param mixed $publishing
	 */
	public function setPublishing( $publishing ) {
		$this->publishing = $publishing;
	}


}