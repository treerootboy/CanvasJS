<?php

namespace Helfull\CanvasJS;

use Helfull\CanvasJS\Chart\ChartData;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use View;

class Chart extends Collection implements Renderable {

	protected $id = 'chart';
	protected $options = [];

	public function __construct($opt = []) {
		$options['chart'] = $opt;
		parent::__construct($options);
		$this->resolveID();
	}

	public function addData(ChartData $chartData) {
		$data = $this->getData();
		array_push($data, $chartData);
		$this->setData($data);
		return $this;
	}

	public function getData() {
		return $this->get('data') ?: [];
	}

	public function setData($data) {
		$this->put('data', $data);
	}

	public function getChart() {
		return json_encode($this->get('chart'));
	}

	protected function resolveID() {
		if (!$this->has('id')) {
			$this->id = $this->generateID();
		} else {
			$this->id = $this->pull('id');
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

	public function render($jquery = false) {
		$chart = $this;

		$view = $jquery ? 'chartjquery' : 'chart';

		return View::make('canvasjs::' . $view, ['chart' => $this]);
	}
}