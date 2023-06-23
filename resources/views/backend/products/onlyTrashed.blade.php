@extends('backend.layouts.master')
@section('script')

@endsection
@section('header-content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Danh sách sản phẩm đã gỡ</h1>
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
                    <li class="breadcrumb-item active">Sản phẩm đã xóa</li>
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
                    <div class="card-body">
                        <table id="" class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th>Tên sản phẩm</th>
                                <th style="text-align: center">Ảnh</th>
                                <th style="text-align: center">Thể loại</th>
                                <th style="text-align: center">Số lượng</th>
                                <th>Giá bán</th>
                                <th>Giá khuyến mãi</th>
                                <th style="text-align: center">Giảm giá(%)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td style="text-align: center">{{ $product->id }}</td>
                                    <td style="width: 250px;">
                                        <a style="text-decoration: none" href="{{ route('backend.product.show', $product->id) }}">{{ $product->name }}</a>
                                    </td>
                                    <td style="text-align: center;">
                                        @if ($product->image)
                                            <img
                                                style="width: 160px;height: 200px;object-fit: cover;"
                                                src="/{{$product->image}}">
                                        @else
                                            <img style="width: 160px;height: 200px;object-fit: cover;"
                                                 src="/frontend/img/product-default.jpg">
                                        @endif</td>
                                    <td style="text-align: center">{{ $product->category ? $product->category->name : 'Đang cập nhật' }}</td>
                                    <td style="text-align: center">{{ number_format($product->total) }}</td>
                                    <td>{{ number_format($product->origin_price) }} VND</td>
                                    <td>{{ number_format($product->sale_price) }} VND</td>
                                    <td style="text-align: center"><span class="badge badge-success">{{ $product->discount_percent }}%</span></td>
                                </tr>
                            @endforeach
                            </tfoot>
                        </table>
                        <br>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    </div>
@endsection

