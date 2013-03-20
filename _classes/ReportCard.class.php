<?php

class ReportCard {

	private $studentId; 
	private $studentName;
	private $currentSubjectId; // The subject we are currently talking about.
	private $subjects = array();
	private $gradeScale;
	private $coreOnlyFlag = false;
	private $gpaTotalScore = 0;
	private $gpaSubjects = 0;
	private $gpa;




	public function __construct($studentObj) {
		$this->studentId = $studentObj->getId();
		$this->studentName = $studentObj->getName();
	}

	public function showReportCard() {
		foreach($this->subjects as $subjectId => $subjectData) {
			$this->currentSubjectId = $subjectId;

			self::calculateNewSubjectNumericScore();
			self::calculateNewSubjectLetterScore();
			self::calculateGpa();

		}
		return $this;
		
	}

	public function setCoreOnlyFlag() {
		$this->coreOnlyFlag = true;
	}

	public function addSubjects(Collection $subjectCollection) {
		
		foreach($subjectCollection->getObjects() as $subject) {

			if(!isset($this->subjects[$subject->getId()])) {
				$this->subjects[$subject->getId()]['name'] = $subject->getName();
				$this->subjects[$subject->getId()]['isCore'] = $subject->getIsCore();
				$this->subjects[$subject->getId()]['totalAssignments'] = 0;
				$this->subjects[$subject->getId()]['totalScore'] = 0;
				$this->subjects[$subject->getId()]['numericScore'] = 0;
				$this->subjects[$subject->getId()]['letterScore'] = NULL;
			}
		}
		
	}

	public function addStudentAssignments(Array $assignments) {
		foreach($assignments as $assignment) {
			self::setAssignmentData($assignment);
		}
	}

	/** 
	 * If an admin, we will allow them to update the final letter grade
	 */
	public function updateFinalGrade($subjectId,$letterGrade) {
		if(!$_SESSION['isAdmin']) {
			throw new Exception('You are not authorized to update letter grades after report has been made');
		}
		$this->subjects[$subjectId]['letterScore'] = $letterGrade;
	}

	private function setAssignmentData(AssignmentScore $assignment) {
		// Set the current subject id for this assignment
		$this->currentSubjectId = $assignment->getSubjectId();

		self::addToTotalScore($assignment->getScore());
		self::addtoTotalAssignmentsForSubject(); 

	}

	private function addToTotalScore($score) {
		$this->subjects[$this->currentSubjectId]['totalScore'] += $score;
	}

	private function addToTotalAssignmentsForSubject() {
		$this->subjects[$this->currentSubjectId]['totalAssignments']++;
	}

	private function calculateNewSubjectNumericScore() {
		$this->subjects[$this->currentSubjectId]['numericScore'] = $this->subjects[$this->currentSubjectId]['totalScore']/$this->subjects[$this->currentSubjectId]['totalAssignments'];
	}

	private function calculateNewSubjectLetterScore() {
		$grade = $this->subjects[$this->currentSubjectId]['numericScore'];
		$gradeScale = (array)require('../_data/scales.data.php');
		

		foreach($gradeScale as $scale) {
			
			if($scale['maxNumeric'] >= $grade && $scale['minNumeric'] <= $grade) {
				$this->subjects[$this->currentSubjectId]['letterScore'] = strtoupper($scale['letterGrade']);
				if($this->coreOnlyFlag === false || $this->coreOnlyFlag === true && $this->subjects[$this->currentSubjectId]['isCore'] == true) {
					self::addToGPA($scale['gpaValue']);
				}
			}
		}

	}

	private function addToGPA($gpa) {
		
			$this->gpaTotalScore += $gpa;
			$this->gpaSubjects++;
		
	}

	private function calculateGpa() {
		$this->gpa = $this->gpaTotalScore/$this->gpaSubjects;
	}


}