<?php
namespace Helfull\CanvasJS\Parser;

use Helfull\CanvasJS\Chart\DataPoint;

/**
 * Parses Datapoints
 */
class DataPointParser extends Parser {
	public function parse($data) {
		$parsedData = [];

		foreach ($data as $entry) {
			$parsedData[] = new DataPoint($entry);
		}

		return $parsedData;
	}
}