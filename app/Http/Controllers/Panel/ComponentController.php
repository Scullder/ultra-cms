<?php

namespace App\Http\Controllers\Panel;

use App\Models\Component;
use App\Models\Field;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComponentRequest;

class ComponentController extends Controller
{
    public function index()
    {   
        //return view('constructor/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel/component/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComponentRequest $request)
    {
        $component = Component::create($request->validated());

        return redirect()->route('components.edit', ['component' => $component->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Component $component)
    {   
        return view('panel/component/edit', ['cmpnt' => $component]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComponentRequest $request, Component $component)
    {
        $component->update($request->validated());
        
        $fields = [];
        $component->fields()->delete();

        foreach ($request->fields as $requestField) {
            $field = new Field;
            
            foreach ($requestField as $key => $value) {
                $field->{$key} = $value;
            }

            $field->save();
            $fields[] = $field;
        }

        $component->fields()->saveMany($fields);

        return redirect()->route('components.edit', ['component' => $component->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
