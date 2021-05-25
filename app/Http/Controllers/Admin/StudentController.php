<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Imports\UsersImport;
use App\Models\Result;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->create_new = new User();
        $this->create_new_result = new Result();
    }

    public function index()
    {
        $data['title'] = 'Students';
        $data['sn'] = 1;
        $data['students'] = User::where('role', 'Student')->with('classes:id,name')->paginate(15);
        return view('admin.student.index', $data);
    }

    public function create(Request $request)
    {
        if ($_POST) {
            if ($request->id) {
                $rules = array(
                    'surname' => ['required', 'max:255'],
                    'last_name' => ['required', 'max:255'],
                    // 'class' => ['required']
                );
                $fieldNames = array(
                    'surname'   => 'Surname',
                    'last_name' => 'Last Name',
                    // 'class' => 'Class'
                );
                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $user = User::find($request->id);
                        $user->surname = $request->surname;
                        $user->last_name = $request->last_name;
                        // $user->class_id = $request->class;
                        $user->save();
                        $this->check_student();
                        Session::flash('success', 'Student Updated Successfully');
                        return redirect('admin/students');
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            } else {
                $rules = array(
                    'surname' => ['required', 'max:255'],
                    'last_name' => ['required', 'max:255'],
                    'class' => ['required']
                );
                $fieldNames = array(
                    'surname'   => 'Surname',
                    'last_name' => 'Last Name',
                    'class' => 'Class'
                );
                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $this->create_new->create_student($request);
                        $this->check_student();
                        Session::flash('success', 'Student Created Successfully');
                        return redirect('admin/students');
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            }
        } else {
            $data['title'] = 'Create New Students';
            $data['sn'] = 1;
            $data['mode'] = 'create';
            $data['classes'] = Classes::all()->groupBy('class_id');
            return view('admin.student.create', $data);
        }
    }


    public function create_bulk(Request $request)
    {
        $rules = array(
            'bulk_student' => ['required', 'max:5000', 'mimes:csv,xls,xlsx'],
            'bulk_class' => ['required']
        );
        $fieldNames = array(
            'bulk_student'   => 'Student Upload File',
            'bulk_class' => 'Class'
        );
        //dd($request->all());
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);
        if ($validator->fails()) {
            Session::flash('warning', 'Please check the form again!');
            return back()->withErrors($validator)->withInput();
        } else {
            try {
                $request->session()->put('bulk_class', $request->bulk_class);
                Excel::import(new UsersImport, request()->file('bulk_student'));
                $this->check_student();
                Session::flash('success', 'Student Uploaded Successfully');
                $request->session()->forget('bulk_class');
                return redirect('admin/students');
            } catch (\Throwable $th) {
                Session::flash('error', $th->getMessage());
                return \back();
            }
        }
    }

    public function edit($id)
    {
        try {
            $data['student'] = User::where(['id' => $id, 'role' => 'Student'])->first();
            $data['title'] = 'Edit Student';
            $data['sn'] = 1;
            $data['mode'] = 'edit';
            $data['classes'] = Classes::all()->groupBy('class_id');
            return view('admin.student.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function block($id)
    {
        try {
            $check = User::where(['id' => $id, 'role' => 'Student', 'status' => 'Active'])->first();
            $check->status = 'Blocked';
            $check->save();
            Session::flash('success', 'Student Blocked Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function unblock($id)
    {
        try {
            $check = User::where(['id' => $id, 'role' => 'Student', 'status' => 'Blocked'])->first();
            $check->status = 'Active';
            $check->save();
            Session::flash('success', 'Student Unblocked Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function delete($id)
    {
        try {
            $teacher = User::where(['id' => $id, 'role' => 'Student'])->first();
            $teacher->delete();
            Session::flash('success', 'Student Deleted Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function check_student()
    {
        $check = User::where('role', 'Student')->get();
        foreach ($check as $students) {
            $chk = Result::where('student_id', $students->email)->get();
            if ($chk->count() < 1) {
                $class = Classes::where('class_id', $students->class_id)->get();
                foreach ($class as $subject) {
                    $this->create_new_result->create($subject, $students->email);
                }
            } elseif ($chk->count() > 0) {
                $subjects = Classes::where('class_id', $students->class_id)->pluck('subject_id');
                $chk_std = Result::where('student_id', $students->email)->pluck('subject_id');
                $subject_id = json_decode($subjects);
                $chk_std = json_decode($chk_std);
                $different = array_diff($subject_id, $chk_std);
                if ($different != null) {
                    foreach ($different as $diff) {
                        $subjects = Classes::where('subject_id', $diff)->get();
                        $this->create_new_result->update_now($subjects, $students->email);
                    }
                }
            }
        }
    }
}
