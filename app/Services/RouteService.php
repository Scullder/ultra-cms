<?php

namespace App\Services;

use App\Models\Slug;
use Illuminate\Support\Str;

class RouteService
{
    public static function buildPath(string $inputPath)
    {
        $routePath = [];
        $duplicates = [];

        foreach (explode('/', $inputPath) as $part) {
            if (!$part) {
                continue;
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
        $models = [];
        $duplicates = [];

        foreach ($slugs as $modelSlug) {
            $slug = Slug::where('slug', $modelSlug)->first();
            
            if (!$slug) {
                throw new \Exception('Параметра ' . $modelSlug . ' нет в базе данных!');
            }
            
            $modelName = (string) Str::of($slug->model)->afterLast('\\')->lower();
            
            $duplicates[$modelName] = isset($duplicates[$modelName])
                ? $duplicates[$modelName] + 1
                : 1;

            $modelKey = Str::camel(Str::repeat('sub_', $duplicates[$modelName] - 1) . $modelName);

            $models[$modelKey] = call_user_func([$slug->model, 'find'], $slug->model_id);
        }

        return $models;
    }

    public function validatePathHierarchy(string $path)
    {

    }

    public function validateModelsHierarchy(array $models)
    {
        return true;
    }
}