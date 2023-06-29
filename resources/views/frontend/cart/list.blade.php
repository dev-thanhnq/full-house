@extends('frontend.layouts.master')
@section('breadcrumb')

@endsection

@section('content')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <form id="cart-list" class="clearfix" action="{{ route('frontend.checkout') }}" method="GET">
                    @csrf
                    <div class="col-md-12" id="checkout-form">
                        <div class="order-summary clearfix">
                            <div class="section-title">
                                <h3 class="title">Thông tin giỏ hàng</h3>
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
{{--                                    {{ dd($item) }}--}}
                                    <tr>
                                        <td class="thumb"><img src="/{{ $item->options->image }}" alt=""
                                                               style="width: 200px"></td>
                                        <td class="details">
                                            <a href="#">{{ $item->name }}</a>
                                            <br>
                                            <p class="primary-color">Size: {{ $item->options->attribute_name }}</p>
                                        </td>
                                        <td class="price text-center"><strong>{{ number_format($item->price) }}
                                                VND</strong><br>
                                            @if($item->options->discount_percent > 0)
                                                <del class="font-weak">
                                                    <small>{{ number_format($item->options->origin_price) }} VND</small>
                                                </del>
                                            @endif
                                        </td>
                                        <td class="qty text-center"><input class="input item-qty" type="number"
                                                                           data-id="{{ $item->rowId }}" name="item-qty"
                                                                           value="{{ $item->qty < $item->options->total ?  $item->qty : $item->options->total}}">
                                        </td>
                                        <td class="total text-center"><strong
                                                class="primary-color">{{ number_format($item->price * $item->qty) }}
                                                VND</strong></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
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
                                <button class="primary-btn" type="submit">Thanh toán</button>
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
