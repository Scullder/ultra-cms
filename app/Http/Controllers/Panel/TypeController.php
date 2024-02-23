<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    private $types = [
        'input',
        'text',
        'file',
    ];

    private $typesPath = 'panel/component/type';

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

    public function create(Request $request)
    {
        if (!$request->has('type')) {
            return response('', 400);
        }

        $uid = Str::random(15);

        return view("{$this->typesPath}/constructor/{$request->type}", ['uid' => $uid]);
    }
}
