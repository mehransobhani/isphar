@extends('admin.layout.main')

@section('title','مشاهده اطلاعات مدیر')
@section('content')
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-4 col-md-5 col-12">
            <h4 class="page-title">
              <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
              /
              <a href="{{ route('admin.admin.index') }}">
                مدیران
              </a>
              /
              ویرایش مدیر {{$admin->id}}
            </h4>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <div class="white-box">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                  @if ($errors->any())
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
                      <form action="{{ route('admin.admin.update',$admin->id)}}" method="post"
                            class="form-material form-horizontal">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $admin->id }}">
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <label for="name">نام : </label>
                              <div class="input-group">
                                <input type="text" class="form-control form-control-line text-left pr-3" id="name"
                                       name="name" value="{{ $admin->name }}" style="direction: ltr;">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <label for="email">ایمیل : </label>
                              <div class="input-group">
                                <input type="text" class="form-control form-control-line text-left pr-3" id="email"
                                       name="email" value="{{ $admin->email }}" style="direction: ltr;">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <label for="wallet">کیف پول : </label>
                              <div class="input-group">
                                <input type="text" class="form-control form-control-line text-left pr-3" id="wallet"
                                       name="wallet" value="{{ $admin->wallet }}" style="direction: ltr;">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <label for="point">امتیاز : </label>
                              <div class="input-group">
                                <input type="text" class="form-control form-control-line text-left pr-3" id="point"
                                       name="point" value="{{ $admin->point }}" style="direction: ltr;">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <label for="user_id">شناسه تلگرام : </label>
                              <div class="input-group">
                                <input type="text" class="form-control form-control-line text-left pr-3" id="user_id"
                                       name="user_id" value="{{ $admin->user_id }}" style="direction: ltr;">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <label for="card_number">شماره کارت : </label>
                              <div class="input-group">
                                <input type="text" class="form-control form-control-line text-left pr-3"
                                       id="card_number" name="card_number" value="{{ $admin->card_number }}"
                                       style="direction: ltr;">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <label for="user_id"> نقش : </label>
                              <div class="input-group">
                                <select name="role[]" class="form-control" multiple>
                                  @foreach(\App\Enum\Roles::cases() as $role)
                                    <option value="{{$role->value}}"
                                        @if($admin->hasRole($role->value)) selected @endif>
                                        {{$role->text()}}
                                    </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <label for="user_id"> وضعیت : </label>
                              <div class="input-group">
                                <select name="status" class="form-control" >
                                  @foreach(\App\Enum\AdminStatus::cases() as $status)
                                    <option value="{{$status->value}}"
                                        @if($admin->status && $status->value==$admin->status->value) selected @endif>
                                        {{$status->text()}}
                                    </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                              <div class="text-center">
                                <button type="reset" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-lg-3 col-md-12 col-12">
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                          <div class="card">
                            <div class="card-block">
                              <h4 class="card-title">تاریخ ایجاد : <b class="ltr_text">{{ verta($admin->created_at)->format('Y/m/d-H:i')}}</b></h4>
                              <p>
                                <a class="w-100 btn btn-rounded btn-youtube p-3" href="{{ route('admin.admin-log', $admin->id) }}" target="_blank">
                                  مشاهده لاگ ها
                                </a>
                              </p>
                            </div>
                            <div class="card-footer">
                              <small class="text-muted">آخرین به روز رسانی : <b
                                  class="ltr_text">{{ verta($admin->updated_at)->format('Y/m/d-H:i')}}</b></small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">

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
