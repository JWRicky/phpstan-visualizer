<?php

namespace JWRicky\PhpStanVisualizer;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class PhpStanVisualizerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/phpstan-visualizer.php', 'phpstan-visualizer');
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'phpstan-visualizer');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/phpstan-visualizer.php' => config_path('phpstan-visualizer.php'),
            ], 'phpstan-visualizer-config');
        }

        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        Route::middleware(['web'])
            ->group(function () {
                Route::get('/phpstan', [\JWRicky\PhpStanVisualizer\Http\Controllers\PhpStanVisualizerController::class, '__invoke']);
            });
    }
}