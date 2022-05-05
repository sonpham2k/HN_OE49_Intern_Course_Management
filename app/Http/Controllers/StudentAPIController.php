<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\RegisterUserAPIRequest;

class StudentAPIController extends Controller
{
    protected $studentRepo;

    public function __construct(UserRepositoryInterface $studentRepo)
    {
        $this->studentRepo = $studentRepo;
    }

    //Create student (Register student)
    public function registerStudent(RegisterUserAPIRequest $request)
    {
        try {
            $request['password'] = Hash::make($request['password']);
            $request['remember_token'] = Str::random(10);
            $user = User::insert(array_merge($request->toArray(), ['role_id' => config('auth.roles.student')]));

            return response()->json(['message' => 'Registration Successfull'], 200);
        } catch (Exception $error) {
            return response()->json(['message' => 'Error in Registration', 'error' => $error], 500);
        }
    }

    //Read all student
    public function getAllStudent()
    {
        return response()->json($this->studentRepo->getStudent());
    }

    //Read student with ID
    public function getStudentID($id)
    {
        $student = $this->studentRepo->findStudent($id);
        if (is_null($student)) {
            return response()->json(['message' => 'Student Not Found'], 404);
        }

        return response()->json($this->studentRepo->findStudent($id), 200);
    }

    //Update student
    public function updateStudent(Request $request, $id)
    {
        $student = $this->studentRepo->findStudent($id);
        if (is_null($student)) {
            return response()->json(['message' => 'Student Not Found'], 404);
        }
        $student->update($request->all());

        return response()->json(['message' => 'Update student Successfull'], 200);
    }

    //Delete Student
    public function deleteStudent(Request $request, $id)
    {
        $student = $this->studentRepo->findStudent($id);
        if (is_null($student)) {
            return response()->json(['message' => 'Student Not Found'], 404);
        }
        $student->delete();

        return response()->json(['message' => 'Delete student Successfull'], 200);
    }
}
