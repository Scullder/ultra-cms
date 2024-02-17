<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConstructorTypesController extends Controller
{
    private $types = [
        'input',
        'text',
        'file',
    ];

    private $typesPath = 'constructor/types';

    /**
     * Получение списка всех существующих типов
     */
    public function index()
    {
        return view("{$this->typesPath}/index", [
            'typesPath' => $this->typesPath,
            'types' => $this->types,
        ]);
    }

    public function select(Request $request)
    {
        if (!$request->has('type')) {
            return response('', 400);
        }

        return view("{$this->typesPath}/{$request->type}");
    }
}
