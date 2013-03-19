<?php

class ReportCard {

	private $studentID; // Student ID of the report card we are running
	private $assignmentScores = array(); // Has array of objects of letter grade, calculated grade, and subject name for each subject student is in

	private $subjectAverage = array(); // array of subjects a student is in with average grade for subject
	// array('Subject Name' => 'Math','Numeric Grade'=>95, 'Letter Grade'=>'A')
	private $commonCoreFlag = false;

	// if priviledged user, allow changing final report card grade
	public function  changeReportCardGrade() {} 

	private function calculateNumericGrade($subjectId) {

	}
	
	private function calculateLetterGrade() {

	}

	private function calculateGPA() {

	}

}