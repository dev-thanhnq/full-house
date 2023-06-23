@extends('backend.layouts.master')
@section('header-content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Danh sách danh mục</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a style="text-decoration: none" href="{{ route('backend.dashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-house" viewBox="0 0 16 16">
                                <path
                                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                            </svg>
                            Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div style="padding: 20px 0px 0px 20px; display: flex">
                        <a class="btn btn-success" href="{{ route('backend.category.create') }}"><i
                                class="fa fa-btn fa-plus"></i> Thêm mới</a>
                        <form style="margin-top: 3px; margin-left: 20px" role="search" method="get"
                              action="{{route('backend.category.index')}}">
                            <input placeholder="Nhập tên danh mục" value="{{$search}}" style="height: 35px" type="text"
                                   name="q">
                            <button style="margin-left: 5px" type="submit" class="btn btn-default">
                                <i
                                    class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th>Tên danh mục</th>
                                <th style="text-align: center">Số sản phẩm</th>
                                <th style="text-align: center">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td style="text-align: center">{{ $category->id }}</td>
                                    <td>
                                        <a style="text-decoration: none" href="{{ route('backend.category.show', $category->id) }}">{{ $category->name }}</a>
                                    </td>
                                    <td style="text-align: center">{{ count($category->products) }}</td>
                                    <td style="text-align: center">
                                        <form action="{{ route('backend.category.destroy', $category->id) }}"
                                              method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger"><i class="fa fa-btn fa-trash"></i> Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tfoot>
                        </table>
                        <br>
                        <div style="float: right">{!! $categories->links() !!}</div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    </div>
@endsection
