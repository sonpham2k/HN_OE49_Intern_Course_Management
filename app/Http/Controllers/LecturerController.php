<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditLecturerRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepositoryInterface;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $lecturers = $this->userRepo->getLecturers();

        return view('admin.lecturer.list', compact('lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lecturer.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        $this->userRepo->insertDB([
            'username' => $request->username,
            'password' => $request->password,
            'fullname' => $request->fullname,
            'dob' => $request->dob,
            'email' => $request->email,
            'address' => $request->address,
            'role_id' => config('auth.roles.lecturer'),
        ]);

        return redirect()->route('lecturers.create')
            ->with('success', __('Success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepo->find($id);

        return view('admin.lecturer.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lecturer = $this->userRepo->find($id);

        return view('admin.lecturer.edit', compact('lecturer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditLecturerRequest $request, $id)
    {
        $this->userRepo->updateDB($id, [
            'fullname' => $request->input('fullname'),
            'username' => $request->input('username'),
            'dob' => $request->input('date'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('lecturers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepo->delete($id);

        return redirect()->back();
    }
}
