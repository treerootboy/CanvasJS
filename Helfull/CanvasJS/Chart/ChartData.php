<?php
namespace Helfull\CanvasJS\Chart;

use Illuminate\Support\Collection;

class ChartData extends Collection {

    public function setType($chartType) {
        $this->put('type', $chartType);
    }

    public function getPoints() {
        return $this->get('dataPoints')?:[];
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