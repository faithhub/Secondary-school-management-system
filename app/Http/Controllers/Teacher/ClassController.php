<?php

namespace App\Http\Controllers\Teacher;

use App\Exports\ResultExport;
use App\Http\Controllers\Controller;
use App\Imports\ResultImport;
use App\Models\Classes;
use App\Models\Result;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
    }
    public function index()
    {
        $this->check_student();
        try {
            $data['sn'] = 1;
            $data['title'] = 'Class';
            $data['classes'] = $class = Classes::where('subject_id', Auth::user()->class_id)->get()->groupBy('name');
            $data['subject'] = Subject::find(Auth::user()->class_id);
            return view('teacher.class.index', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function view($id)
    {
        $this->check_student();
       try {
            $data['sn'] = 1;
            $data['class'] = $class = Classes::where(['subject_id' => Auth::user()->class_id, 'class_id' => $id])->first();
            $data['subject'] = Subject::find(Auth::user()->class_id);
            $data['students'] = $students = User::where(['role' => 'Student', 'class_id' => $class->class_id])->get();


            $data['users'] = $users = DB::table('users')
            ->join('results', 'results.student_id', '=', 'users.email')
            ->where('users.class_id', $id)
            ->where('results.subject_id', Auth::user()->class_id)
            ->select('results.*', 'users.*')
            ->get();


            //dd($users);

            //dd($students);
            return view('teacher.class.view', $data);
       } catch (\Throwable $th) {
        Session::flash('error', $th->getMessage());
        return \back();
       }
    }

    public function edit(Request $request)
    {
        try {
            $rules = array(
                'first_test' => ['numeric', 'max:100'],
                'second_test' => ['numeric', 'max:100'],
                'exam' => ['numeric', 'max:100'],
            );
            $fieldNames = array(
                'first_test'     => 'First Test',
                'second_test'     => 'Second Test',
                'exam'     => 'Exam Score',
            );
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);
            if ($validator->fails()) {
                Session::flash('warning', 'Please check the Scores and try again, only numbers characters are allow!');
                return back()->withErrors($validator)->withInput();
            }else{
                $update = Result::where(['class_id' => $request->class_id, 'subject_id' => $request->subject_id, 'student_id' => $request->student_id])->first();
                $update->first_test = $request->first_test;
                $update->second_test = $request->second_test;
                $update->exam = $request->exam;
                $update->save();
                Session::flash('success', 'Student\'s Result Updated Successfully');
                return \back();
            }
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
            if($chk->count() < 1){
                $class = Classes::where('class_id', $students->class_id)->get();
                foreach ($class as $subject) {
                    $this->create_new_result->create($subject, $students->email);
                }
            }else{
                $subjects = Classes::where('class_id', $students->class_id)->pluck('subject_id');
                $chk_std = Result::where('student_id', $students->email)->pluck('subject_id');
                $subject_id = json_decode($subjects);
                $chk_std = json_decode($chk_std);
                $different = array_diff($subject_id,$chk_std);
                if ($different != null) { 
                    foreach ($different as $diff) {
                        $subjects = Classes::where('subject_id', $diff)->get();
                        $this->create_new_result->update_now($subjects, $students->email);
                    }               
                }
            }
        }
    }

    public function exportdata($id)
    {
        Session::put('class', $id);
        $class = Classes::where('class_id', $id)->first();
        $subject = Subject::find(Auth::user()->class_id);
        $title = $class->name.' '.$subject->name.' Result Excel Format';
        return Excel::download(new ResultExport(), $title.'.xlsx');
    }

    public function exportdatapdf($id)
    {
        Session::put('class', $id);
        $class = Classes::where('class_id', $id)->first();
        $subject = Subject::find(Auth::user()->class_id);
        $title = $class->name.' '.$subject->name.' Result Excel Format';
        return Excel::download(new ResultExport(), $title.'.xls');
    }

    public function importresult(Request $request)
    {
        $rules = array(
            'students_result' => ['required', 'max:5000', 'mimes:xlsx'],
        );
        $fieldNames = array(
            'students_result'   => 'Student Upload File',
        );
        //dd($request->all());
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);
        if ($validator->fails()) {
            Session::flash('warning', 'Please check the form, the file must be in xlsx format only, try again!');
            return back()->withErrors($validator)->withInput();
        } else {
            try {
                $request->session()->put('class_id', $request->class_id);
                Excel::import(new ResultImport, request()->file('students_result'));
                Session::flash('success', 'Student Result Uploaded Successfully');
                $request->session()->forget('bulk_class');
                return back();
            } catch (\Throwable $th) {
                Session::flash('error', $th->getMessage());
                return \back();
            }
        }
    }

    public function download_pdf($id)
    {
         $students = DB::table('users')
         ->join('results', 'results.student_id', '=', 'users.email')
         ->where('users.class_id', $id)
         ->where('results.subject_id', Auth::user()->class_id)
         ->select('results.*', 'users.*')
         ->get();
         $sn = 1;
        $subject = Subject::where('id', Auth::user()->class_id)->first();
        $pdf = App::make('dompdf.wrapper');
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf->loadView('result2', compact(['students', 'sn', 'subject']));
        return $pdf->download(Auth::user()->surname.' '.Auth::user()->last_name.' '.$subject->name.' result.pdf');
    }
}
