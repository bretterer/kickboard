# Kickboard: Software Engineer Coding Challenge #


For this task, we ask you to program a simple case of a key concept from Kickboard: report card creation.

## Task Goal: ##
*  Create a set of permanent report cards (one per student) for the students and courses provided in the sample code. 
*  Report cards should include a numeric and letter grade for each subject (Math 95% A, for example) 
*  Report cards should also include an overall GPA score for the marking period. 
   *  To calculate overall GPA, find the average of the GPA values for a student's letter grades. 
   *  As designated in the code, "A" = 4.0, "B" = 3.0 etc. 
   *  This means if a student was enrolled in two courses, Math and Social Studies, and earned an A and B respectively, their GPA would be 3.5 for the marking period.


### Requirements: ###
1.  Once the report cards have been created, the architecture must prevent modification to report cards scores if individual assignment scores change.
2.  A privileged user (i.e. principal, guidance counselor) must be able to override/change the final report card grades manually, while preserving the original
calculated values. 
3.  Additionally, the solution must allow two kinds of report card calculation: 
	1)  all subject scores are used in the final GPA or 
	2)  only 'core academic' subjects are included in the final GPA. (Elective courses such as Art or Band for example, may not be included in the GPA at the user's discretion)

### Assumptions: ###
*  All scores are for a single marking period and belong on the report card. 
*  The AssignmentScore, Student and Subject classes represent a database record. 
*  All new models map directly to a database table, unless stated otherwise.

### Deliverables: ###
*  Using PHP, develop the algorithms and additional models needed to create the report cards; you may modify the provided classes if needed. 
*  Code must be executable in a command line or web interface. 
*  The application must allow the user to choose the calculation type dynamically, i.e. a command line switch (e.g. php reportcards.php -coreonly) or from an HTML form input. 
*  Initial code to populate the assignment scores has been provided with these instructions. 
*  Please provide an object-oriented solution. 
*  The provided coded is meant to be easy to use instead of complete OOP design. Be sure to use the best practices with which you are comfortable. 
*  It is not necessary to develop a complete system with database persistence, application environment or other supporting features. Spend the bulk of your time implementing a robust model.