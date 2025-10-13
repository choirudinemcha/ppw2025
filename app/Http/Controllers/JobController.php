<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return "Daftar Lowongan Kerja";
    }

    public function adminIndex()
    {
        return "Halaman Admin - Kelola Lowongan Kerja";
    }
}
