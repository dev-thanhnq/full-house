@extends('backend.layouts.master')

@section('header-content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Đơn hàng chờ phê duyệt</h1>
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

{{--@section('script')--}}
{{--    <script>--}}
{{--        $(document).ready(function (){--}}
{{--            $('#ordersNonAcceptTable').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                ajax: '/orders/get-non-accept',--}}
{{--                columns: [--}}
{{--                    { data: 'id', name: 'id' },--}}
{{--                    { data: 'customer_name', name: 'customer_name' },--}}
{{--                    { data: 'customer_email', name: 'email' },--}}
{{--                    { data: 'customer_phone', name: 'phone' },--}}
{{--                    { data: 'customer_address', name: 'address' },--}}
{{--                    { data: 'products_count', name: 'products_count' },--}}
{{--                    { data: 'shipping', name: 'shipping' },--}}
{{--                    { data: 'money', name: 'money' },--}}
{{--                    { data: 'action' },--}}
{{--                ]--}}
{{--            })--}}
{{--        });--}}
{{--        $('#ordersNonAcceptTable').on('click', '.order-accept', function () {--}}
{{--            var id = $(this).attr('data-id');--}}
{{--            $.ajax({--}}
{{--                type: 'put',--}}
{{--                url: '/orders/accept/' + id,--}}
{{--                success: function (res) {--}}
{{--                    if (!res.error) {--}}
{{--                        $('#ordersNonAcceptTable').DataTable().ajax.reload();--}}
{{--                        toastr.success(res.message);--}}
{{--                    }else{--}}
{{--                        toastr.error(res.message);--}}
{{--                    }--}}
{{--                }--}}
{{--            })--}}
{{--        });--}}
{{--        $('#ordersNonAcceptTable').on('click', '.order-delete', function () {--}}
{{--            var id = $(this).attr('data-id');--}}
{{--            $.ajax({--}}
{{--                type: 'delete',--}}
{{--                url: '/orders/delete/' + id,--}}
{{--                success: function (res) {--}}
{{--                    if (!res.error) {--}}
{{--                        $('#ordersNonAcceptTable').DataTable().ajax.reload();--}}
{{--                        toastr.success(res.message);--}}
{{--                    }else{--}}
{{--                        toastr.error(res.message);--}}
{{--                    }--}}
{{--                }--}}
{{--            })--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th>Tên người nhận</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th style="text-align: center">Số sản phẩm</th>
                                <th style="text-align: center">Giao hàng</th>
                                <th style="text-align: center">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td style="text-align: center">{{$order->id}}</td>
                                    <td>{{$order->customer_name}}</td>
                                    <td>{{$order->customer_email}}</td>
                                    <td>{{$order->customer_phone}}</td>
                                    <td>{{$order->customer_address}}</td>
                                    <td style="text-align: center">{{$order->products_count}}</td>
                                    @if ($order->shipping_method == 0)
                                        <td style="text-align: center"><span
                                                class="badge badge-secondary">Free shipping</span></td>
                                    @else
                                        <td style="text-align: center"><span class="badge badge-info">Giao nhanh</span>
                                        </td>
                                    @endif
                                    <td style="text-align: center">
                                        {{--                                        <form action="{{ route('order.destroy', $order->id) }}"--}}
                                        {{--                                              method="POST">--}}
                                        {{--                                            {{ csrf_field() }}--}}
                                        {{--                                            {{ method_field('DELETE') }}--}}
                                        <a href="{{route('order.show', $order->id)}}" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-info" viewBox="0 0 16 16">
                                                <path
                                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                            </svg>
                                            Chi tiết</a>
                                        <a href="{{route('order.accept', $order->id)}}" class="btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                <path
                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                            </svg>
                                            Duyệt</a>
                                        {{--                                            <button class="btn btn-danger"><i class="fa fa-btn fa-trash"></i> Xóa--}}
                                        {{--                                            </button>--}}
                                        {{--                                        </form>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
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


