<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advice;
use Illuminate\Http\Request;

class AdviceController extends Controller
{

    public function index()
    {
        $advice = Advice::paginate(env('ADMIN_PAGINATION'));

        return view('admin.advice.index', compact('advice'));
    }


    public function show(Advice $advice)
    {
        return view('admin.advice.show', compact('advice'));
    }

    public function create() {
        return view('admin.advice.create');
    }

    public function store(Request $request) {

        $this->validate($request, [

        ]);

        $advice = Advice::create([
            'title' => $request['title'],
            'content' => $request['content'],

        ]);
        $advice->image()->create([
            'file' => $request['image']->store('advice', 'public')
        ]);

        return redirect()->route('admin.advice.show', $advice);
    }


    public function edit(Advice $advice)
    {
        return view('admin.advice.edit', compact('advice'));
    }


    public function update(Request $request, Advice $advice)
    {
        $this->validate($request, [

        ]);

        $advice->update($request->all());
        if ($request['image']) {
            $advice->image()->delete();
            $advice->image()->create([
                'file' => $request['image']->store('advice', 'public')
            ]);
        }

        return redirect()->route('admin.advice.show', $advice);
    }


    public function destroy(Advice $advice)
    {
        $advice->delete();

        return redirect()->route('admin.advice.index')
            ->with('success', 'Комментарий успешно удален.');
    }
}
