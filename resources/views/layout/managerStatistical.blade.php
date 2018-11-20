@extends('index')

@section("menu-manager-statistical")
sl-active
@endsection

@section("highcharts")
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="{{route('get.manager')}}">Trang chủ</a>
	</li>
	<li class="breadcrumb-item active">
		Thống kê
	</li> 
</ol>
@endsection

@section('content')
<div class="container-fluid">
	<div class="card">
		<div class="container">
			<div class="row" style="margin-top:30px">
				<div class="col-sm-6">
					<div id="statistical1"></div>
					<hr class="d-sm-none">
				</div>
				<div class="col-sm-6">
					<div id="statistical0"></div>
					<hr class="d-sm-none">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div id="statistical2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection


@section('scriptBottom')
<script>
	
	var chart = Highcharts.chart('statistical1', {
		title: {
			text:'Số phiếu mượn trong năm 2018'
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
			data: [{{$strYeah2018}}],
			showInLegend: false
		}]

	});


	var chart = Highcharts.chart('statistical0', {
		title: {
			text:'Số phiếu trả trong năm 2018'
		},

		subtitle: {
			text: 'Plain'
		},



		xAxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},

		series: [{
			type: 'column',
			colorByPoint: false,
			data: [{{$strYeahGiveBook2018}}],
			showInLegend: false
		}]

	});





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
</script>
@endsection


