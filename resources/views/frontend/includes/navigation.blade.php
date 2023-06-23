<div id="navigation">
    <!-- container -->
    <div class="container">
        <div id="responsive-nav">
            <!-- category nav -->
            <div class="category-nav show-on-click">
                <span class="category-header">Danh mục sản phẩm <i class="fa fa-list"></i></span>
                <ul class="category-list ">
                    @foreach($listCategories as $category)
                        <li class="dropdown side-dropdown">
                            <a href="{{ route('frontend.product.category', $category->id) }}" class="dropdown-toggle">{{ $category->name }} <i class="fa fa-angle-right"></i></a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- /category nav -->

            <!-- menu nav -->
            <div class="menu-nav">
                <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                <ul class="menu-list">
                    <li><a href="{{ route('frontend.product.index') }}">Tất cả sản phảm</a></li>
                    <li><a href="{{ route('frontend.product.hot') }}">HOT</a></li>
                    <li><a href="{{ route('frontend.product.sale') }}">Khuyến mãi</a></li>
                </ul>
            </div>
            <!-- menu nav -->
        </div>
    </div>
    <!-- /container -->
</div>
