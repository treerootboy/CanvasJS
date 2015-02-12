<?php

namespace Helfull\CanvasJS;

use Helfull\CanvasJS\Chart\ChartData;
use Illuminate\Support\Collection;
use View;

class Chart extends Collection {

	public function __construct($opt = []) {
		$options['chart'] = $opt;
		parent::__construct($options);
		$this->resolveID();
	}

	public function addData(ChartData $chartData) {
		return $this->getData()->push($chartData);
	}

	public function getData() {
		return $this->get('data') ?: [];
	}

	public function setData($data) {
		$this->put('data', $data);
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

	public function toArray() {
		$arr['id'] = $this->id;
		$arr['chart'] = parent::toArray();
		return $arr;
	}

	public function toString() {
		return $this->toJson();
	}

	public function render() {

		$view = false ? 'chartjquery' : 'chart';

		return view('canvasjs::' . $view, ['chart' => $this]);
	}
}