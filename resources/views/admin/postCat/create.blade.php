@extends('admin.layout.main')

@section('title','ایجاد دسته بندی بلاگ')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-4 col-md-5 col-12">
                        <h4 class="page-title">
                            <a href="{{ route('post_cat.index') }}">
                                دسته بندی بلاگ
                            </a>
                            /
                            ایجاد دسته بندی بلاگ
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="white-box">
                            @if ($errors && $errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                        </button>
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-9 col-md-12 col-12">
                                    <form action="{{ route('post_cat.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="fa_name">نام   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="fa_name"
                                                               name="fa_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="en_name">نام مستعار : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="en_name"
                                                               name="en_name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class=" col-12">
                                                <div class="form-group">
                                                    <label for="image">عکس : </label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="image"
                                                               name="image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-12">
                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <button type="reset" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                                                        <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
