@extends('admin.layout.main')

@section('title',' افزودن بیمار')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-4 col-md-5 col-12">
                        <h4 class="page-title">

                            <a href="{{ route('patient.index') }}">
                                بیماران
                            </a>
                            /
                        ایجاد بیمار
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
                                    <form action="{{ route('patient.store')}}" method="post">
                                        @csrf

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="fullname">نام کامل : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="fullname"
                                                               name="fullname">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="national_code">کدملی : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="national_code"
                                                               name="national_code">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="birth_date">تاریخ تولد : </label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" id="birth_date"
                                                               name="birth_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="gender">جنسیت : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="gender"
                                                               name="gender">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="admission_date">تاریخ بستری : </label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" id="admission_date"
                                                               name="admission_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="doctor">دکتر : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="doctor"
                                                               name="doctor">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="file_number">شماره فایل   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="file_number"
                                                               name="file_number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="room_name">نام اتاق : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="room_name"
                                                               name="room_name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="room_number">شماره اتاق   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="room_number"
                                                               name="room_number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="bed_number">شماره تخت : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="bed_number"
                                                               name="bed_number">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="cause">علت   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="cause" name="cause">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source">منبع   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="source"
                                                               name="source">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">شماره منبع : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="source_number"
                                                               name="source_number">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class=" col-12">
                                                <label for="description">توضیحات : </label>

                                                <textarea type="text" class="form-control" id="description"
                                                          name="description"> </textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-12">
                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <button type="reset"
                                                                class="btn btn-inverse waves-effect waves-light">انصراف
                                                        </button>
                                                        <button type="submit"
                                                                class="btn btn-success waves-effect waves-light m-l-10">
                                                            ثبت
                                                        </button>
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
