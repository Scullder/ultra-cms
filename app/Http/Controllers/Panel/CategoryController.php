<?php

namespace App\Http\Controllers\Panel;

use App\Models\Category;
use App\Models\Slug;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
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
        $categories = Category::all();
        $response = '';

        foreach ($categories as $category) {
            $response .= view('components/select/option', [
                'selectSelectedSelector' => $request->selectSelectedSelector ?? '',
                'selectOptionsName' => $request->selectOptionsName ?? 'categories',
                'value' => $category->id,
                'label' => $category->name,
            ]);
        }

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel/category/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->only([
            'name',
            'slug',
        ]));

        return redirect()->route('categories.edit', ['category' => $category->id]);
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
    public function edit(Category $category)
    {
        return view('panel/category/edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->only([
            'slug', 
            'name'
        ]));

        Slug::create([
            'slug' => $request->slug,
            'model_id' => $category->id,
            'model' => Category::class,
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
