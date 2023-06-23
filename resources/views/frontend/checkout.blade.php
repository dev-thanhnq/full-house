@extends('frontend.layouts.master')
@section('breadcrumb')
    <!-- BREADCRUMB -->
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Trang chủ</a></li>
                <li class="active">Thanh toán</li>
            </ul>
        </div>
    </div>
    <!-- /BREADCRUMB -->
@endsection

@section('content')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <form id="checkout-form" class="clearfix" action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Vui lòng điền thông tin</h3>
                            </div>
                            <div class="form-group">
                                <input class="input"
                                       @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ROLE['customer']) value="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                                       @endif type="text" name="name" placeholder="Tên người nhận">
                            </div>
                            @error('name')
                            <p style="color: red">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <input
                                    @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ROLE['customer']) value="{{\Illuminate\Support\Facades\Auth::user()->email}}"
                                    @endif class="input" type="email" name="email" placeholder="Email">
                            </div>
                            @error('email')
                            <p style="color: red">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <input
                                    @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ROLE['customer']) value="{{\Illuminate\Support\Facades\Auth::user()->phone}}"
                                    @endif class="input" max="12" type="text" name="phone" placeholder="Số điện thoại">
                            </div>
                            @error('phone')
                            <p style="color: red">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <input
                                    @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ROLE['customer']) value="{{\Illuminate\Support\Facades\Auth::user()->address}}"
                                    @endif class="input" max="255" type="text" name="address" placeholder="Địa chỉ">
                            </div>
                            @error('address')
                            <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="shiping-methods">
                            <div class="section-title">
                                <h4 class="title">Phương thức giao hàng</h4>
                            </div>
                            <div class="input-checkbox">
                                <input type="radio" name="shipping_method" id="shipping-1" value="0" checked>
                                <label for="shipping-1">Free Shiping</label>
                                <div class="caption">
                                    <p>
                                        Hàng sẽ được giao trong thời gian 3 đến 4 ngày
                                    </p>
                                </div>
                            </div>
                            <div class="input-checkbox">
                                <input type="radio" name="shipping_method" id="shipping-2" value="1">
                                <label for="shipping-2">Giao hàng nhanh - 30.000 VND</label>
                                <div class="caption">
                                    <p>
                                        Hàng sẽ được giao trong 36h kể từ khi đặt hàng
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="payments-methods">
                            <div class="section-title">
                                <h4 class="title">Phương thức thanh toán</h4>
                            </div>
                            <div class="input-checkbox">
                                <input type="radio" name="payments" id="payments-1" value="pay1" checked>
                                <label for="payments-1">Thanh toán khi nhận hàng</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="order-summary clearfix">
                            <div class="section-title">
                                <h3 class="title">Kiểm tra lại đơn hàng</h3>
                            </div>
                            <table class="shopping-cart-table table">
                                <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th></th>
                                    <th class="text-center">Giá tiền</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Thành tiền</th>
                                    <th class="text-right"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td class="thumb">
                                            @if($item->options->image)
                                                <img src="{{ $item->options->image }}" alt="" style="width: 200px"></td>
                                        @else
                                            <img src="/frontend/img/product-default.jpg" alt=""
                                                 style="width: 200px"></td>
                                        @endif
                                        <td class="details">
                                            <a href="#">{{ $item->name }}</a>
                                        </td>
                                        <td class="price text-center"><strong>{{ number_format($item->price) }}
                                                VND</strong><br>
                                            @if($item->options->discount_percent > 0)
                                                <del class="font-weak">
                                                    <small>{{ number_format($item->options->origin_price) }}
                                                        VND</small></del>
                                            @endif
                                        </td>
                                        <td class="qty text-center">{{ $item->qty }}</td>
                                        <td class="total text-center"><strong
                                                class="primary-color">{{ number_format($item->price * $item->qty) }}
                                                VND</strong></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                {{--                                <tr>--}}
                                {{--                                    <th class="empty" colspan="3"></th>--}}
                                {{--                                    <th>Phí ship</th>--}}
                                {{--                                    <th colspan="2" class="total"> VNĐ</th>--}}
                                {{--                                </tr>--}}
                                <tr>
                                    <th class="empty" colspan="3"></th>
                                    <th>Tổng tiền</th>
                                    <th colspan="2" class="total">{{ Gloudemans\Shoppingcart\Facades\Cart::total() }}
                                        VNĐ
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="pull-right">
                                @if(Gloudemans\Shoppingcart\Facades\Cart::total() == 0)
                                    <button class="primary-btn" type="submit" disabled>Xác nhận thanh toán</button>
                                @else
                                    <button class="primary-btn" type="submit">Xác nhận thanh toán</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection
