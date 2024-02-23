<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\RouteService;

class DefaultController extends Controller
{
    public function __invoke(RouteService $routeService, ...$args)
    {
        $data = $routeService->getModelsFromSlugs($args);
        $data['resource'] = $data['category'] ?? $data['page'] ?? null;

        if (!$routeService->validateModelsHierarchy($data) || !$data['resource']) {
            abort(404);
        }

        $view = $data['resource']->view ?? config('route.default_view');

        if (isset($data['resource']->action) && class_exists($data['resource']->action)) {
            // Делегируем обработку запроса
            return (new $data['resource']->action)($data);
        }

        return view($view, $data);
    }
}
