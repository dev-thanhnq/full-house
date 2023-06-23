@extends('frontend.layouts.master')
@section('breadcrumb')
    <!-- BREADCRUMB -->
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Trang chủ</a></li>
                <li class="active">Sản phẩm</li>
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
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside widget -->

{{--                    <div class="aside">--}}
{{--                        <h3 class="aside-title">Sắp xếp</h3>--}}
{{--                        <div class="sort-filter">--}}
{{--                            <select name="orderBy" class="input" id="order-select">--}}
{{--                                <option value="DESC">Giá cao -> thấp</option>--}}
{{--                                <option value="ASC">Giá thấp -> cao</option>--}}
{{--                            </select>--}}
{{--                            <a href="#" class="main-btn icon-btn"><i class="fa fa-arrow-down"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="aside">
                        <h3 class="aside-title">Thể loại</h3>
                        <ul class="list-links">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('frontend.product.category', $category->id) }}">{{$category->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /aside widget -->
                </div>
                <!-- /ASIDE -->
                <!-- MAIN -->
                <div id="main" class="col-md-9">
                    <!-- STORE -->
                    <div id="store">
                        <!-- row -->
                        <div class="row">
                            <!-- Product Single -->
                            @if(count($products) == 0)
                                <div style="text-align: center">
                                    <center>Không có sản phẩm</center>
                                </div>
                            @else
                                @foreach($products as $product)
                                    <!-- Product Single -->
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="product product-single">
                                            <div class="product-thumb">
                                                <div class="product-label">
                                                    @if($product->discount_percent != 0)
                                                        <span class="sale">-{{ $product->discount_percent }}%</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('frontend.product-page.index', $product->slug) }}">
                                                    <button class="main-btn quick-view"><i
                                                            class="fa fa-search-plus"></i> Xem
                                                    </button>
                                                </a>
                                                @if($product->image)
                                                    <img src="/{{ $product->image }}" alt="">
                                                @else
                                                    <img src="/frontend/img/product-default.jpg"></img>
                                                @endif
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-price">{{ number_format($product->sale_price) }}
                                                    VND @if($product->discount_percent != 0)
                                                        <del
                                                            class="product-old-price">{{ number_format($product->origin_price) }}
                                                            VND
                                                        </del>
                                                    @endif</h3>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o empty"></i>
                                                </div>
                                                <h2 class="product-name"><a href="{{ route('frontend.product-page.index', $product->slug) }}">{{ $product->name }}</a></h2>
                                                <span>Đã bán: {{ $product->sold }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Product Single -->
                                @endforeach
                            @endif
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /STORE -->
                </div>
                <!-- /MAIN -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection
