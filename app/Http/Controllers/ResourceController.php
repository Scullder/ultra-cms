<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function __invoke()
    {
        echo "Hello, there!";
    }
}