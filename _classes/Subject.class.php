<?php

// Model of a subject (course) 

class Subject {

	protected $id;
	protected $name;
	protected $isCore;

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	public function getId() {
		return $this->id;
	}

	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	public function getName() {
		return $this->name;
	}

	public function setIsCore($isCore) {
		$this->isCore = $isCore;
		return $this;
	}

	public function getIsCore() {
		return $this->isCore;
	}

}