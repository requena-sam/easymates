<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('pages.profile.show', [
            'user' => Auth::user()
        ]);
    }
}
