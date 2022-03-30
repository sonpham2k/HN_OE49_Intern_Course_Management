<?php

namespace App\Repositories\Course;

use App\Repositories\RepositoryInterface;

interface CourseRepositoryInterface extends RepositoryInterface
{
    // Lấy ra tất cả khoá học cùng với giảng viên
    public function getAllCourseWithLecturer();

    // Lấy ra khoá học cùng với giảng viên của nó
    public function getCourseWithLecturer($id);

    // Lấy ra sinh viên của khoá học đó
    public function getStudentOfCourse($course);

    // Lấy ra giảng viên của khoá học
    public function getLecturerOfCourse($id);
}
