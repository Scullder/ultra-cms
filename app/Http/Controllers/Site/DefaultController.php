<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\RouteService;

class DefaultController extends Controller
{
    public function __invoke(RouteService $routeService, ...$args)
    {
        $models = $routeService->getModelsFromSlugs($args);

        if (!$routeService->validateModelsHierarchy($models)) {
            abort(404);
        }

        //dd($models);

        return view('site/default', $models);
    }
}
