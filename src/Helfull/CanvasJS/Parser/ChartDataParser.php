<?php
namespace Helfull\CanvasJS\Parser;

use Helfull\CanvasJS\Chart\ChartData;

/**
 * Parses ChartData array into ChartData objects
 */
class ChartDataParser extends Parser {

	public function parse($data) {

		$parsedData = [];

		foreach ($data as $entry) {
			$parsedData[] = new ChartData($entry);
		}

		return new Collection($parsedData);
	}

}