<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default settings for charts
    |--------------------------------------------------------------------------
    */

    'default' => [
        'type' => 'line',
        'library' => 'chartjs',
        'element_label' => 'Element',
        'title' => 'My chart',
        'height' => 400,
        'width' => 500,
        'responsive' => true,
    ],
    'multi_libs' => [
        'chartjs' => ['chartjs_line' => 'line', 'chartjs_area' => 'area', 'chartjs_bar' => 'bar'],
        'highcharts' => ['highcharts_line' => 'line', 'highcharts_area' => 'area', 'highcharts_bar' => 'bar', 'highcharts_areaspline' => 'Areaspline'],
        'chartist' => ['chartist_line' => 'line', 'chartist_area' => 'area', 'chartist_bar' => 'bar'],
        'fusioncharts' => ['fusioncharts_line' => 'line', 'fusioncharts_area' => 'area', 'fusioncharts_bar' => 'bar'],
        'c3' => ['c3_line' => 'line', 'c3_area' => 'area', 'c3_bar' => 'bar']
    ],
    'libs' => [
        'chartjs' => ['chartjs_line' => 'line', 'chartjs_area' => 'area', 'chartjs_bar' => 'bar', 'chartjs_pie' => 'pie', 'chartjs_donut' => 'donut'],
        'highcharts' => ['highcharts_line' => 'line', 'highcharts_area' => 'area', 'highcharts_bar' => 'bar', 'highcharts_pie' => 'pie', 'highcharts_donut' => 'donut', 'highcharts_geo' => 'geo'],
        'google' => ['google_line' => 'line', 'google_area' => 'area', 'google_bar' => 'bar', 'google_pie' => 'pie', 'google_donut' => 'donut', 'google_geo' => 'geo', 'google_gauge' => 'gauge'],
        'chartist' => ['chartist_line' => 'line', 'chartist_area' => 'area', 'chartist_bar' => 'bar', 'chartist_pie' => 'pie', 'chartist_donut' => 'donut'],
        'fusioncharts' => ['fusioncharts_line' => 'line', 'fusioncharts_area' => 'area', 'fusioncharts_bar' => 'bar', 'fusioncharts_pie' => 'pie', 'fusioncharts_donut' => 'donut'],
        'plottablejs' => ['plottablejs_line' => 'line', 'plottablejs_area' => 'area', 'plottablejs_bar' => 'bar', 'plottablejs_pie' => 'pie', 'plottablejs_donut' => 'donut'],
        'c3' => ['c3_line' => 'line', 'c3_area' => 'area', 'c3_bar' => 'bar', 'c3_pie' => 'pie', 'c3_donut' => 'donut', 'c3_gauge' => 'gauge']],
    /*
    |--------------------------------------------------------------------------
    | Assets required by the libraries
    |--------------------------------------------------------------------------
    */

    'assets' => [
        'global' => [
            'scripts' => [
            ],
        ],

        'canvas-gauges' => [
            'scripts' => [
                ('/assets/cdn/gauge/gauge.min.js'),
            ],
        ],

        'chartist' => [
            'scripts' => [
                ('/assets/cdn/chartist.js/chartist.js'),
            ],
            'styles' => [
                ('/assets/cdn/chartist.js/chartist.min.css'),
            ],
        ],

        'chartjs' => [
            'scripts' => [
                ('/assets/cdn/Chart.js/Chart.min.js'),
            ],
        ],

        'fusioncharts' => [
            'scripts' => [
                'https://static.fusioncharts.com/code/latest/fusioncharts.js',
                'https://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js',
            ],
        ],

        'google' => [
            'scripts' => [
                'https://www.google.com/jsapi',
                'https://www.gstatic.com/charts/loader.js',
                "google.charts.load('current', {'packages':['corechart', 'gauge', 'geochart', 'bar', 'line']})",
            ],
        ],

        'highcharts' => [
            'styles' => [
                ('/assets/cdn/Highcharts/css/highcharts.css'),
            ],
            'scripts' => [
                ('/assets/cdn/Highcharts/highcharts.js'),
                ('/assets/cdn/Highcharts/js/modules/exporting.js'),
                ('/assets/cdn/Highcharts/js/modules/map.js'),
                ('/assets/cdn/Highcharts/js/modules/data.js'),
                ('/assets/cdn/Highcharts/world.js'),
            ],
        ],

        'justgage' => [
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.6/raphael.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/justgage/1.2.2/justgage.min.js',
            ],
        ],

        'morris' => [
            'styles' => [
                'https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css',
            ],
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.6/raphael.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js',
            ],
        ],

        'plottablejs' => [
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/plottable.js/2.2.0/plottable.min.js',
            ],
            'styles' => [
                'https://cdnjs.cloudflare.com/ajax/libs/plottable.js/2.2.0/plottable.css',
            ],
        ],

        'progressbarjs' => [
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.0.1/progressbar.min.js',
            ],
        ],

        'c3' => [
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.js',
            ],
            'styles' => [
                'https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.css',
            ],
        ],
    ],
];
