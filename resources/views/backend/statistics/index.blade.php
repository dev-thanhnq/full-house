@extends('backend.layouts.master')
@section('header-content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Thống kê {{request()->is('admin/statistics/30-days-ago') ? '30' : '7'}} ngày qua</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ count($monthOrder) }}</h3>

                        <p>Đơn hàng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    {{--                    <a href="{{ route('order.index') }}" class="small-box-footer">Xem thêm <i--}}
                    {{--                            class="fas fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $monthProduct }}</h3>

                        <p>Sản phẩm</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    {{--                    <a href="{{ route('backend.product.index') }}" class="small-box-footer">Xem thêm <i--}}
                    {{--                            class="fas fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
            <!-- ./col -->
            {{--            <div class="col-lg-3 col-6">--}}
            {{--                <!-- small box -->--}}
            {{--                <div class="small-box bg-warning">--}}
            {{--                    <div class="inner">--}}
            {{--                        <h3>{{ $count_users }}</h3>--}}

            {{--                        <p>Người dùng</p>--}}
            {{--                    </div>--}}
            {{--                    <div class="icon">--}}
            {{--                        <i class="ion ion-person-add"></i>--}}
            {{--                    </div>--}}
            {{--                    <a href="{{route('backend.customer')}}" class="small-box-footer">Xem thêm <i--}}
            {{--                            class="fas fa-arrow-circle-right"></i></a>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="col-lg-4 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ number_format($monthMoney) }} VND</h3>

                        <p>Doanh thu</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    {{--                    <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            {{--            <div class="col-lg-6 col-6">--}}
            {{--                <div style="padding: 20px;" class="card">--}}
            {{--                    <h4>--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"--}}
            {{--                             class="bi bi-box" viewBox="0 0 16 16">--}}
            {{--                            <path--}}
            {{--                                d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>--}}
            {{--                        </svg>--}}
            {{--                        Sản phẩm sắp hết hàng--}}
            {{--                    </h4>--}}
            {{--                    <div class="table-wrapper-scroll my-custom-scrollbar" style="height: 52vh;overflow-y: auto">--}}
            {{--                        <table class="table table-bordered table_staff_list" style="width: 100%;">--}}
            {{--                            <thead class="thead-light" style="background-color: #fff;">--}}
            {{--                            <tr>--}}
            {{--                                <th style="">Tên sản phẩm</th>--}}
            {{--                                <th style="text-align: center;">Giảm giá</th>--}}
            {{--                                <th style="position: sticky">Giá bán</th>--}}
            {{--                                <th style="text-align: center;">Còn lại</th>--}}
            {{--                            </tr>--}}
            {{--                            </thead>--}}
            {{--                            <tbody>--}}
            {{--                            @foreach($products as $product)--}}
            {{--                                <tr>--}}
            {{--                                    <td style=";overflow: hidden;--}}
            {{--  white-space: nowrap;--}}
            {{--  text-overflow: ellipsis;--}}
            {{--  max-width: 280px;">--}}
            {{--                                        <a style="text-decoration: none  "--}}
            {{--                                           href="{{ route('backend.product.show', $product->id) }}">{{ $product->name }}</a>--}}
            {{--                                    </td>--}}
            {{--                                    <td style="text-align: center"><span class="badge badge-success">{{ $product->discount_percent }}%</span>--}}
            {{--                                    </td>--}}
            {{--                                    <td>{{number_format($product->sale_price)}} VND</td>--}}
            {{--                                    <td style="text-align: center">{{ number_format($product->total) }}</td>--}}
            {{--                                </tr>--}}
            {{--                            @endforeach--}}
            {{--                            </tbody>--}}
            {{--                        </table>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            <div class="col-lg-12 col-12">
                <div style="padding: 20px" class="card">
                    <h4>
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                             class="bi bi-cart-dash" viewBox="0 0 16 16">
                            <path d="M6.5 7a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z"/>
                            <path
                                d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                        Đơn hàng {{request()->is('admin/statistics/30-days-ago') ? '30' : '7'}} ngày qua
                    </h4>
                    <div class="table-wrapper-scroll my-custom-scrollbar" style="height: 52vh;overflow-y: auto">
                        <table class="table table-bordered table_staff_list" style="width: 100%;  overflow-y: auto">
                            <thead class="thead-light">
                            <tr>
                                <th>Tên người nhận</th>
                                <th>SĐT</th>
                                <th>Địa chỉ</th>
                                <th>Tổng tiền</th>
                                <th style="text-align: center">Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($monthOrder as $order)
                                <tr>
                                    <td style=";overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  max-width: 160px;">{{$order->customer_name}}</td>
                                    <td style=";overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  max-width: 110px;">{{$order->customer_phone}}</td>
                                    <td style=";overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  max-width: 210px;">{{$order->customer_address}}</td>
                                    <td>{{ $order->money }} VND</td>
                                    @if ($order->status == 1)
                                        <td style="text-align: center"><span
                                                class="badge badge-warning">Chờ duyệt</span></td>
                                    @elseif ($order->status == 2)
                                        <td style="text-align: center"><span class="badge badge-primary">Đã duyệt</span>
                                        </td>
                                    @else
                                        <td style="text-align: center"><span class="badge badge-success">Đã giao</span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .table-wrapper-scroll thead th {
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .my-custom-scrollbar {
            position: relative;
            overflow: auto;
            height: calc(100vh - 340px);
        }

        .table-wrapper-scroll {
            display: block;
        }
    </style>
@endsection
