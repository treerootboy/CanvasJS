# CanvasJS

Maintained and developed by Helfull
This package is a helper library for laravel to easyly create [canvasjs charts](http://canvasjs.com).

## Usage

``` php
    $chart = new Chart(['id'=>'test']);
    $data = new ChartData;
    $data
        ->addPoint(new DataPoint(['label'=>"banana", 'y'=>18]))
        ->addPoint(new DataPoint(['label'=>"orange", 'y'=>29]))
        ->addPoint(new DataPoint(['label'=>"apple", 'y'=>40]))
        ->addPoint(new DataPoint(['label'=>"mango", 'y'=>34]))
        ->addPoint(new DataPoint(['label'=>"grape", 'y'=>24]));
    $chart->addData($data);
```

In your view you just do
``` php
    {{ $chart->render }}
```