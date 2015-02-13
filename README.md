# CanvasJS

[![Build Status](https://travis-ci.org/Helfull/CanvasJS.svg?branch=develop)](http://travis-ci.org/Helfull/CanvasJS?branch=develop)

Maintained and developed by Helfull
This package is a helper library for laravel to easyly create [canvasjs charts](http://canvasjs.com).

## Installation

add require:

``` php
    'helfull/canvasjs': 'dev-master'
```  

run `composer update` or `composer install`  
  
add to your `config/app.php`

``` php
    'Helfull\CanvasJS\Laravel\CanvasJSServiceProvider',
```


## Usage

``` php
    use Helfull\CanvasJS\Chart;
    use Helfull\CanvasJS\Chart\ChartData;
    use Helfull\CanvasJS\Chart\DataPoint;

    $chart = new Chart;
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
    {{ $chart->render() }}
```

## Documentation

#### Chart constructor
you can pass every parameter to the chart like you would do with plain JS
as `json` or as a `array`.
``` php 

    //with json
    $chart = new Chart("{
        theme: "theme2",//theme1
        title:{
            text: "Basic Column Chart - CanvasJS"              
        },
        animationEnabled: false,   // change to true
        data: [              
        {
            // Change type to "bar", "splineArea", "area", "spline", "pie",etc.
            type: "column",
            dataPoints: [
                { label: "apple",  y: 10  },
                { label: "orange", y: 15  },
                { label: "banana", y: 25  },
                { label: "mango",  y: 30  },
                { label: "grape",  y: 28  }
            ]
        }
        ]
    }");

    //as a array
    $chart = new Chart([
        "theme"=> "theme2",
        "title"=>[
            "text"=> "Basic Column Chart - CanvasJS"              
        ],
        "animationEnabled"=> false,   // change to true
        "data"=> [              
        [
            // Change type to "bar", "splineArea", "area", "spline", "pie",etc.
            "type"=> "column",
            "dataPoints"=> [
                [ "label"=> "apple",  "y"=> 10  ],
                [ "label"=> "orange", "y"=> 15  ],
                [ "label"=> "banana", "y"=> 25  ],
                [ "label"=> "mango",  "y"=> 30  ],
                [ "label"=> "grape",  "y"=> 28  ]
            ]
        }
        ]
    ]);

```