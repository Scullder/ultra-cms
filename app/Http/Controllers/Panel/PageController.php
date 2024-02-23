<?php

namespace App\Http\Controllers\Panel;

use App\Models\Page;
use App\Models\Slug;
use App\Models\Category;
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
        dd($request->all());

        $page = Page::create($request->only([
            'name',
            'slug',
        ]));

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
        $categories = Category::all();

        return view('panel/page/edit', compact(['page', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->only([
            'slug', 
            'name',
            'categories',
        ]));

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
