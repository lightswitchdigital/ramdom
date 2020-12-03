<?php

namespace App\Http\Controllers\Admin\Projects;

use App\Http\Controllers\Controller;
use App\Models\Projects\Attribute;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttributesController extends Controller
{

    public function index() {
        $attributes = Attribute::all();

        return view('admin.projects.attributes.index', compact('attributes'));
    }

    public function create() {

        $types = Attribute::typesList();

        return view('admin.projects.attributes.create', compact( 'types'));
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255', Rule::in(array_keys(Attribute::typesList()))],
            'variants' => ['nullable', 'string'],
            'sort' => ['required', 'integer'],
        ]);

        $attribute = Attribute::create([
            'name' => $request['name'],
            'type' => $request['type'],
            'variants' => array_map('trim', preg_split('#[\r\n]+#', $request['variants'])),
            'sort' => $request['sort'],
        ]);

        return redirect()->route('admin.projects.attributes.show', $attribute);
    }

    public function show(Attribute $attribute)
    {
        return view('admin.projects.attributes.show', compact('attribute'));
    }

    public function edit(Attribute $attribute)
    {
        $types = Attribute::typesList();

        return view('admin.projects.attributes.edit', compact( 'attribute', 'types'));
    }

    public function update(Request $request, Attribute $attribute)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'type' => ['required', 'string', 'max:255', Rule::in(array_keys(Attribute::typesList()))],
            'required' => 'nullable|string|max:255',
            'variants' => 'nullable|string',
            'sort' => 'required|integer',
        ]);

        Attribute::findOrFail($attribute->id)->update([
            'name' => $request['name'],
            'type' => $request['type'],
            'required' => (bool)$request['required'],
            'variants' => array_map('trim', preg_split('#[\r\n]+#', $request['variants'])),
            'sort' => $request['sort'],
        ]);

        return redirect()->route('admin.projects.attributes.show', $attribute);
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('admin.projects.attributes.index');
    }
}
