<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('trangchu')}}">Tin Tức 24h</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="gioithieu">Giới thiệu</a>
                </li>
                <li>
                    <a href="lienhe">Liên hệ</a>
                </li>
            </ul>

            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nhập từ khóa">
                </div>
                <button type="submit" class="btn btn-default">Tìm</button>
            </form>

            <ul class="nav navbar-nav pull-right">
                <?php $user_login = session()->get('user_login');?>

                @if(!is_null($user_login))
                    <li>
                        <a>
                            <span class ="glyphicon glyphicon-user"></span>
                            {{$user_login->name}}
                        </a>
                    </li>

                    <li>
                        <a href="dangxuat">Đăng xuất</a>
                    </li>
                @else
                    <li>
                        <a href="dangky"><i class="fa fa-sign-out fa-fw"></i> Đăng ký</a>
                    </li>
                    <li>
                        <a href="dangnhap" ><i class="fa fa-sign-out fa-fw"></i> Đăng nhập</a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

