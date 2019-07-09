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
            <a class="navbar-brand" href="{{route('trangchu')}}">Laravel Tin Tức</a>
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
                        <a href="#" data-toggle="modal" data-target="#signupModal"><i class="fa fa-sign-out fa-fw"></i> Đăng ký</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#loginModal"><i class="fa fa-sign-out fa-fw"></i> Đăng nhập</a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="loginForm" role="form" action="dangnhap" method="POST">
                <div class="modal-header text-center">
                    <h3 class="modal-title">Đăng nhập</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        {{csrf_field()}}
                        <fieldset>
                            <div class="form-group">
                                <input  type="email" class="form-control" placeholder="Nhập email" name="email" id="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password" id="password" value="{{old('password')}}" >
                            </div>
                            <div class="alert alert-danger" id="loginerror"></div>
                        </fieldset>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success pull-left">Đăng nhập</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" action="dangnhap" method="POST">
                <div class="modal-header text-center">
                    <h3 class="modal-title">Đăng ký</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        @if (session('loi'))
                            <div class="alert alert-danger">{{session('loi')}}</div>
                        @endif
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}
                                @endforeach
                            </div>
                        @endif

                        {{csrf_field()}}
                        <fieldset>
                            <div class="form-group">
                                <input  type="email" class="form-control" placeholder="Nhập email" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password" value="{{old('password')}}" >
                            </div>

                        </fieldset>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success pull-left">Đăng nhập</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>