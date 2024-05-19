@extends('admin.layout.main')

@section('title','ویرایش کاربر')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-4 col-md-5 col-12">
                        <h4 class="page-title">
                            <a href="{{ route('user.index') }}">
                                کاربران
                            </a>
                            /
                            ویرایش کاربر
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
                                    <form action="{{ route('user.update',$model->id) }}" method="post">
                                        @csrf
                                         <input type="hidden" name="id" value="{{$model->id}}">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="mobile">موبایل : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="mobile" value="{{$model->mobile}}"
                                                               name="mobile">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="password">پسورد : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="password" value="{{$model->password}}"
                                                               name="password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="name">نام : </label>
                                                    <div class="input-group">
                                                        <input  type="text" class="form-control" id="name"  value="{{$model->name}}"
                                                               name="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="tell">شماره تلفن : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="tell"  value="{{$model->tell}}"
                                                               name="tell">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="pharmacist_firstname">نام داروساز : </label>
                                                    <div class="input-group">
                                                        <input  type="text" class="form-control" id="pharmacist_firstname"  value="{{$model->pharmacist_firstname}}"
                                                               name="pharmacist_firstname">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="doctor">نام خانوادگی داروساز : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="pharmacist_lastname"  value="{{$model->pharmacist_lastname}}"
                                                               name="pharmacist_lastname">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="medical_code">کد پزشکی   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="medical_code" value="{{$model->medical_code}}"
                                                               name="medical_code">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="sign_image">  تصویر امضا : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="sign_image" value="{{$model->sign_image}}"
                                                               name="sign_image">
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
                                                    <h4 class="card-title"> ویرایش کاربر</h4>
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
