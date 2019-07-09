@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Admin</a>
                </p>

                <!-- Preview Image -->
                <img width="400px" class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="{{$tintuc->TieuDe}}">

                <!-- Date/Time -->
                <p style="margin-top: 10px;"><span class="glyphicon glyphicon-time"></span> Đăng lúc {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">
                    {!! $tintuc->NoiDung !!}
                </p>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                @foreach($tintuc->comment as $cmt)
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img width="64px" height="64px" class="media-object" src="image/avatar.jpg" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$cmt->user->name}}
                            <small>{{$cmt->created_at}}</small>
                        </h4>
                        <p>{!! $cmt->NoiDung !!}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">

                        @foreach($tinlienquan as $tinlq)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="chitiet/{{$tinlq->id}}/{{$tinlq->TieuDeKhongDau}}.html">
                                    <img width="80px" height="80px" class="img-responsive" src="upload/tintuc/{{$tinlq->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="chitiet/{{$tinlq->id}}/{{$tinlq->TieuDeKhongDau}}.html"><b>{{$tinlq->TieuDe}}</b></a>
                            </div>
                            <p style="font-weight: normal;padding: 0 5px">{{$tinlq->TomTat}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">

                        @foreach($tinnoibat as $tinnb)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="chitiet/{{$tinnb->id}}/{{$tinnb->TieuDeKhongDau}}.html">
                                    <img width="80px" height="80px" class="img-responsive" src="upload/tintuc/{{$tinnb->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="chitiet/{{$tinnb->id}}/{{$tinnb->TieuDeKhongDau}}.html"><b>{{$tinnb->TieuDe}}</b></a>
                            </div>
                            <p style="font-weight: normal;padding: 0 5px">{{$tinnb->TomTat}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach

                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection