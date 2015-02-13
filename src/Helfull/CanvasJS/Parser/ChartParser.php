<?php

namespace Helfull\CanvasJS\Parser;

/**
 * Parse Chartdata into Chart class
 */
class ChartParse extends Parser {

	public function parse($data) {
		if (is_array($data)) {
			return $this->parseArray($data);
		}

	}

	protected function parseArray($data) {

		$parsedData = [];

		if (isset($data['dataPoints'])) {
			$parsedData['dataPoints'] = with(new DataPointParser)->parse($data);
		}

	}

}