<?php
namespace Helfull\CanvasJS\Laravel\Provider;

use Illuminate\Support\ServiceProvider;

class CanvasJSServiceProvider extends ServiceProvider {

	public function register() {

		$this->loadViewsFrom(__DIR__ . '/../../Views', 'canvasjs');
		
	}
}
