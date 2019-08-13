@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row main-left">
            @include('layout.menu')
            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Giới thiệu</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
					   <p>Tin tức 24h - Đây là trang tin tức tổng hợp nhiều lĩnh vực kinh tế, văn hóa, xã hội,... Nội dung luôn được cập nhật 24/24 đảm bảo cung cấp đầy đủ và kịp thời thông tin đến với người đọc một cách nhanh và chính xác nhất.
					   </p>

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection
