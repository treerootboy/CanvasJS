<?php

namespace Helfull\CanvasJS;

use Helfull\CanvasJS\Chart\ChartData;
use Helfull\CanvasJS\Chart\ChartPropertie;
use Illuminate\Support\Collection;
use View;

class Chart extends Collection {

	public function __construct($opt = []) {

		$opt = $this->convertOptions($opt);

		$options = $opt;
		$options['chart'] = new ChartPropertie((isset($opt['chart']) ? :[]));
		parent::__construct($options);
		$this->resolveID($opt);
	}

	protected function convertOptions($opt) {
		if(is_string($opt)) {
			return $this->convertOptionsFromString($opt);
		}
		return $opt;
	}

	protected function convertOptionsFromString($opt) {
		return json_decode($opt, true);
	}

	public function setPropertie($key, $val) {
		$this->get('chart')->put($key, $val);
		return $this->getPropertie($key);
	}

	public function getPropertie($key) {
		return $this->get('chart')->get($key);
	}

	public function addData(ChartData $chartData) {
		$data = $this->getPropertie('data');
		if(is_null($data)) {
			$data = $this->setPropertie('data', new Collection);
		}
		$data->push($chartData);
		return $this;
	}

	public function getID() {
		return $this->get('id');
	}

	public function putAttribute($key, $att) {
		return $this->getAttributes()->put($key, $att);
	}

	public function getAttribute($key) {
		return $this->getAttributes()->get($key);
	}

	public function putAttributes(array $atts) {
		foreach($atts as $key=>$att) {
			$this->putAttribute($key,$att);
		}
	}

	public function getAttributes() {
		if(!$this->has('attributes')) {
			$this->put('attributes', new Collection);
		}
		return $this->get('attributes');
	}

	public function getAttributesArray() {
		return $this->getAttributes()->toArray();
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