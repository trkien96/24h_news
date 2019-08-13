<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Trang tint tức tổng hợp">
    <meta name="author" content="">
    <base href="{{asset('')}}">
    <title>Đăng Nhập</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">Đăng ký</h3>
                </div>
                <div class="panel-body">
                    @if (session('thongbao'))
                        <div class="alert alert-success">{{session('thongbao')}}</div>
                    @endif
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {!! $err.'</br>' !!}
                            @endforeach
                        </div>
                    @endif
                    <form id="regForm" role="form" action="dangky" method="POST">
                        {{csrf_field()}}
                        <div>
                            <label>Họ tên</label>
                            <input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <div>
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
                            >
                        </div>
                        <br>
                        <div>
                            <input type="checkbox" class="" name="checkpassword">
                            <label>Nhập mật khẩu</label>
                            <input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <div>
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="re_password" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-lg btn-success btn-block">Đăng ký</button>
                    </form>
				  	</div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
