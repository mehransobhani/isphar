@extends('admin.layout.main')

@section('title','ویرایش خبر')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-4 col-md-5 col-12">
                        <h4 class="page-title">

                            /
بیماران                        </h4>
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
                                    <form action="{{ route('patient.update',$model->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{$model->id}}">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">نام کامل : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $model->fullname }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">کدملی : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="national_code" name="national_code" value="{{ $model->national_code }}">
                                                    </div>
                                                </div>
                                            </div>                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">تاریخ تولد   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="birth_date" name="birth_date" value="{{ $model->birth_date }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">جنسیت : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="gender" name="gender" value="{{ $model->gender }}">
                                                    </div>
                                                </div>
                                            </div>                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">تاریخ تولد   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="birth_date" name="birth_date" value="{{ $model->birth_date }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">admission_date : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="admission_date" name="admission_date" value="{{ $model->admission_date }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">تاریخ تولد   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="file_number" name="file_number" value="{{ $model->file_number }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">admission_date : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="room_name" name="room_name" value="{{ $model->room_name }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">تاریخ تولد   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="room_number" name="room_number" value="{{ $model->room_number }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">admission_date : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="bed_number" name="bed_number" value="{{ $model->bed_number }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">تاریخ تولد   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="cause" name="cause" value="{{ $model->cause }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">admission_date : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="doctor" name="doctor" value="{{ $model->doctor }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">تاریخ تولد   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="source" name="source" value="{{ $model->source }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">admission_date : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="source_number" name="source_number" value="{{ $model->source_number }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class=" col-12">
                                                <textarea type="text" class="form-control" id="description" name="description">{{old('description',$model->description)}}</textarea>
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
                                                    <h4 class="card-title">تاریخ ایجاد : <b class="ltr_text">{{ verta($model->created_at)->format('Y/m/d-H:i')}}</b></h4>
                                                 </div>
                                                <div class="card-footer">
                                                    <small class="text-muted">آخرین به روز رسانی : <b class="ltr_text">{{ verta($model->created_at)->format('Y/m/d-H:i')}}</b></small>
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
