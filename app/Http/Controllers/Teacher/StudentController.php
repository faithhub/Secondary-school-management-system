<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
    }
    public function index()
    {
        $data['class'] = $class = Classes::find(Auth::user()->class_id);
        $data['students'] = User::where(['role' => 'Student', 'class_id' => $class->id])->get();
        $data['cla'] = json_decode($class->subject);
        $data['subjects'] = Subject::all();
        return view('teacher.students.index', $data);
    }
}
