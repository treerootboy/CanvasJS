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

    function testShouldAddAttributes() {
        $attributes = [
            "style"=>"height:300",
            "class"=>"chart"
        ];
        $chart = new Chart;
        $chart->putAttribute('style',$attributes['style']);
        $this->assertEquals($attributes['style'], $chart->getAttribute('style'));

        $chart = new Chart;
        $chart->putAttributes($attributes);
        $this->assertEquals($attributes['style'], $chart->getAttribute('style'));
        $this->assertEquals($attributes['class'], $chart->getAttribute('class'));
    }

}