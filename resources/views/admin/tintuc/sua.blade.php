@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sửa tin<small>{{$tintuc->TieuDe}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">
                    <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                        @if (session('thongbao'))
                            <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
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
                        <div class="form-group col-md-7">
                            <label>Chọn thể loại</label>
                            <select class="form-control" name="TheLoai" id="TheLoai">
                                @foreach($theloai as $tl)
                                    <option 
                                            @if ($tintuc->loaitin->theloai->id == $tl->id)
                                                {{"selected"}}
                                            @endif
                                            value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-7">
                            <label>Chọn loại tin</label>
                            <select class="form-control" name="LoaiTin" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                    <option
                                            @if ($tintuc->idLoaiTin == $lt->id)
                                            {{"selected"}}
                                            @endif
                                            value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="TieuDe" value="{{$tintuc->TieuDe}}" placeholder="Nhập tiêu đề" />
                        </div>
                        <div class="form-group col-md-12">
                            <label>Tóm tắt</label>
                            <textarea id="tomtat" name="TomTat" class="form-control ckeditor" rows="3">{{$tintuc->TomTat}}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nôi dung</label>
                            <textarea id="noidung" name="NoiDung" class="form-control ckeditor" rows="5">{{$tintuc->NoiDung}}</textarea>
                        </div>
                        <div class="form-group col-md-7">
                            <label>Hình ảnh</label>
                            <img width="300px" src="upload/tintuc/{{$tintuc->Hinh}}">
                            <input type="file" name="Hinh" class="form-control">
                        </div>
                        <div class="form-group col-md-7">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1"
                                @if ($tintuc->NoiBat == 1)
                                {{"checked"}}
                                @endif
                                       type="radio">Có
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0"
                                @if ($tintuc->NoiBat == 0)
                                {{"checked"}}
                                @endif
                                       type="radio">Không
                            </label>
                        </div>
                        <div class="form-group col-md-7">
                            <button type="submit" class="btn btn-default ">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page -header">Danh sách bình luận</h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>Id</th>
                        <th>Người dùng</th>
                        <th>Nội dung</th>
                        <th>Ngày đăng</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tintuc->comment as $cmt)
                        <tr align="center">
                            <td>{{$cmt->id}}</td>
                            <td>{{$cmt->user->name}}</td>
                            <td>{{$cmt->NoiDung}}</td>
                            <td>{{$cmt->created_at}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cmt->id}}/{{$tintuc->id}}"> Xóa</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->


        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection

@section('script')
    <script> $(document).ready(function () {
            $('#TheLoai').change(function () {
                var idTheLoai=$(this).val();
                $.get('admin/ajax/loaitin/'+idTheLoai,function (data) {
                    $('#LoaiTin').html(data);
                })
            })
        });
    </script>
@endsection