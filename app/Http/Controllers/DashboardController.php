<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use Auth;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $c_search = $request->input('company_search');
        $e_search = $request->input('employee_search');

        $companies = Company::when($c_search, function ($query, $c_search) {
            return $query->where('name', 'like', "%{$c_search}%")
                         ->orWhere('email', 'like', "%{$c_search}%")
                         ->orWhere('website', 'like', "%{$c_search}%");
        })->paginate(10);

        $employees = Employee::when($e_search, function ($query, $e_search) {
            return $query->where('name', 'like', "%{$e_search}%")
                         ->orWhere('email', 'like', "%{$e_search}%")
                         ->orWhere('phone', 'like', "%{$e_search}%");
        })->paginate(10);

        $user = Auth::user();

        return view('dashboard', [
            'companies' => $companies,
            'employees' => $employees,
            'user' => $user,
            'company_search' => $c_search,
            'employee_search' => $e_search,
        ]);
    }

}
