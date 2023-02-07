<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanRequest;
use Illuminate\Http\Request;

class LoansController extends Controller
{

    public function index()
    {
        $loans = LoanRequest::orderBy('id', 'desc')->get();

        return view('admin.loans.index', compact('loans'));
    }

    public function show(LoanRequest $loan)
    {
        return view('admin.loans.show', compact('loan'));
    }

    public function destroy(LoanRequest $loanRequest)
    {
        //
    }
}
