# SAMS
School Attendance Management System Student Mini Project (Assam Don Bosco University)

Technology used 
Front End - HTML 5, CSS 3 and JavaScript
Framework - Bootstrap 4
Back End - PHP 7.4.3
Database - MYSQL 8.0.27


Database

CREATE TABLE Subject (
    	SubjectCode char(5) NOT NULL,
    	SubjectName varchar(20) NOT NULL,
	status int,
    	PRIMARY KEY (SubjectCode)
);


CREATE TABLE Teacher (
	TeacherId char(13) NOT NULL,
	TeacherName varchar(50) NOT NULL,
	status int,
	PRIMARY KEY(TeacherId)

);


CREATE TABLE Class (
	ClassCode int NOT NULL AUTO_INCREMENT,
	ClassName varchar(30) NOT NULL,
	SubjectCode char(5),
 	TeacherId char(13),
	TeacherName varchar(50),
	SubjectName varchar(50),
	status int,

	CONSTRAINT PK_Class PRIMARY KEY (ClassCode),

	CONSTRAINT FK_Class1 FOREIGN KEY (SubjectCode)
    	REFERENCES Subject(SubjectCode) ON DELETE SET NULL,

	CONSTRAINT FK_Class2 FOREIGN KEY (TeacherId)
    	REFERENCES Teacher(TeacherId) ON DELETE SET NULL
);


CREATE TABLE Student(
studentId char(13),
  	studentName varchar(50),
	classCode int,
    	className varchar(20),
	status int,
	CONSTRAINT student_Pk PRIMARY KEY (studentId, className),
	CONSTRAINT class_Fk FOREIGN KEY( classCode)
	REFERENCES Class(ClassCode)
)

CREATE TABLE Attendance(
	pKey int PRIMARY KEY,
	studentId char(13),
	className varchar(20),
	subjectName varchar(30),
	cur_date date,
	attendance int,
	
	CONSTRAINT Attend_FK FOREIGN KEY(studentId)
	REFERENCES Student(studentId)
)

CREATE TABLE Login(
	loginId varchar(15) PRIMARY KEY,
	password char(32),
	flag int,
	status int
)
