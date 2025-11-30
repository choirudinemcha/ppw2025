<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy as Job;
use App\Imports\JobsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function edit()
    {
        return view('jobs.edit');
    }

    public function show()
    {
        return view('jobs.show');
    }

    public function adminIndex()
    {
        return "Halaman Admin - Kelola Lowongan Kerja";
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'company' => 'required',
            'logo' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'company' => $request->company,
            'salary' => $request->salary,
            'logo' => $logoPath
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil ditambahkan');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,csv']);
        Excel::import(new JobsImport, $request->file('file'));
        return back()->with('success', 'Data lowongan berhasil diimport');
    }
}
