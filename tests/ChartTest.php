<?php

use Helfull\CanvasJS\Chart;

class ChartTest extends PHPUnit_Framework_TestCase {

    function testGenerateID() {
        $runs = 10;
        $resultOld = null;

        for($i = 0; $i<=$runs; $i++){
            $resultNew = new Chart;
            if(!is_null($resultOld)) $this->assertNotEquals($resultOld->getID(), $resultNew->getID());
            $resultOld = null;
            $resultOld = $resultNew;
        }
    }

    function testInitChartWithID() {
        $id = 'testChart';
        $chart = new Chart(['id'=>$id]);
        $this->assertEquals($id, $chart->getID());
        $this->assertEquals($id, $chart->id);
    }

    function testShouldHaveChartPropertie() {
        $chartProp = ['animationEnabled'=>true];
        $chart = new Chart(['chart'=>$chartProp]);
        $this->assertInstanceOf('Helfull\CanvasJS\Chart\ChartPropertie', $chart->getChart());
        $this->assertInstanceOf('Helfull\CanvasJS\Chart\ChartPropertie', $chart->chart);
    }

}