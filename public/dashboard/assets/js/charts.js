var ChartsFlotcharts = function() {

    return {
        //main function to initiate the module

        init: function() {

            App.addResizeHandler(function() {
                Charts.initPieCharts();
            });

        },
        initPieCharts: function() {

            var data = [];
            var series = Math.floor(Math.random() * 10) + 1;
            series = series < 5 ? 5 : series;

            for (var i = 0; i < series; i++) {
                data[i] = {
                    label: "Series" + (i + 1),
                    data: Math.floor(Math.random() * 100) + 1
                };
            }

            // DEFAULT
			
			
            if ($('.draw_chart').size() !== 0) {
                $.plot($(".draw_chart"), data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            label: {
                                show: true,
                                radius: 2 / 3,
                                formatter: function(label, series) {
                                    return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                },
                                threshold: 0.1
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                });
            }
        }, initBarCharts: function() {

            // bar chart:
            var data = GenerateSeries(0);

            function GenerateSeries(added) {
                var data = [];
                var start = 100 + added;
                var end = 200 + added;

                for (i = 1; i <= 20; i++) {
                    var d = Math.floor(Math.random() * (end - start + 1) + start);
                    data.push([i, d]);
                    start++;
                    end++;
                }

                return data;
            }

            var options = {
                series: {
                    bars: {
                        show: true
                    }
                },
                bars: {
                    barWidth: 0.8,
                    lineWidth: 0, // in pixels
                    shadowSize: 0,
                    align: 'left'
                },

                grid: {
                    tickColor: "#eee",
                    borderColor: "#eee",
                    borderWidth: 1
                }
            };

            if ($('.draw_chart').size() !== 0) {
                $.plot($(".draw_chart"), [{
                    data: data,
                    lines: {
                        lineWidth: 1,
                    },
                    shadowSize: 0
                }], options);
            }

        
        },initAnswersPieCharts: function() {

            var data = [];
            var series = Math.floor(Math.random() * 10) + 1;
            series = series < 5 ? 5 : series;

            for (var i = 0; i < series; i++) {
                data[i] = {
                    label: "Series" + (i + 1),
                    data: Math.floor(Math.random() * 100) + 1
                };
            }

            // DEFAULT
			
			
            if ($('.answers_chart').size() !== 0) {
                $.plot($(".answers_chart"), data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            label: {
                                show: true,
                                radius: 2 / 3,
                                formatter: function(label, series) {
                                    return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                },
                                threshold: 0.1
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                });
            }
        }

    };

}();



jQuery(document).ready(function() {    
  
	ChartsFlotcharts.init();
    $('input[type=radio][name=radio1]').on('ifClicked', function(event){
	  $('.attribute_name').text($(this).closest('label').text());
      ChartsFlotcharts.initPieCharts();
      
   });
   
   $('#survay-statistics').change(function(event){
	  $('.attribute_name').text($(this).val());
      ChartsFlotcharts.initPieCharts();
      
   });	
   
   $('#chart-type').change(function(){
    $('.draw-data').hide();
	$('#chart_1_1').html('');
	$('#pie_chart').html('');
	var selected_val = $(this).val();
	$('.'+selected_val).show();
   });
   
   $('#draw-table').click(function(){
   $('.draw_chart').html('');
      new Morris.Bar({
    element: 'morris_chart',
    data: [
      { y: '2006', a: 100, b: 90 },
      { y: '2007', a: 75,  b: 65 },
      { y: '2008', a: 50,  b: 40 },
      { y: '2009', a: 75,  b: 65 },
      { y: '2010', a: 50,  b: 40 },
      { y: '2011', a: 75,  b: 65 },
      { y: '2012', a: 100, b: 90 }
    ],
    xkey: 'y',
    ykeys: ['a', 'b'],
    labels: ['Series A', 'Series B']
  });
   });

   $('#draw-chart').click(function(){
     ChartsFlotcharts.initPieCharts();
   });
   
   $('#draw-bar').click(function(){
     ChartsFlotcharts.initBarCharts();
   });

	
	// for survay view
	
	 var data = [];
            var series = Math.floor(Math.random() * 10) + 1;
            series = series < 5 ? 5 : series;

            for (var i = 0; i < series; i++) {
                data[i] = {
                    label: "Series" + (i + 1),
                    data: Math.floor(Math.random() * 100) + 1
                };
            }

            // DEFAULT
			
			
            if ($('.draw_question_b').size() !== 0) {
                $.plot($(".draw_question_b"), data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            label: {
                                show: true,
                                radius: 2 / 3,
                                formatter: function(label, series) {
                                    return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                },
                                threshold: 0.1
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                });
            }
			
			if ($('.draw_question_a').size() !== 0) {
                $.plot($(".draw_question_a"), data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            label: {
                                show: true,
                                radius: 2 / 3,
                                formatter: function(label, series) {
                                    return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                },
                                threshold: 0.1
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                });
            }
   
});