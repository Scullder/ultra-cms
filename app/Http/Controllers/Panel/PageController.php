<?php

namespace App\Http\Controllers\Panel;

use App\Models\Page;
use App\Models\Slug;
use App\Models\Category;
use App\Services\UploadService;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function select(Request $request)
    {
        //dd($request->all());
        $pages = Page::all();
        $response = '';

        foreach ($pages as $page) {
            $response .= view('components/select/option', [
                'selectSelectedSelector' => $request->selectSelectedSelector ?? '',
                'selectOptionsName' => $request->selectOptionsName ?? 'pages',
                'value' => $page->id,
                'label' => $page->name,
            ]);
        }

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel/page/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $page = Page::create($request->validated());

        return redirect()->route('pages.edit', ['page' => $page->id]);
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
    public function edit(Page $page)
    {
        //dd($page->components['photos']['fields']['photo']['value']);

        //$link = Storage::url($page->components['photos']['fields']['photo']['value']);
        //$link = asset('storage/' . $page->components['photos']['fields']['photo']['value']);
        //dd($link);

        //dd($page->components[0]->toArray());

        return view('panel/page/edit', compact(['page']));
    }

    /**
     * Update the specified resource in storage.
     * 
     * {
     *  components:
     *      componentCode1:
     *          fields:
     *              fieldCode1: 
     *                  value: 'value'
     *              fieldCode2: 
     *                  value: 'value'
     * }
     * 
     */
    public function update(PageRequest $request, Page $page)
    {
        $validated = $request->validated();
        
        //dd($validated);

        // TODO: use trait or service
        // TODO: component is Array?
        // TODO: delete old files if null
        foreach ($request->file('components') as $componentCode => $component) {
            foreach ($component['fields'] as $fieldCode => $field) {
                if ($request->file("components.{$componentCode}.fields.{$fieldCode}.value")->isValid()) {
                    $validated['components'][$componentCode]['fields'][$fieldCode]['value'] = $field['value']->store("/pages/{$page->id}"); 
                }
            }
        }

        $page->update($validated);

        Slug::updateOrCreate(
            ['model_id' => $page->id, 'model' => Page::class],
            ['slug' => $request->slug, 'prefix' => '', 'postfix' => '']
        );

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
