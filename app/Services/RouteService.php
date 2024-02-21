<?php

namespace App\Services;

use App\Models\Slug;

class RouteService
{
    public static function buildPath(string $inputPath)
    {

        $routePath = [];

        foreach (explode('/', $inputPath) as $part) {
            if (!$part) {
                continue;
            }

            $slug = Slug::where('slug', $part)->get();
            dd($slug);
        }

        dd($inputPath);
    }

    public static function getController(string $inputPath)
    {

    }
}