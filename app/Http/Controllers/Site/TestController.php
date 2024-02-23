<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function __invoke($data)
    {
        return view('site/test', $data);
    }
}
