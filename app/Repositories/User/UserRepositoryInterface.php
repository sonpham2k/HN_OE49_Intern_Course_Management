<?php

namespace App\Repositories\User;

use App\Models\Post;
use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getLecturers();
    public function getStudents();
    public function insertDB($attributes = []);
    public function updateDB($id, $attributes = []);
    public function showCourseOfStudent($id);
    public function delete($id);
    public function userCheck();
    public function changePasstobcrypt($attributes = []);
    public function checkSamePassOldAndNew($attributes = []);
    public function checkSamePassNewAndConfirm($attributes = []);
    public function getTimeTableUser();
    public function getListStudent($id);
    public function updateUser($attributes = []);
    public function getCourseLecturer();
    public function getCodeResetPass($id, $code);
    public function findUser($email);
    public function searchAllLecturer($name);
    public function searchLecturer($year, $id);
    public function getDataChart($id);
    public function getStudent();
    public function findStudent($id);
}
