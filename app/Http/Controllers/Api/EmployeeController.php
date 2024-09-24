<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use File;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('company')->get();
        return response()->json($employees, 200);
    }

    public function store(Request $request)
    {

        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_id' => 'required|exists:companies,id',
        ]);

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_id' => $request->company_id,
        ]);



        if ($request->hasFile('profile')) {

            $directoryPath = storage_path('app/public/profiles/');

            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0775, true, true);
            }

            $image = Image::read($request->file('profile'));
            $filename = time() . '.' . $request->file('profile')->getClientOriginalExtension();


            $path =  $directoryPath . $filename;

            $image->resize(100, 100)->save($path);

            $employee->profile = '/storage/profiles/' . $filename;
        }

        $employee->save();

        return response()->json($employee, 201);
    }

    public function show($id)
    {
        $employee = Employee::with('company')->findOrFail($id);
        return response()->json($employee);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        // dd($employee);
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,',
            'phone' => 'required',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_id' => 'required|exists:companies,id',
        ]);

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_id' => $request->company_id,
        ]);

        if ($request->hasFile('profile')) {
            if ($employee->profile && file_exists(public_path($employee->profile))) {
                unlink(public_path($employee->profile));
            }

            $directoryPath = storage_path('app/public/profiles/');

            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0775, true, true);
            }

            $image = Image::read($request->file('profile'));
            $filename = time() . '.' . $request->file('profile')->getClientOriginalExtension();
            $path = $directoryPath . $filename;

            $image->resize(100, 100)->save($path);

            $employee->profile = '/storage/profiles/' . $filename;
        }

        $employee->save();

        return response()->json($employee);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee->profile && file_exists(public_path($employee->profile))) {
            unlink(public_path($employee->profile));
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }
}
