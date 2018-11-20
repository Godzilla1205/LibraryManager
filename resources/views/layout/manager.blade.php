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
					<div class="text-muted small">Tổng doanh thu</div>
					<div class="text-xlarge">45.043.130VNĐ</div>
				</div>
				<div class="px-5">
					<div class="row" style="margin-right:0px">
						<div class="col-sm-12">
							<div id="statistical0"></div>
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
</script>
@endsection



