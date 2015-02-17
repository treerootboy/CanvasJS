<?php
namespace Helfull\CanvasJS\Laravel\Provider;

use Blade;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class CanvasJSServiceProvider extends ServiceProvider {

	public function register() {

		$this->loadViewsFrom(__DIR__ . '/../../Views', 'canvasjs');

		$this->extendBlade();

		//$this->registerRoutes();
	}

	protected function extendBlade() {
		$this->extendBladeChart();
	}

	protected function extendBladeChart() {

		Blade::extend(function ($view, $compiler) {
			$patter = "/(?<!\w)(\s*)@chart\s*\((.*)\)/";
			return preg_replace($patter, '$1<?php echo $2->render(); ?>', $view);
		});

	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function registerRoutes() {
		require __DIR__ . '/../http/routes.php';
	}
}