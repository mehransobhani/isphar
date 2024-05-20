@extends('admin.layout.main')

@section('title','ویرایش شرایط خاص بیمار')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-4 col-md-5 col-12">
                        <h4 class="page-title">
                            <a href="{{ route('PatientSpecialCondition.index') }}">
                                شرایط خاص بیماران
                            </a>
                            /
                            ویرایش شرایط خاص بیمار
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
                                    <form action="{{ route('PatientSpecialCondition.update',$model->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{$model->id}}">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="user_id">پزشک : </label>
                                                    <div class="input-group">
                                                        <select  class="form-control select2" name="user_id">
                                                            @foreach($users as $user)
                                                                <option value="{{$user->id}}" @selected(old('user_id',$model->user_id ) == $user->id)>
                                                                    {{$user->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">

                                                <div class="form-group">
                                                    <label for="patient_id">بیمار : </label>
                                                    <div class="input-group">
                                                        <select  class="form-control select2"name="patient_id">
                                                            @foreach($patients as $patient)
                                                                <option value="{{$patient->id}}" @selected(old('patient_id',$model->patient_id ) == $patient->id)>
                                                                    {{$patient->fullname}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="fullname">قد : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="height" name="height" value="{{ $model->height }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="national_code">وزن : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="weight" name="weight" value="{{ $model->weight }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="birth_date">نارسایی کلیوی  : </label>
                                                    <div class="input-group">
                                                           <input  type="checkbox" @checked($model->naresayi_koliavi) class="js-switch" data-color="#f96262"   id="naresayi_koliavi" name="naresayi_koliavi" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="gender">مصرف سیگار : </label>
                                                    <div class="input-group">
                                                           <input  type="checkbox" @checked($model->masrafe_sigar) class="js-switch" data-color="#f96262"   id="masrafe_sigar" name="masrafe_sigar" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="admission_date">کمبود g6pd : </label>
                                                    <div class="input-group">
                                                           <input  type="checkbox" @checked($model->kambode_g6pd) class="js-switch" data-color="#f96262"   id="kambode_g6pd" name="kambode_g6pd" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="doctor">نارسایی کبدی : </label>
                                                    <div class="input-group">
                                                           <input  type="checkbox" @checked($model->naresayi_kabedi) class="js-switch" data-color="#f96262"   id="naresayi_kabedi" name="naresayi_kabedi" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="file_number">رادیولوژی   : </label>
                                                    <div class="input-group">
                                                           <input  type="checkbox" @checked($model->radiology) class="js-switch" data-color="#f96262"   id="radiology" name="radiology" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="room_name">مصرف الکل : </label>
                                                    <div class="input-group">
                                                           <input  type="checkbox" @checked($model->masrafe_alcol) class="js-switch" data-color="#f96262"   id="masrafe_alcol" name="masrafe_alcol" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="room_number">حساسیت دارویی   : </label>
                                                    <div class="input-group">
                                                           <input  type="checkbox" @checked($model->hasasiate_daruyi) class="js-switch" data-color="#f96262"   id="hasasiate_daruyi" name="hasasiate_daruyi" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="bed_number">توضیحات حساسیت دارویی : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="hasasiate_daruyi_desc" name="hasasiate_daruyi_desc" value="{{ $model->hasasiate_daruyi_desc }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="cause">سو مصرف مواد   : </label>
                                                    <div class="input-group">
                                                           <input  type="checkbox" @checked($model->soe_masrafe_mavad) class="js-switch" data-color="#f96262"   id="soe_masrafe_mavad" name="soe_masrafe_mavad" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source">توضیحات سو مصرف مواد   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="soe_masrafe_mavad_desc" name="soe_masrafe_mavad_desc" value="{{ $model->soe_masrafe_mavad_desc }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">بارداری : </label>
                                                    <div class="input-group">
                                                           <input  type="checkbox" @checked($model->bardari) class="js-switch" data-color="#f96262"   id="bardari" name="bardari" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">هفته بارداری : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="bardari_weeks" name="bardari_weeks" value="{{ $model->bardari_weeks }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">


                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">آنتی بیوتیک : </label>
                                                    <div class="input-group">
                                                           <input  type="checkbox" @checked($model->anti_biotic) class="js-switch" data-color="#f96262"   id="anti_biotic" name="anti_biotic" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">نام آنتی بیوتیک : </label>
                                                    <div class="input-group">
                                                           <input  type="text"  class="form-control"   id="anti_biotic_name" name="anti_biotic_name" value="{{ $model->anti_biotic_name }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">شیردهی : </label>
                                                    <div class="input-group">
                                                        <input  type="checkbox" @checked($model->shirdehi) class="js-switch" data-color="#f96262"   id="shirdehi" name="shirdehi" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">واکسن : </label>
                                                    <div class="input-group">
                                                        <input  type="checkbox" @checked($model->vaksan) class="js-switch" data-color="#f96262"  id="vaksan" name="vaksan" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">نام واکسن : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="vaksan_name" name="vaksan_name" value="{{ $model->vaksan_name }}">
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
                                                    <h4 class="card-title"> ویرایش شرایط خاص بیمار</h4>
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
