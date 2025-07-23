<?php

require_once __DIR__ . '/../models/Student.php';

class StudentController {

    public function index() {
        
        $student = new Student();
        $students = $student->getAll();
        require __DIR__ . '/../views/students.php';
    }

}

?>