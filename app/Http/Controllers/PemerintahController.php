<?php

namespace App\Http\Controllers;

use App\Models\Official;

class PemerintahController extends Controller
{
    public function index()
    {
        $officials = Official::all();

        return view('pages.pemerintah', compact('officials'));
    }
}
