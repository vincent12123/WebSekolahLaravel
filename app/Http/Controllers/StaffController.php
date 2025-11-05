<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::orderBy('display_order')->get();
        return view('staff.index', compact('staff'));
    }
}
