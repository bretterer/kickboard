<?php

DEFINE('APP_PATH', dirname(dirname(__FILE__)));

require_once(APP_PATH.'/_classes/ReportCard.class.php');
require_once(APP_PATH.'/_classes/AssignmentScore.class.php');
require_once(APP_PATH.'/_classes/Student.class.php');
require_once(APP_PATH.'/_classes/Subject.class.php');


// Set Up Students
$studentOne = new Student(1, 'Brian Retterer');
$studentTwo = new Student(2, 'John Doe');
$studentThree = new Student(3, 'Jane Doe');
$studentFour = new Student(4, 'Sally Doe');
$students[] = $studentOne->toArray();
$students[] = $studentTwo->toArray();
$students[] = $studentThree->toArray();
$students[] = $studentFour->toArray();

// Set Up Subjects (Courses)
$math = new Subject(1, 'Math', true);
$socialStudies = new Subject(2, 'Social Studies');
$subjects[] = $math->toArray();
$subjects[] = $socialStudies->toArray();

// Set Up Scales
$scales = require_once('scales.php');

// Set Up Assignment Scores
// ASSIGNMENT SCORES
$scores = array(	
	array('student_obj' => $studentOne, 'subject_obj' => $math, 'assignment_id' => 1, 'score' => 100),
	array('student_obj' => $studentOne, 'subject_obj' => $math, 'assignment_id' => 2, 'score' => 66),
	array('student_obj' => $studentOne, 'subject_obj' => $math, 'assignment_id' => 3, 'score' => 85),
	array('student_obj' => $studentOne, 'subject_obj' => $math, 'assignment_id' => 4, 'score' => 87),
	array('student_obj' => $studentOne, 'subject_obj' => $socialStudies, 'assignment_id' => 5, 'score' => 87),
	array('student_obj' => $studentOne, 'subject_obj' => $socialStudies, 'assignment_id' => 6, 'score' => 83),
	array('student_obj' => $studentOne, 'subject_obj' => $socialStudies, 'assignment_id' => 7, 'score' => 92),
	array('student_obj' => $studentOne, 'subject_obj' => $socialStudies, 'assignment_id' => 8, 'score' => 97),

	array('student_obj' => $studentTwo, 'subject_obj' => $math, 'assignment_id' => 1, 'score' => 52),
	array('student_obj' => $studentTwo, 'subject_obj' => $math, 'assignment_id' => 2, 'score' => 83),
	array('student_obj' => $studentTwo, 'subject_obj' => $math, 'assignment_id' => 3, 'score' => 75),
	array('student_obj' => $studentTwo, 'subject_obj' => $math, 'assignment_id' => 4, 'score' => 72),
	array('student_obj' => $studentTwo, 'subject_obj' => $socialStudies, 'assignment_id' => 5, 'score' => 91),
	array('student_obj' => $studentTwo, 'subject_obj' => $socialStudies, 'assignment_id' => 6, 'score' => 87),
	array('student_obj' => $studentTwo, 'subject_obj' => $socialStudies, 'assignment_id' => 7, 'score' => 85),
	array('student_obj' => $studentTwo, 'subject_obj' => $socialStudies, 'assignment_id' => 8, 'score' => 93),

	array('student_obj' => $studentThree, 'subject_obj' => $math, 'assignment_id' => 1, 'score' => 87),
	array('student_obj' => $studentThree, 'subject_obj' => $math, 'assignment_id' => 2, 'score' => 76),
	array('student_obj' => $studentThree, 'subject_obj' => $math, 'assignment_id' => 3, 'score' => 75),
	array('student_obj' => $studentThree, 'subject_obj' => $math, 'assignment_id' => 4, 'score' => 70),
	array('student_obj' => $studentThree, 'subject_obj' => $socialStudies, 'assignment_id' => 5, 'score' => 95),
	array('student_obj' => $studentThree, 'subject_obj' => $socialStudies, 'assignment_id' => 6, 'score' => 73),
	array('student_obj' => $studentThree, 'subject_obj' => $socialStudies, 'assignment_id' => 7, 'score' => 84),
	array('student_obj' => $studentThree, 'subject_obj' => $socialStudies, 'assignment_id' => 8, 'score' => 86),

	array('student_obj' => $studentFour, 'subject_obj' => $math, 'assignment_id' => 1, 'score' => 92),
	array('student_obj' => $studentFour, 'subject_obj' => $math, 'assignment_id' => 2, 'score' => 94),
	array('student_obj' => $studentFour, 'subject_obj' => $math, 'assignment_id' => 3, 'score' => 97),
	array('student_obj' => $studentFour, 'subject_obj' => $math, 'assignment_id' => 4, 'score' => 90),
	array('student_obj' => $studentFour, 'subject_obj' => $socialStudies, 'assignment_id' => 5, 'score' => 86),
	array('student_obj' => $studentFour, 'subject_obj' => $socialStudies, 'assignment_id' => 6, 'score' => 84),
	array('student_obj' => $studentFour, 'subject_obj' => $socialStudies, 'assignment_id' => 7, 'score' => 89),
	array('student_obj' => $studentFour, 'subject_obj' => $socialStudies, 'assignment_id' => 8, 'score' => 84),
);

// BUILD ASSIGNMENT SCORES
$assignmentScores = array();

foreach ($scores as $currScore) {
	
	$assignmentScore = new AssignmentScore();

	$assignmentScore->assignmentId = $currScore['assignment_id'];	
	$assignmentScore->studentId = $currScore['student_obj']->id;
	$assignmentScore->subjectId = $currScore['subject_obj']->id;
	$assignmentScore->score = $currScore['score'];

	// $assignmentScores[$assignmentScore->studentId][] = array('assignmentId'=>$assignmentScore->assignmentId, 'studentId'=>$assignmentScore->studentId, 'subjectId'=>$assignmentScore->subjectId,'score'=>$assignmentScore->score);
	$assignmentScores[$assignmentScore->studentId][] = $assignmentScore->toArray();
	
}





