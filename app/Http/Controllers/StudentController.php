<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\Students;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    protected $userRepo;

    public function __construct(
        UserRepositoryInterface $userRepo
    ) {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $students = $this->userRepo->getStudent();

        return view('admin.student.list', compact('students'));
    }

    public function create()
    {
        return view('admin.student.add');
    }

    public function store(AddUserRequest $request)
    {
        $this->userRepo->insertStudent([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'fullname' => $request->fullname,
            'dob' => $request->date,
            'email' => $request->email,
            'address' => $request->address,
            'role_id' => config('auth.roles.student'),
        ]);

        return redirect()->route('students.create')->with('success', __('Success'));
    }

    public function show($id)
    {
        $user = $this->userRepo->getTeacher($id);

        return view('admin.student.show', compact('user'));
    }

    public function edit($id)
    {
        $student = $this->userRepo->editStudent($id);

        return view('admin.student.edit', compact('student'));
    }

    public function update(EditUserRequest $request, $id)
    {
        $this->userRepo->updateStudent([
            'fullname' => $request->input('fullname'),
            'username' => $request->input('username'),
            'dob' => $request->input('date'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
        ], $id);
        
        return redirect()->route('students.index');
    }

    public function destroy($id)
    {
        $result = $this->userRepo->delete($id);

        return redirect()->back();
    }
}
