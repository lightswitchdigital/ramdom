<?php

namespace App\Http\Controllers\Admin\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function index() {
        return view('admin.editor.index');
    }
}
