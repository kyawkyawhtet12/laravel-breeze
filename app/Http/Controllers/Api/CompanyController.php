<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use File;


class CompanyController extends Controller
{
    //List
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies, 200);
    }

    //Create
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:companies,email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website' => 'nullable|url',
        ]);

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
        ]);

        if ($request->hasFile('logo')) {

            $directoryPath = storage_path('app/public/logos/');

            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0775, true, true);
            }

            $image = Image::read($request->file('logo'));
            $filename = time() . '.' .$request->file('logo')->getClientOriginalExtension();

            $path = $directoryPath . $filename;

            $image->resize(100, 100)->save($path);

            $company->logo = '/storage/logos/' . $filename;

        }

        $company->save();

        return response()->json($company, 201);
    }

    //Detail
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return response()->json($company);
    }

    //Update
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:companies,email,' . $company->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website' => 'nullable|url',
        ]);


        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
        ]);

        if ($request->hasFile('logo')) {
            if ($company->logo && file_exists(public_path($company->logo))) {
                unlink(public_path($company->logo));
            }

            $directoryPath = storage_path('app/public/logos/');

            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0775, true, true);
            }

            $image = Image::read($request->file('logo'));
            $filename = time() . '.' .$request->file('logo')->getClientOriginalExtension();

            $path = $directoryPath . $filename;

            $image->resize(100, 100)->save($path);

            $company->logo = '/storage/logos/' . $filename;
        }

        $company->save();

        return response()->json($company);
    }

    //Delete
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        // Delete logo if exists
        if ($company->logo && file_exists(public_path($company->logo))) {
            unlink(public_path($company->logo));
        }

        $company->delete();

        return response()->json(['message' => 'Company deleted successfully'], 200);
    }
}
