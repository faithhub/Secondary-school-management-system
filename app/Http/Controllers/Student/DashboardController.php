<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }

    public function index()
    {
        $data['title'] = 'My Dashboard';
        $data['class'] = Classes::where('class_id', Auth::user()->class_id)->first();
        $data['subjects'] = $subjects = DB::table('users')
            ->join('results', 'results.student_id', '=', 'users.email')
            ->join('subjects', 'subjects.id', '=', 'results.subject_id')
            ->where('users.email', Auth::user()->email)
            ->where('results.student_id', Auth::user()->email)
            ->select('results.*', 'users.*', 'subjects.*')
            ->get();
        return view('student.dashboard.index', $data);
    }
}
