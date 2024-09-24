<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $companies = Company::get();
        $employees = Employee::get();
        $user = Auth::user();

        return view('dashboard',['companies'=>$companies, 'employees'=>$employees, 'user' => $user]);
    }
}
