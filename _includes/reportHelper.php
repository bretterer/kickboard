<?php
session_start();
DEFINE('APP_PATH', dirname(dirname(__FILE__)));

	require_once(APP_PATH . '/_classes/Collection.class.php');
	require_once(APP_PATH . '/_classes/AssignmentScore.class.php');
	require_once(APP_PATH . '/_classes/ReportCard.class.php');
	require_once(APP_PATH . '/_classes/Student.class.php');
	require_once(APP_PATH . '/_classes/Subject.class.php');
$cmd = $_REQUEST['cmd'];

switch($cmd) {
	case 'initialize':
		print initializeScript();
	break;

	case 'getStudents':
		print_r(getStudents());
	break;

	case 'getAssignments':
		print_r(getAssignments($_REQUEST['studentID'], false));
	break;

	case 'generateReportCard':
		print_r(generateReportCard($_REQUEST['studentID']));
	break;
}

// This function needs to be executed after page is loaded 
function initializeScript() {

	session_destroy();
	session_start();

	// Lets get all required classes

	// Lets get all the data arrays
	$scores = require_once(APP_PATH . '/_data/scores.data.php');
	$students = require_once(APP_PATH . '/_data/students.data.php');
	$subjects = require_once(APP_PATH . '/_data/subjects.data.php');

	// Create the student Collection
	$studentCollection = new Collection();

	foreach($students as $student) {
		$student_obj = new Student();
		$student_obj->setId($student['id'])
								->setName($student['name']);

		$studentCollection->add($student_obj);
	}
	// Save the student Collection into session
	$_SESSION['students'] = serialize($studentCollection);


	// Create the subject Collection
	$subjectCollection = new Collection();
	foreach($subjects as $subject) {
		$subject_obj = new Subject();
		$subject_obj->setId($subject['id'])
								->setName($subject['name'])
								->setIsCore($subject['isCore']);

		$subjectCollection->add($subject_obj);
	}
	// Save teh subject Collection into session
	$_SESSION['subjects'] = serialize($subjectCollection);

	// Create the scores collection
	$scoreCollection = new Collection(); 
	foreach($scores as $score) {
		$score_obj = new AssignmentScore();
		$score_obj->setAssignmentId($score['assignmentId'])
							->setStudentId($score['studentId'])
							->setSubjectId($score['subjectId'])
							->setScore($score['score'])
							->setModifiedScore($score['modifiedScore']);
		$scoreCollection->add($score_obj);
	}
	// Save the score Collection into session
	$_SESSION['scores'] = serialize($scoreCollection);

	return true;
	
}

function getStudents() {
	$students = unserialize($_SESSION['students']);

	$studentCount = $students->getNumObjects();
	$i=1;


	while($studentCount >= $i) {
		$student = $students->getCurrent();
		$studentArrInfo['id'] = $student->getId();
		$studentArrInfo['name'] = $student->getName();
		$studentArr[] = $studentArrInfo;
		$students->next();
		$i++;
	}

	return json_encode($studentArr);
}

function getAssignments($studentID, $object = false) {
	
	$assignments = unserialize($_SESSION['scores']);

	$numberAssignments = $assignments->getNumObjectsWithProperty('studentId',$studentID);
	$i=1;

	$assignments = $assignments->getObjectsWithProperty('studentId',$studentID);
	
	if($object == true) {
		return $assignments;
	}
	foreach($assignments as $assignment) {
		// print_r($assignment);
		$assignmentArrInfo['assignmentId'] = $assignment->getAssignmentId();
		$assignmentArrInfo['studentId'] = $assignment->getStudentId();
		$assignmentArrInfo['subjectId'] = $assignment->getSubjectId();
		$assignmentArrInfo['score'] = $assignment->getScore();
		$assignmentArrInfo['modifiedScore'] = $assignment->getModifiedScore();
		$assignmentArr[] = $assignmentArrInfo;
	}

	return json_encode($assignmentArr);

}

function generateReportCard($studentId) {
	$students = unserialize($_SESSION['students']);
	$student = $students->getByProperty('id',$studentId);
	$assignments = getAssignments($studentId,true);



	// Generate the new report card for a student	
	$reportCard = new ReportCard($student);
	if($_REQUEST['coreOnly'] == 'true') {
		$reportCard->setCoreOnlyFlag();
	}

	// Add subjects to the report card.
	$reportCard->addSubjects(unserialize($_SESSION['subjects']));

	// Add the student assignments
	$reportCard->addStudentAssignments($assignments);
print('<pre>');
	print_r($reportCard->showReportCard());
	

}