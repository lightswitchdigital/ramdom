<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{

    public function index()
    {
        $faq = FAQ::all();

        return view('admin.faq.index', compact('faq'));
    }


    public function create()
    {
        return view('admin.faq.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string']
        ]);

        $faq = FAQ::create([
            'question' => $request['question'],
            'answer' => $request['answer']
        ]);

        return redirect()->route('admin.faq.show', $faq);
    }


    public function show(FAQ $faq)
    {
        return view('admin.faq.show', compact('faq'));
    }


    public function edit(FAQ $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }


    public function update(Request $request, FAQ $faq)
    {
        $this->validate($request, [
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string']
        ]);

        $faq->update($request->all());

        return redirect()->route('admin.faq.show', $faq);
    }


    public function destroy(FAQ $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faq.index');
    }
}
