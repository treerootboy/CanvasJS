<?php
namespace Helfull\CanvasJS\Chart;

use Helfull\CanvasJS\Parser\ChartDataParser;
use Illuminate\Support\Collection;

/**
 * Holds the chart properties
 */
class ChartPropertie extends Collection {

	public function __construct($options = []) {
		parent::__construct($options);

		$this->resolveData();
	}

	protected function resolveData() {
		if ($this->has('data')) {
			$this->put('data', 
				new Collection(
					with(new ChartDataParser)
					->parse($this->pull('data', []))
				)
			);
		}
	}

	public function getData() {
		return $this->get('data') ?: new Collection;
	}

	public function setData($data) {
		$this->put('data', $data);
	}
}