@extends('admin.layout.main')

@section('title','ایجاد تلفیق دارویی')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-4 col-md-5 col-12">
                        <h4 class="page-title">
                            <a href="{{ route('patient_drug.index') }}">
                                تلفیق دارویی
                            </a>
                            /
                           ایجاد تلفیق دارویی
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
                                    <form action="{{ route('patient_drug.store') }}" method="post">
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
                                                    <label for="drug_id">دارو : </label>
                                                    <div class="input-group">
                                                        <select  class="form-control select2"name="drug_id">
                                                            <option>
                                                                0
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="type">نوع دارو : </label>
                                                    <div class="input-group">
                                                        <select  class="form-control select2"name="type">
                                                            @foreach(config("PatientDrug.type") as $item)
                                                            <option value="{{$item["id"]}}">
                                                                {{$item["name"]}}
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
                                                    <label for="name">نام : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="name" name="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="gender">فواصل مصرف : </label>
                                                    <div class="input-group">
                                                         <select  class="form-control select2"name="usage_intervals">
                                                             @foreach(config("PatientDrug.usage_intervals") as $item) @endforeach
                                                            <option value="{{$item}}">
                                                                {{$item}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last_dose_date">زمان آخرین دوز مصرف : </label>
                                                    <div class="input-group">
                                                        <input type="datetime-local" class="form-control"
                                                               id="last_dose_date" name="last_dose_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="doctor">مقدار دوز : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="dose_amount"
                                                               name="dose_amount">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="doctor_order">دستور پزشک معالج : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="doctor_order"
                                                               name="doctor_order">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="has_alert">دارای هشدار : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="has_alert"
                                                               name="has_alert">
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
