@extends('frontend.layouts.master')
@section('breadcrumb')
    <!-- BREADCRUMB -->
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('frontend.home.index')}}">Trang chủ</a></li>
                <li class="active">{{ $product->name }}</li>
            </ul>
        </div>
    </div>
    <style>
        .buttons {
            background: #dfdfdf;
            padding: 4px;
            border-radius: 3px;
            position: relative;
            width: fit-content;
            margin: 10px 0 30px 0;
        }

        .buttons input {
            appearance: none;
            cursor: pointer;
            border-radius: 2px;
            padding: 5px 10px;
            background: #3f414d;
            color: #ececec;
            font-size: 15px;
            font-family: sans-serif;
            transition: all 0.1s;
        }

        .buttons input:checked {
            background: #f8694a;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 0px #808080;
        }

        .buttons input::before {
            content: attr(label);
            text-align: center;
        }
    </style>
    <!-- /BREADCRUMB -->
    <script type="text/javascript">
        function getProductAttribute(data) {
            var price = document.getElementById("product-price");
            var total = document.getElementById("total");
            var product_attribute_id = document.getElementById("product-attribute-id");
            product_attribute_id.setAttribute('value', data.value);
            price.innerHTML = data.getAttribute('price');
            total.innerHTML = data.getAttribute('total');
        }
    </script>
@endsection

@section('content')
    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!--  Product Details -->
                <div class="product product-details clearfix">
                    <div class="col-md-6">
                        <div id="product-main-view">
                            <div class="product-view">
                                <img src="/{{ $product->image }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-body">
                            <div class="product-label">
                                @if($product->discount_percent != 0)
                                    <span class="sale">-{{ $product->discount_percent }}%</span>
                                @endif
                            </div>
                            <h2 style="font-family: Arial" class="product-name">{{ $product->name }}</h2>
                            <p style="font-size: 18px; font-family: 'system-ui'">
                                <strong>Trạng thái:</strong>
                                @if($product->status == 0)
                                    Tạm khóa
                                @elseif($product->status == 1)
                                    Còn hàng
                                @elseif($product->status == 2)
                                    Hết hàng
                                @endif
                            </p>
                            @if(isset($product->category))
                            <p style="font-size: 18px; font-family: 'system-ui'"><strong>Danh mục:</strong> {{ $product->category->name }}</p>
                            @endif
                            <p style="font-size: 18px; font-family: 'system-ui'"><strong>Số lượng tồn kho:</strong> <span id="total">{{ number_format($product->attributes[0]->total) }}</span></p>
                            <p style="font-size: 18px; font-family: 'system-ui'"><strong>Nhà sản xuất:</strong> {{ $product->publishing_company ? $product->publishing_company->name : 'Đang cập nhật' }}
                            </p>
                            <div class="buttons">
                            @foreach($product->attributes as $key => $attribute)
                                <input
                                    label="{{ $attribute->name }}"
                                    type="radio"
                                    name="product_attribute"
                                    id="inlineRadio1"
                                    value="{{ $attribute->id }}"
                                    price="{{ $attribute->price }}"
                                    total="{{ $attribute->total }}"
                                    onclick="getProductAttribute(this);"
                                    @if($key === 0)
                                        checked
                                    @endif>
                            @endforeach
                            </div>
                            <h3 class="product-price" id="product-price">{{ $product->attributes[0]->price }}</h3>

                            <div class="product-btns">
                                <form method="post" action="{{ route('frontend.cart.add') }}">
                                @csrf
                                    <input name="attribute_id" type="text" id="product-attribute-id" hidden value="{{ $product->attributes[0]->id }}">
                                    <button type="submit"
                                            class="primary-btn add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Thêm vào giỏ hàng
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="product-options">
                            <h2>Mô tả sản phẩm</h2>
                        </div>
                        <p style="font-size: 18px; font-family: 'system-ui'">{!! $product->content !!} </p>

                    </div>
                </div>
                <!-- /Product Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->

    <!-- section -->
@endsection
