@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sửa thể loại <small>{{$theloai->Ten}}</small></h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/theloai/sua/{{$theloai->id}}" method="POST">
                        @if (session('thongbao'))
                            <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}
                                @endforeach
                            </div>
                        @endif
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Tên thể loại</label>
                            <input class="form-control" name="TenTL" value="{{$theloai->Ten}}" placeholder="Nhập tên thể loại"/>
                        </div>
                        <button type="submit" class="btn btn-default">Cập nhật</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection