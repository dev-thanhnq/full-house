@extends('backend.layouts.master')
@section('header-content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Chi tiết sản phẩm</h1>
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
                    <li class="breadcrumb-item active">Chi tiết</li>
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
                        <div class="row">
                            <div class="col-3">
                                @if($product->image)
                                    <img src="/{{ $product->image }}" alt=""
                                         style="width: 100%; height: 100%; object-fit: cover">
                                @else
                                    <img src="/frontend/img/product-default.jpg" alt=""
                                         style="width: 100%; height: 100%; object-fit: cover">
                                @endif
                            </div>
                            <div class="col-8" style="font-size: 18px; font-family: 'Source Sans Pro';">
                                <form action="">
                                    <table>
                                        <tr>
                                            <th>Tên sản phẩm:</th>
                                            <td>{{ $product->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Mô tả:</th>
                                            <td>{!! $product->content !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Danh mục:</th>
                                            <td>{{ $product->category ? $product->category->name : 'Đang cập nhật' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nhà sản xuất:</th>
                                            <td>{{ $product->publishing_company ? $product->publishing_company->name : 'Đang cập nhật' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Giá hiển thị:</th>
                                            <td>{{ number_format($product->sale_price) }} VND</td>
                                        </tr>
                                        <tr>
                                            <th>Trạng thái:</th>
                                            <td>
                                                @if($product->staus == 0)
                                                    Còn hàng
                                                @elseif($product->staus == 1)
                                                    Hết hàng
                                                @elseif($product->satus == 2)
                                                    Dừng bán
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Người tạo:</th>
                                            <td>{{ $product->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ngày tạo:</th>
                                            <td>{{ date_format($product->created_at, "d/m/Y") }}</td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered table-striped" style="width: 100%; margin-top: 50px">
                                        <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Giá bán</th>
                                            <th style="text-align: center">Số lượng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product->attributes as $attribute)
                                            <tr>
                                                <td>{{ $attribute->name }}</td>
                                                <td>{{ $attribute->price }} VND</td>
                                                <td>{{ $attribute->total }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-3">
                                <a href="{{route('backend.product.edit', $product->id)}}" style="color: white"
                                   class="btn btn-primary">Cập nhật</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    </div>
@endsection
<style>
    th {
        width: 130px;
    }
</style>


