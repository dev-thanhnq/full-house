@extends('backend.layouts.master')
@section('header-content')

@endsection
@section('content')
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-danger"></h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Có lỗi xảy ra.</h3>

                <p>
                    Bạn không có quyền thực hiện thao tác này!!!
                </p>

                <form class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm">

                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-danger"><i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.input-group -->
                </form>
            </div>
        </div>
        <!-- /.error-page -->

    </section>
@endsection
