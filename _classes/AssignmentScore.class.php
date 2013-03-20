<?php

class AssignmentScore {
	
	protected $assignmentId;
	protected $studentId;
	protected $subjectId;
	protected $score;
	protected $modifiedScore;

	public function setAssignmentId($assignmentId) {
		$this->assignmentId = $assignmentId;
		return $this;
	}

	public function getAssignmentId() {
		return $this->assignmentId;
	}

	public function setStudentId($studentId) {
		$this->studentId = $studentId;
		return $this;
	}

	public function getStudentId() {
		return $this->studentId;
	}

	public function setSubjectId($subjectId) {
		$this->subjectId = $subjectId;
		return $this;
	}

	public function getSubjectId() {
		return $this->subjectId;
	}

	public function setScore($score) {
		$this->score = $score;
		return $this;
	}

	public function getScore() {
		return $this->score;
	}

	public function setModifiedScore($modifiedScore) {
		if(isset($_SESSION['teacher']) && ($_SESSION['teacher']!= true && $modifiedScore != null)) {
			throw new Exception('Not authorized to modify score for assignment');
		}
		$this->modifiedScore = $modifiedScore;
		return $this;
	}

	public function getModifiedScore() {
		return $this->modifiedScore;
	}

	public function getObject() {
		return $this;
	}

}