@extends('backend.layouts.master')
@section('header-content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Chỉnh sửa sản phẩm</h1>
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
                    <li class="breadcrumb-item active">Chỉnh sửa</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('backend.product.update', $product->id) }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm <span style="color: red"> *</span></label>
                                <input type="text" class="form-control" id="" placeholder="Nhập tên sản phẩm "
                                       name="name" value="{{ $product->name }}">
                                @error('name')
                                <p style="color: #ff0000">*{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Danh mục sản phẩm</label>
                                        <select class="form-control select2" style="width: 100%;" name="category_id">
                                            <option value="">--Chọn danh mục---</option>
                                            @foreach($categories as $category)
                                                @if($category->id == $product->category_id)
                                                    <option value="{{ $category->id }}"
                                                            selected>{{ $category->name }}</option>
                                                @endif
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nhà sản xuất</label>
                                        <select class="form-control select2" style="width: 100%;"
                                                name="publishing_company_id">
                                            <option value="">--Chọn NXB---</option>
                                            @foreach($publishings as $publishing)
                                                @if($publishing->id == $product->publishing_company_id)
                                                    <option value="{{ $publishing->id }}"
                                                            selected>{{ $publishing->name }}</option>
                                                @endif
                                                <option value="{{ $publishing->id }}">{{ $publishing->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('publishing_company_id')
                                        <p style="color: red">*{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{--                                <div class="col-4">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Giá bán <span style="color: red"> *</span></label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Nhập giá gốc"--}}
{{--                                               name="origin_price" value="{{ $product->origin_price }}">--}}
{{--                                        @error('origin_price')--}}
{{--                                        <p style="color: red">*{{ $message }}</p>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-4">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Phần trăm giảm giá</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Nhập %"--}}
{{--                                               name="discount_percent" value="{{ $product->discount_percent }}">--}}
{{--                                        @error('discount_percent')--}}
{{--                                        <p style="color: red">{{ $message }}</p>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Số lượng <span style="color: red"> *</span></label>
                                        <input value="{{ $product->total }}" type="number" min="1"
                                               class=" form-control input-element2"
                                               placeholder="Nhập số lượng"
                                               name="total">
                                        @error('total')
                                        <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                                <textarea class="textarea" placeholder="Place some text here"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          name="content">{{ $product->content }}</textarea>
                                @error('content')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputFile">Hình ảnh sản phẩm</label>--}}
{{--                                <div class="input-group">--}}
{{--                                    <div class="custom-file">--}}
{{--                                        <input type="file" class="custom-file-input" id="exampleInputFile">--}}
{{--                                        <label class="custom-file-label" for="exampleInputFile">Chọn tệp</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="input-group-append">--}}
{{--                                        <span class="input-group-text" id="">Upload</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label>Trạng thái sản phẩm</label>
                                <select class="form-control select2" style="width: 100%;" name="status">
                                    <option value="0" @if($product->status == 0) selected @endif>Đang nhập</option>
                                    <option value="1" @if($product->status == 1) selected @endif>Mở bán</option>
                                </select>
                                @error('status')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     fill="currentColor"
                                     class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                    <path
                                        d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                </svg>
                                Lưu
                            </button>
                            <a href="{{route('backend.product.index')}}" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                Hủy bỏ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@endsection
