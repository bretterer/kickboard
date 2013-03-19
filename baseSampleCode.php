<?php

// CLASS DEFINITIONS

class AssignmentScore {
	
	public $assignmentId;
	public $student;
	public $subject;
	public $score;

}

class Student {
	public $id;
}

class Subject {
	public $id;
	public $name;
	public $isCore;
}

// STUDENTS
$studentOne = new Student();
$studentOne->id = 1;

$studentTwo = new Student();
$studentTwo->id = 2;

$studentThree = new Student();
$studentThree->id = 3;

$studentFour = new Student();
$studentFour->id = 4;

// SUBJECTS (Courses)
$math = new Subject();
$math->id = 1;
$math->name = 'Math';
$math->isCore = true;

$socialStudies = new Subject();
$socialStudies->id = 2;
$socialStudies->name = 'Social Studies';
$socialStudies->isCore = false;

// GRADING SCALES
$scales = array(
	'a' => array('min' => 90, 'max' => 100, 'gpa' => 4.0),
	'b' => array('min' => 80, 'max' => 89, 'gpa' => 3.0),
	'c' => array('min' => 70, 'max' => 79, 'gpa' => 2.0),
	'd' => array('min' => 60, 'max' => 69, 'gpa' => 1.0),
	'f' => array('min' => 0, 'max' => 59, 'gpa' => 0.0),
	);

// ASSIGNMENT SCORES
$scores = array(	
	array('student_id' => $studentOne, 'subject' => $math, 'assignment_id' => 1, 'score' => 100),
	array('student_id' => $studentOne, 'subject' => $math, 'assignment_id' => 2, 'score' => 66),
	array('student_id' => $studentOne, 'subject' => $math, 'assignment_id' => 3, 'score' => 85),
	array('student_id' => $studentOne, 'subject' => $math, 'assignment_id' => 4, 'score' => 87),
	array('student_id' => $studentOne, 'subject' => $socialStudies, 'assignment_id' => 5, 'score' => 87),
	array('student_id' => $studentOne, 'subject' => $socialStudies, 'assignment_id' => 6, 'score' => 83),
	array('student_id' => $studentOne, 'subject' => $socialStudies, 'assignment_id' => 7, 'score' => 92),
	array('student_id' => $studentOne, 'subject' => $socialStudies, 'assignment_id' => 8, 'score' => 97),

	array('student_id' => $studentTwo, 'subject' => $math, 'assignment_id' => 1, 'score' => 52),
	array('student_id' => $studentTwo, 'subject' => $math, 'assignment_id' => 2, 'score' => 83),
	array('student_id' => $studentTwo, 'subject' => $math, 'assignment_id' => 3, 'score' => 75),
	array('student_id' => $studentTwo, 'subject' => $math, 'assignment_id' => 4, 'score' => 72),
	array('student_id' => $studentTwo, 'subject' => $socialStudies, 'assignment_id' => 5, 'score' => 91),
	array('student_id' => $studentTwo, 'subject' => $socialStudies, 'assignment_id' => 6, 'score' => 87),
	array('student_id' => $studentTwo, 'subject' => $socialStudies, 'assignment_id' => 7, 'score' => 85),
	array('student_id' => $studentTwo, 'subject' => $socialStudies, 'assignment_id' => 8, 'score' => 93),

	array('student_id' => $studentThree, 'subject' => $math, 'assignment_id' => 1, 'score' => 87),
	array('student_id' => $studentThree, 'subject' => $math, 'assignment_id' => 2, 'score' => 76),
	array('student_id' => $studentThree, 'subject' => $math, 'assignment_id' => 3, 'score' => 75),
	array('student_id' => $studentThree, 'subject' => $math, 'assignment_id' => 4, 'score' => 70),
	array('student_id' => $studentThree, 'subject' => $socialStudies, 'assignment_id' => 5, 'score' => 95),
	array('student_id' => $studentThree, 'subject' => $socialStudies, 'assignment_id' => 6, 'score' => 73),
	array('student_id' => $studentThree, 'subject' => $socialStudies, 'assignment_id' => 7, 'score' => 84),
	array('student_id' => $studentThree, 'subject' => $socialStudies, 'assignment_id' => 8, 'score' => 86),

	array('student_id' => $studentFour, 'subject' => $math, 'assignment_id' => 1, 'score' => 92),
	array('student_id' => $studentFour, 'subject' => $math, 'assignment_id' => 2, 'score' => 94),
	array('student_id' => $studentFour, 'subject' => $math, 'assignment_id' => 3, 'score' => 97),
	array('student_id' => $studentFour, 'subject' => $math, 'assignment_id' => 4, 'score' => 90),
	array('student_id' => $studentFour, 'subject' => $socialStudies, 'assignment_id' => 5, 'score' => 86),
	array('student_id' => $studentFour, 'subject' => $socialStudies, 'assignment_id' => 6, 'score' => 84),
	array('student_id' => $studentFour, 'subject' => $socialStudies, 'assignment_id' => 7, 'score' => 89),
	array('student_id' => $studentFour, 'subject' => $socialStudies, 'assignment_id' => 8, 'score' => 84),
);

// BUILD ASSIGNMENT SCORES
$assignmentScores = array();

foreach ($scores as $currScore) {
	
	$assignmentScore = new AssignmentScore();

	$assignmentScore->assignmentId = $currScore['assignment_id'];	
	$assignmentScore->student = $currScore['student_id'];
	$assignmentScore->subject = $currScore['subject'];
	$assignmentScore->score = $currScore['score'];
print_r($assignmentScore);	
	$assignmentScores[] = $assignmentScore;
	
}
