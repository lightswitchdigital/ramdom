<?php

namespace App\Http\Controllers\Admin\Editor;

use App\Http\Controllers\Controller;
use App\Models\Projects\Purchase\PurchaseAttribute;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttributesController extends Controller
{

    public function index()
    {
        $attributes = PurchaseAttribute::all();

        return view('admin.editor.attributes.index', compact('attributes'));
    }


    public function create()
    {
        $types = PurchaseAttribute::typesList();

        return view('admin.editor.attributes.create', compact( 'types'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255', Rule::in(array_keys(PurchaseAttribute::typesList()))],
            'variants' => ['nullable', 'string'],
            'sort' => ['required', 'integer'],
        ]);

        $attribute = PurchaseAttribute::create([
            'name' => $request['name'],
            'type' => $request['type'],
            'variants' => array_map('trim', preg_split('#[\r\n]+#', $request['variants'])),
            'sort' => $request['sort'],
        ]);

        return redirect()->route('admin.editor.attributes.show', $attribute);
    }


    public function show(PurchaseAttribute $attribute)
    {
        return view('admin.editor.attributes.show', compact('attribute'));
    }


    public function edit(PurchaseAttribute $attribute)
    {
        $types = PurchaseAttribute::typesList();

        return view('admin.editor.attributes.edit', compact( 'attribute', 'types'));
    }


    public function update(Request $request, PurchaseAttribute $attribute)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'type' => ['required', 'string', 'max:255', Rule::in(array_keys(PurchaseAttribute::typesList()))],
            'required' => 'nullable|string|max:255',
            'variants' => 'nullable|string',
            'sort' => 'required|integer',
        ]);

        $attribute->update([
            'name' => $request['name'],
            'type' => $request['type'],
            'required' => (bool)$request['required'],
            'variants' => array_map('trim', preg_split('#[\r\n]+#', $request['variants'])),
            'sort' => $request['sort'],
        ]);

        return redirect()->route('admin.editor.attributes.show', $attribute);
    }


    public function destroy(PurchaseAttribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('admin.editor.attributes.index');
    }
}
