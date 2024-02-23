<?php

namespace App\Services;

use App\Models\Slug;
use Illuminate\Support\Str;

class RouteService
{
    public static function buildPath(string $inputPath): string
    {
        $routePath = [];
        $duplicates = [];

        foreach (explode('/', $inputPath) as $part) {
            if (!$part) {
                continue;
            }

            if ($part == config('route.panel_path')) {
                return '';
            }

            $slug = Slug::where('slug', $part)->first();

            if ($slug) {
                $routeModelName = (string) Str::of($slug->model)->afterLast('\\')->lower();

                $duplicates[$routeModelName] = isset($duplicates[$routeModelName])
                    ? $duplicates[$routeModelName] + 1
                    : 1;
    
                $part = '{' . Str::camel(Str::repeat('sub_', $duplicates[$routeModelName] - 1) . $routeModelName) . '}';
            }

            $routePath[] = $part;
        }

        return '/' . implode('/', $routePath);
    }

    public static function getPathAction(string $inputPath)
    {
        
    }

    public function getPathModels(string $path)
    {

    }

    public function getModelsFromSlugs(array $slugs)
    {
        $records = [];

        foreach ($slugs as $modelSlug) {
            $slug = Slug::where('slug', $modelSlug)->first();
            
            if (!$slug) {
                throw new \Exception("Параметр ссылки {$modelSlug} отсутствует в базе данных!");
            }
            
            $modelName = (string) Str::of($slug->model)->afterLast('\\')->lower();
            $record = call_user_func([$slug->model, 'find'], $slug->model_id);

            if (!$record) {
                throw new \Exception("Ресурс для записи {$modelName} {$slug->model_id} не найден!");
            }

            if (isset($records[$modelName])) {
                $records["{$modelName}_path"][] = $record;
            } else {
                $records[$modelName] = $record;
            }
        }

        return $records;
    }

    public function validatePathHierarchy(string $path)
    {

    }

    public function validateModelsHierarchy(array $models)
    {
        return true;
    }
}