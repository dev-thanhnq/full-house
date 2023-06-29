@extends('backend.layouts.master')

@section('header-content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Chi tiết đơn hàng</h1>
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

@section('script')

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <table class="table table-bordered table-striped" style="width: 100%">
                                <tr>
                                    <th>Tên người nhận</th>
                                    <td>{{ $order->customer_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $order->customer_email }}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td>{{ $order->customer_phone }}</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td>{{ $order->customer_address }}</td>
                                </tr>
                                <tr>
                                    <th>Tổng tiền</th>
                                    <td>{{ $order->money }} VND</td>
                                </tr>
                                <tr>
                                    <th>Phí giao hàng</th>
                                    <td>{{ $order->shipping_method == 0 ? 'Miễn phí' : '30,000 VND' }}</td>
                                </tr>
                                <tr>
                                    <th>Thời gian đặt hàng</th>
                                    <td>{{ date_format($order->created_at, "d/m/Y") }}</td>
                                </tr>
                            </table>

                            <h2>Danh sách sản phẩm</h2>
                            <table class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th style="text-align: center">Số lượng</th>
                                    <th>Giá bán</th>
{{--                                    <th>Giá khuyến mại</th>--}}
                                    <th>Thành tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attributes as $attribute)
                                    <tr>
                                        <td><a style="text-decoration: none"
                                               href="{{ route('backend.product.show', $attribute->product->id) }}">{{ $attribute->product->name }}</a>
                                        </td>
                                        <td style="text-align: center">{{number_format($attribute->total_order)}}</td>
                                        <td>{{number_format($attribute->price)}} VND</td>
{{--                                        <td>{{number_format($attribute->product->sale_price)}} VND</td>--}}
                                        <td>{{number_format($attribute->price * $attribute->total_order)}} VND</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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
<style>
    .card {
        height: 100vh;
    }
</style>



