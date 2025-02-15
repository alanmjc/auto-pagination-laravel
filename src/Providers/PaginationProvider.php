<?php

namespace MyPackagistPackage\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class PaginationProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot()
    {
        static $paginationApplied = false;
        $models = $this->getModels();

        foreach ($models as $model) {
            $model::addGlobalScope('force-pagination', function (Builder $builder) use (&$paginationApplied, $model) {
                if (!$paginationApplied && request()->has('page')) {
                    $paginationApplied = true;
                    $page = request('page', 1);
                    $perPage = request('per_page', 10);

                    if (!$builder->getQuery()->limit) {
                        $paginatedResponse = $builder->paginate($perPage, ['*'], 'page', $page);
                        app()->instance('paginated_response', $paginatedResponse);
                    }
                }
            });
        }
    }

    protected function getModels()
    {
        $models = [];
        $path = app_path('Models');
        if (!is_dir($path)) {
            return $models;
        }

        $namespace = 'App\\Models\\';
        $files = $this->getAllPhpFiles($path);

        foreach ($files as $file) {
            $relativePath = str_replace($path . DIRECTORY_SEPARATOR, '', $file);
            $class = $namespace . str_replace([DIRECTORY_SEPARATOR, '.php'], ['\\', ''], $relativePath);
            if (class_exists($class) && is_subclass_of($class, Model::class)) {
                $models[] = $class;
            }
        }

        if (app()->environment('production')) {
            return Cache::rememberForever('app_models', function () use ($models) {
                return $models;
            });
        }

        return $models;
    }

    protected function getAllPhpFiles($directory)
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory));
        $phpFiles = [];
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $phpFiles[] = $file->getPathname();
            }
        }
        return $phpFiles;
    }
}