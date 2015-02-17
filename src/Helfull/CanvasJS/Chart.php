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
		$options['chart'] = new ChartPropertie((isset($options['chart']) ? $options['chart'] :[]));
		parent::__construct($options);
		$this->resolveID($opt);
	}

	/**
	 * Converts the options to parseable data
	 * @param type mixed $opt 
	 * @return type mixed
	 */
	protected function convertOptions($opt) {
		if(is_string($opt)) {
			return $this->convertOptionsFromString($opt);
		}
		return $opt;
	}

	/**
	 * Converts a json string to a associativ array
	 * @param type string $opt 
	 * @return type array
	 */
	protected function convertOptionsFromString($opt) {
		return json_decode($opt, true);
	}

	/**
	 * Sets a chart propertie
	 * @param type string $key 
	 * @param type mixed $val 
	 * @return type mixed
	 */
	public function setPropertie($key, $val) {
		$this->get('chart')->put($key, $val);
		return $this->getPropertie($key);
	}

	/**
	 * Gets a the Chart propertie of the given key
	 * @param type string $key 
	 * @return type mixed
	 */
	public function getPropertie($key) {
		return $this->get('chart')->get($key);
	}

	/**
	 * Adds a Chartdata Obj to the Chart
	 * @param type ChartData $chartData 
	 * @return type self
	 */
	public function addData(ChartData $chartData) {
		$data = $this->getPropertie('data');
		if(is_null($data)) {
			$data = $this->setPropertie('data', new Collection);
		}
		$data->push($chartData);
		return $this;
	}

	/**
	 * Gets the chart id
	 * @return string
	 */
	public function getID() {
		return $this->get('id');
	}

	/**
	 * Sets a single html attribute
	 * @param string $key 
	 * @param string $att 
	 * @return mixed
	 */
	public function putAttribute($key, $att) {
		return $this->getAttributes()->put($key, $att);
	}

	/**
	 * gets the html attribute for the given $key
	 * @param string $key 
	 * @return mixed
	 */
	public function getAttribute($key) {
		return $this->getAttributes()->get($key);
	}

	/**
	 * Adds html attributes
	 * @param type array $atts 
	 */
	public function putAttributes(array $atts) {
		foreach($atts as $key=>$att) {
			$this->putAttribute($key,$att);
		}
	}

	/**
	 * Gets the html attributes Collection
	 * @return Illuminate\Support\Collection
	 */
	public function getAttributes() {
		if(!$this->has('attributes')) {
			$this->put('attributes', new Collection);
		}
		return $this->get('attributes');
	}

	/**
	 * Gets the HTML attributes as an array
	 * @return type array
	 */
	public function getAttributesArray() {
		return $this->getAttributes()->toArray();
	}

	/**
	 * Gets the ChartPropertie object
	 * @return type Helfull\CanvasJS\Chart\ChartPropertie
	 */
	public function getChart() {
		return $this->get('chart');
	}

	/**
	 * Generates if needed a chartid
	 * @return type void
	 */
	protected function resolveID() {
		if (!$this->has('id')) {
			$this->put('id', $this->generateID());
		}
	}

	/**
	 * Generates an unique id
	 * @return type string
	 */
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

	/**
	 * Renders the chart html
	 * @return type
	 */
	public function render() {

		$view = false ? 'chartjquery' : 'chart';

		return view('canvasjs::' . $view, ['chart' => $this]);
	}

	public function __get($key) {
		if($this->has($key)) {
			return $this->get($key);
		}
	}

	public function toString() {
		return $this->toJson();
	}
}