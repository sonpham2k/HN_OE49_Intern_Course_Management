<?php

namespace App\Repositories\User;

use App\Models\Post;
use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getLecturers();

    public function getStudents();

    //Insert sử dụng DB
    public function insertDB($attributes = []);

    //update sử dụng DB
    public function updateDB($id, $attributes = []);

    //Show khoá học của sinh viên
    public function showCourseOfStudent($id);
}
