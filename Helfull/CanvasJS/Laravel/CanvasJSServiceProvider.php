<?php
namespace Helfull\CanvasJS\Laravel;

use Illuminate\Support\ServiceProvider;

class CanvasJSServiceProvider extends ServiceProvider {

    public function register() {    }
    public function boot() {
        $this->loadViewsFrom(__DIR__.'/../Views', 'canvasjs');
    }
}