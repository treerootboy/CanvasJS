<?php
namespace Helfull\CanvasJS\Chart;

use Helfull\CanvasJS\Parser\DataPointParser;
use Illuminate\Support\Collection;

class ChartData extends Collection {

	public function __construct($data = []) {
		parent::__construct($data);

		$this->resolveData();
	}

	protected function resolveData() {
		if ($this->has('dataPoints')) {
			$this->put('dataPoints', with(new DataPointParser)->parse($this->pull('dataPoints', [])));
		}
	}

	public function setName($chartName) {
		$this->put('name', $chartName);
		$this->put('showInLegend', is_string($chartName));
		return $this;
	}

	public function setType($chartType) {
		$this->put('type', $chartType);
		return $this;
	}

	public function getPoints() {
		return $this->get('dataPoints') ?: [];
	}

	public function setPoints($points) {
		$this->put('dataPoints', $points);
	}

	public function addPoint(DataPoint $point) {
		$points = $this->getPoints();
		array_push($points, $point);
		$this->setPoints($points);
		return $this;
	}

	public function getPoint($index) {
		return $this->getPoints()[$index];
	}
}
