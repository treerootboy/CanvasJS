<?php

namespace Helfull\CanvasJS;

use Helfull\CanvasJS\Chart\ChartData;
use Helfull\CanvasJS\Chart\ChartPropertie;
use Illuminate\Support\Collection;
use View;

class Chart extends Collection {

	public function __construct($opt = []) {

		$options = $opt;
		$options['chart'] = new ChartPropertie((isset($opt['chart']) ? :[]));
		parent::__construct($options);
		$this->resolveID($opt);
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
		return $this->get('chart');
	}

	protected function resolveID() {
		if (!$this->has('id')) {
			$this->put('id', $this->generateID());
		}
	}

	private function generateID() {
		return sprintf('Chart%04x%04x%04x%04x%04x%04x%04x%04x',

		// 32 bits for "time_low"
		mt_rand(0, 0xffff), mt_rand(0, 0xffff),

		// 16 bits for "time_mid"
		mt_rand(0, 0xffff),

		// 16 bits for "time_hi_and_version",
		// four most significant bits holds version number 4
		mt_rand(0, 0x0fff) | 0x4000,

		// 16 bits, 8 bits for "clk_seq_hi_res",
		// 8 bits for "clk_seq_low",
		// two most significant bits holds zero and one for variant DCE1.1
		mt_rand(0, 0x3fff) | 0x8000,

		// 48 bits for "node"
		mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}

	public function toString() {
		return $this->toJson();
	}

	public function render() {

		$view = false ? 'chartjquery' : 'chart';

		return view('canvasjs::' . $view, ['chart' => $this]);
	}

	public function __get($key) {
		if($this->has($key)) {
			return $this->get($key);
		}
	}
}