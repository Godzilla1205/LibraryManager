@extends('index')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3">
			<div class="card">
				<div class="d-flex align-items-center">
					<div class="display-4 text-success">
						<i class="fas fa-shopping-cart"></i>
					</div>
					<div class="ml-3">
						<div class="text-muted small">Vé bán được</div>
						<div class="text-large">1028</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card">
				<div class="d-flex align-items-center">
					<div class="display-4 text-success">
						<i class="fa fa-globe"></i>
					</div>
					<div class="ml-3">
						<div class="text-muted small">Lượt truy cập</div>
						<div class="text-large">23620</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card">
				<div class="d-flex align-items-center">
					<div class="display-4 text-success">
						<i class="fas fa-flask"></i>
					</div>
					<div class="ml-3">
						<div class="text-muted small">Trung bình thời lượng</div>
						<div class="text-large">00:10:13</div>
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
						<div class="text-muted small">Người dùng</div>
						<div class="text-large">10,540</div>
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

