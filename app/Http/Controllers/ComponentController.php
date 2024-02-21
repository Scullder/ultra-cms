<?php

namespace App\Http\Controllers;

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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
