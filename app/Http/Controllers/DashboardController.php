<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.dashboard.index');
    }

    public function reports()
    {
        return view('admin.dashboard.reports')
            ->withItems(Report::all());
    }
}
