@extends('admin.layout.main')

@section('title','ایجاد شرایط خاص ')
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
                            ایجاد شرایط خاص بیمار
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
                                    <form action="{{ route('PatientSpecialCondition.store') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="user_id">پزشک : </label>
                                                    <div class="input-group">
                                                        <select  class="form-control select2" name="user_id">
                                                            @foreach($users as $user)
                                                            <option value="{{$user->id}}">
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
                                                                <option value="{{$patient->id}}">
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
                                                        <input type="text" class="form-control" id="height" name="height"  >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="national_code">وزن : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="weight" name="weight" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="birth_date">نارسایی کلیوی  : </label>
                                                    <div class="input-group">
                                                        <div class="switchery-demo m-b-30">
                                                            <input type="checkbox" checked class="js-switch" data-color="#f96262"  value="1"id="naresayi_koliavi" name="naresayi_koliavi" >
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="gender">مصرف سیگار : </label>
                                                    <div class="input-group">
                                                        <div class="switchery-demo m-b-30">
                                                            <input type="checkbox" checked class="js-switch" data-color="#f96262"  value="1" id="masrafe_sigar" name="masrafe_sigar">
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="admission_date">کمبود g6pd : </label>
                                                    <div class="input-group">
                                                        <div class="switchery-demo m-b-30">
                                                            <input type="checkbox" checked class="js-switch" data-color="#f96262"  value="1"  id="kambode_g6pd" name="kambode_g6pd">
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="doctor">نارسایی کبدی : </label>
                                                    <div class="input-group">
                                                        <div class="switchery-demo m-b-30">
                                                            <input type="checkbox" checked class="js-switch" data-color="#f96262"  value="1" id="naresayi_kabedi" name="naresayi_kabedi">
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="file_number">رادیولوژی   : </label>
                                                    <div class="input-group">
                                                        <div class="switchery-demo m-b-30">
                                                            <input type="checkbox" checked class="js-switch" data-color="#f96262"  value="1" id="radiology" name="radiology">
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="room_name">مصرف الکل : </label>
                                                    <div class="input-group">
                                                        <div class="switchery-demo m-b-30">
                                                            <input type="checkbox" checked class="js-switch" data-color="#f96262"  value="1" id="masrafe_alcol" name="masrafe_alcol" >
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="room_number">حساسیت دارویی   : </label>
                                                    <div class="input-group">
                                                        <div class="switchery-demo m-b-30">
                                                            <input type="checkbox" checked class="js-switch" data-color="#f96262"  value="1"id="hasasiate_daruyi" name="hasasiate_daruyi"   >
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="bed_number">توضیحات حساسیت دارویی : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="hasasiate_daruyi_desc" name="hasasiate_daruyi_desc" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="cause">سو مصرف مواد   : </label>
                                                    <div class="input-group">
                                                        <div class="switchery-demo m-b-30">
                                                            <input type="checkbox" checked class="js-switch" data-color="#f96262"  value="1"id="soe_masrafe_mavad" name="soe_masrafe_mavad"  >
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source">توضیحات سو مصرف مواد   : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="soe_masrafe_mavad_desc" name="soe_masrafe_mavad_desc"  >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">بارداری : </label>
                                                    <div class="input-group">
                                                        <div class="switchery-demo m-b-30">
                                                            <input type="checkbox" checked class="js-switch" data-color="#f96262"  value="1"id="bardari" name="bardari"  >
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">هفته بارداری : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="bardari_weeks" name="bardari_weeks" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">


                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">آنتی بیوتیک : </label>
                                                    <div class="input-group">
                                                        <div class="switchery-demo m-b-30">
                                                            <input type="checkbox" checked class="js-switch" data-color="#f96262"  value="1"id="anti_biotic" name="anti_biotic"  >
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">نام آنتی بیوتیک : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="anti_biotic_name" name="anti_biotic_name" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">شیردهی : </label>
                                                    <div class="input-group">
                                                        <div class="switchery-demo m-b-30">
                                                            <input type="checkbox" checked class="js-switch" data-color="#f96262"  value="1"id="shirdehi" name="shirdehi"  >
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">واکسن : </label>
                                                    <div class="input-group">
                                                        <div class="switchery-demo m-b-30">
                                                            <input type="checkbox" checked class="js-switch" data-color="#f96262"  value="1"id="vaksan" name="vaksan" >
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="source_number">نام واکسن : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="vaksan_name" name="vaksan_name" >
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

