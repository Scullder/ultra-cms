<?php

namespace App\Http\Controllers\Panel;

use App\Models\Page;
use App\Models\Slug;
use App\Models\Category;
use App\Services\UploadService;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;

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
        $page->loadComponents();

        //dd($page);

        //dd($page->components[1]->toArray());

        return view('panel/page/edit', compact(['page']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page, UploadService $uploadService)
    {
        //dd($request->validated());

        $validated = $request->validated();

        foreach ($request->file('components') as $i => $component) {
            foreach ($component as $j => $field) {
                if ($request->file("components.{$i}.{$j}")->isValid()) {
                    $validated['components'][$i][$j] = $field->store("/pages/{$page->id}"); 
                }
            }
        }

        dd($validated);

        $page->update($validated);

        die;

        Slug::where('model_id', $page->id)
            ->where('model', Page::class)
            ->delete();

        Slug::create([
            'slug' => $request->slug,
            'model_id' => $page->id,
            'model' => Page::class,
            'prefix' => '',
            'postfix' => '',
        ]);

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
