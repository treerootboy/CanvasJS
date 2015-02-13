<?php

use Helfull\CanvasJS\Chart;

class ChartTest extends PHPUnit_Framework_TestCase {

	function testGenerateID() {
		$runs = 10;
		$resultOld = null;

		for ($i = 0; $i <= $runs; $i++) {
			$resultNew = new Chart;
			if (!is_null($resultOld)) {
				$this->assertNotEquals($resultOld->getID(), $resultNew->getID());
			}

			$resultOld = null;
			$resultOld = $resultNew;
		}
	}

	function testInitChartWithID() {
		$id = 'testChart';
		$chart = new Chart(['id' => $id]);
		$this->assertEquals($id, $chart->getID());
		$this->assertEquals($id, $chart->id);
	}

	function testShouldHaveChartPropertie() {
		$chartProp = ['animationEnabled' => true];
		$chart = new Chart(['chart' => $chartProp]);
		$this->assertInstanceOf('Helfull\CanvasJS\Chart\ChartPropertie', $chart->getChart());
		$this->assertInstanceOf('Helfull\CanvasJS\Chart\ChartPropertie', $chart->chart);
	}

	function testShouldAddAttributes() {
		$attributes = [
			"style" => "height:300",
			"class" => "chart",
		];
		$chart = new Chart;
		$chart->putAttribute('style', $attributes['style']);
		$this->assertEquals($attributes['style'], $chart->getAttribute('style'));

		$chart = new Chart;
		$chart->putAttributes($attributes);
		$this->assertEquals($attributes['style'], $chart->getAttribute('style'));
		$this->assertEquals($attributes['class'], $chart->getAttribute('class'));
	}

	function testShouldSupportJSON() {
		$json = '
        {"id": "test","chart":
            {"data":
                [
                    {
                        "dataPoints":
                        [
                            {
                                "label": "banana",
                                "y": 18
                            }
                        ],
                        "type": "line"
                    }
                ]
            }
        }';
		$jsonArr = json_decode($json, true);
		$chart = new Chart($json);
		$this->assertEquals(
			count($jsonArr['chart']['data']),
			$chart->chart->getData()->count()
		);

		$this->assertInstanceOf('Helfull\CanvasJS\Chart\ChartPropertie', $chart->chart);

	}

	function testShouldSuportArray() {
		$arr = ['id' => 'test', 'chart' => ['data' => [['dataPoints' => [["label" => "banana", "y" => 999]]]]]];
		$chart = new Chart($arr);
		$this->assertEquals($arr['id'], $chart->getID());
		$this->assertEquals(count($arr['chart']['data']), $chart->chart->getData()->count());
		$this->assertInstanceOf('Helfull\CanvasJS\Chart\ChartPropertie', $chart->chart);
	}

}