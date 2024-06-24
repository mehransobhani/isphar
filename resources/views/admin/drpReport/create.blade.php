@extends('admin.layout.main')

@section('title','ایجاد گزارش drp')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-4 col-md-5 col-12">
                        <h4 class="page-title">
                            <a href="{{ route('drp-report.index') }}">
                                گزارش drp
                            </a>
                            /
                            ایجاد گزارش drp
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
                                    <form action="{{ route('drp-report.store') }}" method="post">
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
                                                    <label for="source">source : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="source"
                                                               name="source">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="status">status : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="status"
                                                               name="status">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="description">توضیحات : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="description"
                                                               name="description">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="form">فرم : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="form"
                                                               name="form">
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
