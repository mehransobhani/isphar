@extends('admin.layout.main')

@section('title','ویرایش دارو')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-4 col-md-5 col-12">
                        <h4 class="page-title">
                            <a href="{{ route('drug.index') }}">
                                دارو
                            </a>
                            /
                            ویرایش دارو
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
                                    <form action="{{ route('drug.update',$model->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                         <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="fa_name">نام فارسی : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="fa_name" value="{{$model->fa_name}}"
                                                               name="fa_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="en_name">نام انگلیسی : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="en_name" value="{{$model->en_name}}"
                                                               name="en_name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="fa_brand">نام برند فارسی : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="fa_brand" value="{{$model->fa_brand}}"
                                                               name="fa_brand">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="en_brand">نام برند انگلیسی : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="en_brand" value="{{$model->en_brand}}"
                                                               name="en_brand">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="usage_way">طریقه مصرف : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="usage_way" value="{{$model->usage_way}}"
                                                               name="usage_way">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="shape">شکل : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="shape" value="{{$model->shape}}"
                                                               name="shape">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="strength">قدرت : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="strength" value="{{$model->strength}}"
                                                               name="strength">
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
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="card">
                                                <div class="card-block">
                                                    <h4 class="card-title"> ویرایش دارو</h4>
                                                </div>
                                                <div class="card-footer">
                                                    <small class="text-muted">تاریخ ایجاد: <b class="ltr_text">{{ verta($model->created_at)->format('Y/m/d-H:i')}}</b></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
