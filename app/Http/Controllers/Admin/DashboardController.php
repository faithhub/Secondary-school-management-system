<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $data['title'] = 'Admin Dashboard';
        $data['sn'] = 1;
        $data['classes'] = Classes::orderBy('id', 'desc')->take(5)->get()->groupBy('class_id');
        $data['classes_count'] = Classes::all()->groupBy('class_id')->count();
        $data['subjects_count'] = Subject::orderBy('id', 'desc')->get()->count();
        $data['students_count'] = User::where('role', 'Student')->get()->count();
        $data['teachers_count'] = User::where('role', 'Teacher')->get()->count();
        $data['subjects'] = Subject::orderBy('id', 'desc')->take(5)->get();
        $data['students'] = User::where('role', 'Student')->limit(5)->get();
        $data['teachers'] = User::where('role', 'Teacher')->limit(5)->get();
        $data['user_count'] = User::where(['role' => 'User'])->count();
        return view('admin.dashboard.index', $data);
    }
}
