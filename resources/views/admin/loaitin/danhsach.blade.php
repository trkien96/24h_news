@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách loại tin</h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>Id</th>
                        <th>Tên Loại Tin</th>
                        <th>Tên Không Dấu</th>
                        <th>Tên Thể Loại</th>
                        <th>Thao Tác</th>
                        <th>Thao Tác</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($loaitin as $lt)
                            <tr align="center">
                                <td>{{$lt->id}}</td>
                                <td>{{$lt->Ten}}</td>
                                <td>{{$lt->TenKhongDau}}</td>
                                <td>{{$lt->theloai->Ten}}</td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loaitin/sua/{{$lt->id}}">Sửa</a></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/loaitin/xoa/{{$lt->id}}"> Xóa</a></td>
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