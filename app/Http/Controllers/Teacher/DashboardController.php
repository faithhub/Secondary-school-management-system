<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Result;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
    }
    public function index()
    {
        $data['title'] = Auth::user()->surname.' '.Auth::user()->last_name;
        $data['subject'] = $sub = Subject::find(Auth::user()->class_id);
        $data['number_of_student'] = Result::where('subject_id', $sub->id)->count();
        $data['users'] = $users = DB::table('users')
            ->join('results', 'results.student_id', '=', 'users.email')
            ->where('results.subject_id', Auth::user()->class_id)
            ->select('results.*', 'users.*')
            ->limit(5)
            ->get();
        return view('teacher.dashboard.index', $data);
    }
}
