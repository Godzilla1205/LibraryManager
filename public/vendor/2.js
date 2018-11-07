$( document ).ready(function() {
	$('.leftmenutrigger').on('click', function(e) {
		$('div#wrapper').toggleClass("closeSide");
 e.preventDefault();
});





// Thống kê

	Highcharts.chart('statistical0', {
		title: {
			text: 'Thống kê theo giờ'
		},

		subtitle: {
			text: 'Plain'
		},

		xAxis: {
			categories: ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11','12','13','14','15','16','17','18','19','20','21','22','23']
		},

		series: [{
			type: 'column',
			colorByPoint: true,
			data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 200,300,170,400,200,500,100,500,420,500,600,405,600,304],
			showInLegend: false
		}]

	});


	var chart = Highcharts.chart('statistical1', {
		title: {
			text:'Doanh thu năm 2018'
		},

		subtitle: {
			text: 'Plain'
		},



		xAxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},

		series: [{
			type: 'column',
			colorByPoint: true,
			data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 0,0],
			showInLegend: false
		}]

	});


	// $('#plain').click(function () {
	// 	chart.update({
	// 		chart: {
	// 			inverted: false,
	// 			polar: false
	// 		},
	// 		subtitle: {
	// 			text: 'Plain'
	// 		}
	// 	});
	// });

	// $('#inverted').click(function () {
	// 	chart.update({
	// 		chart: {
	// 			inverted: true,
	// 			polar: false
	// 		},
	// 		subtitle: {
	// 			text: 'Inverted'
	// 		}
	// 	});
	// });

	// $('#polar').click(function () {
	// 	chart.update({
	// 		chart: {
	// 			inverted: false,
	// 			polar: true
	// 		},
	// 		subtitle: {
	// 			text: 'Polar'
	// 		}
	// 	});
	// 





Highcharts.chart('statistical2', {

    title: {
        text: 'Thống kê theo năm 2012-2018'
    },

    subtitle: {
        text: 'Source: thesolarfoundation.com'
    },

    yAxis: {
        title: {
            text: 'Number of Employees'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 2012
        }
    },

    series: [{
        name: 'Installation',
        data: [43934, 52503, 57177, 69658, 97031, 119931, 137133],
    }
    ],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

});
