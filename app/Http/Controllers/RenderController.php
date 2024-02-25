<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RenderController extends Controller
{
    public function getSelected(Request $request)
    {
        //dd($request->all());
        return view('components/select/selected', $request->only([
            'selectOptionName',
            'value',
            'label',
        ]));
    }
}
