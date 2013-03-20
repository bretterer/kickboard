<?php

// Model of the student

class Student {

	protected $id;
	protected $name;

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



}