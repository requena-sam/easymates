<?php

namespace App\Http\Controllers;

class DashboardController
{
    public function index()
    {
        return view('pages.dashboard.index');
    }

}
