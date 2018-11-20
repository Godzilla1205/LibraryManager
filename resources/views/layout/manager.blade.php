@extends('index')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3">
			<div class="card">
				<div class="d-flex align-items-center">
					<div class="display-4 text-success">
						<i class="far fa-bookmark"></i>
					</div>
					<div class="ml-3">
						<div class="text-muted small">Phiếu mượn trong ngày</div>
						<div class="text-large">{{$numberBorrowToDay}}</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card">
				<div class="d-flex align-items-center">
					<div class="display-4 text-success">
						<i class="fas fa-check"></i>
					</div>
					<div class="ml-3">
						<div class="text-muted small">Phiếu trả trong ngày</div>
						<div class="text-large">{{$numberGiveToDay}}</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card">
				<div class="d-flex align-items-center">
					<div class="display-4 text-success">
						<i class="fas fa-user-times"></i>
					</div>
					<div class="ml-3">
						<div class="text-muted small">Phiếu trễ hẹn</div>
						<div class="text-large">{{$numberDelay}}</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card">
				<div class="d-flex align-items-center">
					<div class="display-4 text-success">
						<i class="fas fa-user-friends"></i>
					</div>
					<div class="ml-3">
						<div class="text-muted small">Số lượng độc giả</div>
						<div class="text-large">{{$numberReaders}}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="card mb-4">
				<div class="card-body">
					<div class="float-right text-success">
						<small class="ion ion-md-arrow-round-up text-tiny"></small> 12%
					</div>
					<div class="text-muted small">Tổng</div>
					<div class="text-xlarge">{{-- 45.043.130VNĐ --}}</div>
				</div>
				<div class="px-5">
					<div class="row" style="margin-right:0px">
						<div class="col-sm-12">
							<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>  
</div>
@endsection

@section('highcharts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
@endsection

@section("menu-manager")
sl-active
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active">
		Trang chủ
	</li>	
</ol>
@endsection





@section('scriptBottom')
<script>
	
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Danh sách phiếu mượn/trả trong tuần'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Số phiếu'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} phiếu</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Phiếu mượn',
        data: [{{$strYeahBorow2018}}]

    }, {
        name: 'phiếu trả',
        data: [{{$strYeahGiveBook2018}}]

    }]
});
</script>
@endsection



