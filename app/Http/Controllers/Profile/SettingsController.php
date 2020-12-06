<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index() {
        $user = Auth::user();

        return view('profile.settings.index', compact('user'));
    }
}
