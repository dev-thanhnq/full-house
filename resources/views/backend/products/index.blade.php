@extends('backend.layouts.master')
@section('script')
    {{--<script>--}}
    {{--    $(document).ready(function () {--}}
    {{--        $('#productsTable').DataTable({--}}
    {{--            dom: 'lifrtp',--}}
    {{--            processing: true,--}}
    {{--            serverSide: true,--}}
    {{--            ajax: '/admin/products/get-data',--}}
    {{--            columns: [--}}
    {{--                { data: 'DT_RowIndex', searchable: false},--}}
    {{--                { data: 'name', name: 'product_name', searchable: true},--}}
    {{--                { data: 'category_id', name: 'category_name'},--}}
    {{--                { data: 'content', name: 'product_content'},--}}
    {{--                { data: 'action', name: 'product_action'}--}}
    {{--            ]--}}
    {{--        });--}}
    {{--    });--}}
    {{--</script>--}}
@endsection
@section('header-content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Danh sách sản phẩm</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a style="text-decoration: none"
                                                   href="{{ route('backend.dashboard') }}">
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
                        <a class="btn btn-success" href="{{route('backend.product.create')}}"><i
                                class="fa fa-btn fa-plus"></i> Thêm mới</a>
                        <a style="margin-left: 10px" class="btn btn-primary" href="{{route('backend.product.export')}}"><i
                                class="fa fa-btn fa-file-excel"></i> Xuất Excel</a>
                        <form style="margin-top: 3px; margin-left: 20px" role="search" method="get"
                              action="{{route('backend.product.index')}}">
                            <input placeholder="Nhập tên sản phẩm" value="{{$search}}" style="height: 35px" type="text"
                                   name="q">
                            <button style="margin-left: 5px" type="submit" class="btn btn-default">
                                <i
                                    class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th>Tên sản phẩm</th>
                                <th style="text-align: center">Ảnh</th>
                                <th style="text-align: center">Số lượng</th>
                                <th>Giá hiển thị</th>
                                <th style="text-align: center">Kích thước</th>
                                <th style="text-align: center">Trạng thái</th>
                                <th style="text-align: center">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td style="text-align: center">{{ $product->id }}</td>
                                    <td style="width: 250px;">
                                        <a style="text-decoration: none"
                                           href="{{ route('backend.product.show', $product->id) }}">{{ $product->name }}</a>
                                    </td>
                                    <td style="text-align: center;">
                                        @if ($product->image)
                                            <img
                                                style="width: 200px;height: 200px;object-fit: cover;"
                                                src="/{{$product->image}}">
                                        @else
                                            <img style="width: 200px;height: 200px;object-fit: cover;"
                                                 src="/frontend/img/product-default.jpg">
                                        @endif</td>
                                    <td style="text-align: center">{{ number_format($product->total) }}</td>
                                    <td>{{ number_format($product->sale_price) }} VND</td>
                                    <td style="text-align: center">
                                        @foreach($product->attributes as $key => $value)
                                            <span class="badge badge-success">
                                                {{ $value->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td style="text-align: center">
                                        @if($product->status == 0)
                                            <span class="badge badge-warning">Đang nhập</span>
                                        @else
                                            <span class="badge badge-info">Mở bán</span
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <form action="{{ route('backend.product.destroy', $product->id) }}"
                                              method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger"><i class="fa fa-btn fa-trash"></i> Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div style="float: right">{!! $products->links() !!}</div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    </div>
@endsection
