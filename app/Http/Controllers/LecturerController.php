<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditLecturerRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecturers = User::where('role_id', config('auth.roles.lecturer'))->get();

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
        DB::table('users')->insert([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'fullname' => $request->fullname,
            'dob' => $request->dob,
            'email' => $request->email,
            'address' => $request->address,
            'role_id' => config('auth.roles.lecturer'),
        ]);
        $request->session()->flash('success', __('Success'));

        return redirect()->route('lecturers.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

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
        $lecturer = User::findOrFail($id);

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
        DB::table('users')
            ->where('id', $id)
            ->update([
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
        $lecturer = User::findOrFail($id);
        $lecturer->courses()->detach();
        $lecturer->delete();

        return redirect()->back();
    }
}
