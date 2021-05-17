<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerRequestRelationMarco();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    public function registerRequestRelationMarco(): void
    {
        Request::macro('relations', function (array $allows = []) {
            $request = \request();

            if ($request->has('with')) {
                $relations = \array_filter(\array_map('trim', \explode(';', $request->get('with'))));

                if (!empty($allows)) {
                    return \array_intersect($allows, $relations);
                }

                return $relations;
            }

            return [];
        });
    }
}
