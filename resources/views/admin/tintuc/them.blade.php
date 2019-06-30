@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thêm tin
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">
                    <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
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
                            <select class="form-control" name="idTheLoai" id="TheLoai">
                                @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-7">
                            <label>Chọn loại tin</label>
                            <select class="form-control" name="idLoaiTin" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" />
                        </div>
                        <div class="form-group col-md-12">
                            <label>Tóm tắt</label>
                            <textarea id="tomtat" name="TomTat" class="form-control ckeditor" rows="3"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nôi dung</label>
                            <textarea id="noidung" name="NoiDung" class="form-control ckeditor" rows="5"></textarea>
                        </div>
                        <div class="form-group col-md-7">
                            <label>Hình ảnh</label>
                            <input type="file" name="Hinh" class="form-control">
                        </div>
                        <div class="form-group col-md-7">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1" checked="" type="radio">Có
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0" type="radio">Không
                            </label>
                        </div>
                        <div class="form-group col-md-7">
                            <button type="submit" class="btn btn-default ">Thêm tin</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    </form>
                </div>
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