<?php
DEFINE('APP_PATH', dirname(__FILE__));



?>
<html>

<head>
	<title>Kickboard Report Card</title>

	<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>

	<style>
		#options { margin-top: 50px;}
	</style>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="#">Kickboard Code Challenge</a>
			</div>
		</div>
	</div>

	<div class="container" id="options">
		<div class="well">
			<h3>I am a:</h3>
			<p>
				<label class="radio">
					<input type="radio" name="accountType" id="accountType1" value="student" checked>
						Student
				</label>
				<label class="radio">
					<input type="radio" name="accountType" id="accountType2" value="teacher">
						Educator
				</label>
				<label class="radio">
					<input type="radio" name="accountType" id="accountType3" value="admin">
						Administrator
				</label>
			</p>

			<label class="checkbox inline">
				<input type="checkbox" id="coreOnly" value="true"> Core academic Only? 
			</label>

			<h3>Report For: </h3>
			<select id="studentList">
				<option value="0">SELECT STUDENT</option>
			</select>

			<div class="row">
				<div class="span5 pull-right">
					<button id="showAssignments" class="btn btn-large btn-success">Show Assignments</button>
				</div>
			</div>

		</div>


	</div>

	<div class="container" id="response">
		<div class="row">
			<div class="span12">
				<h2>Report Card</h2>
			</div>
		</div>
		<div class="row">
			<div class="span6" id="assignments">
				<h4>Assignments</h4>
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th>AssignmentID</th>
							<th>Subject</th>
							<th>Score</th>
							<th>Modified Score</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<div class="span6" id="reportCard">
				<h4>Report Card</h4>
				<button id="generateReport" class="btn btn-large btn-success disabled" disabled="disabled">Generate Report Card</button>
			</div>
		</div>
	</div>

<script>
	$(document).ready(function() {
		var initialized = initializeApp();


		// Get students
		$.ajax({
		  dataType: "json",
			url: '_includes/reportHelper.php',
			data: {cmd: 'getStudents'},
			success: function(response) {
				$.each(response, function(student) {
					$('#studentList').append('<option value='+this.id+'>'+this.name+'</option>');
				});
			}
		});


		$('#showAssignments').on('click',function(e) {
			e.preventDefault();
			studentId = $('#studentList').val();
			if(studentId < 1) {
				return;
			}
			$table = $('#assignments tbody');
			$.ajax({
				dataType: "json",
				url: '_includes/reportHelper.php',
				data: {cmd: 'getAssignments',
							 studentID: studentId},
				success: function(response) {
					console.log(response);
					$.each(response, function(index, value) {
						$table.append('<tr>');
						$table.append('<td class="assignmentId">'+value.assignmentId+'</td>');
						$table.append('<td class="subjectId">'+value.subjectId+'</td>');
						$table.append('<td class="score">'+value.score+'</td>');
						$table.append('<td class="modifiedScore">'+value.modifiedScore+'</td>');
						$table.append('</tr>');

					});
					
				}
			});

			$('#generateReport').removeClass('disabled').removeAttr('disabled');
		});


		$('#generateReport').on('click',function(e) {
			studentId = $('#studentList').val();
			if($('#coreOnly').is(':checked')) {
				coreOnly = 'true';
			} else {
				coreOnly = 'false';
			}
			window.location.href = '_includes/reportHelper.php?cmd=generateReportCard&studentID='+studentId+'&coreOnly='+coreOnly;
		});

		


		function initializeApp() {
			$.ajax({
			  dataType: "json",
			  async: false,
				url: '_includes/reportHelper.php',
				data: {cmd: 'initialize'},
				success: function(response) { 
					console.log('Application Initialized');
					return true;
				}
			});
		}

		function makeModifiedScoreEditable() {
			$('.modifiedScore').removeAttr('disabled');
		}
	});
</script>
</body>
</html>