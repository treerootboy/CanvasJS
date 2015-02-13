<?php

namespace Helfull\CanvasJS;

use Helfull\CanvasJS\Chart\ChartData;
use Helfull\CanvasJS\Chart\ChartPropertie;
use Illuminate\Support\Collection;
use View;

class Chart extends Collection {

	public function __construct($opt = []) {
		$options['chart'] = new ChartPropertie($opt);
		parent::__construct($options);
		$this->resolveID();
	}

	public function getPropertie($key) {
		return $this->get('chart')->get($key);
	}

	public function addData(ChartData $chartData) {
		dd($this);
		$this->getPropertie('data')->push($chartData);
		return $this;
	}

	public function getID() {
		return $this->get('id');
	}

	public function putAttribute(array $att) {
		return $this->getAttributes()->push($att);
	}

	public function getAttributes() {
		return $this->get('attributes');
	}

	public function getChart() {
		return json_encode($this->get('chart'));
	}

	protected function resolveID() {
		if (!$this->has('id')) {
			$this->put('id', $this->generateID());
		}
	}

	private function generateID() {
		return uniqid("Chart");
	}

	public function toString() {
		return $this->toJson();
	}

	public function render() {

		$view = false ? 'chartjquery' : 'chart';

		return view('canvasjs::' . $view, ['chart' => $this]);
	}
}