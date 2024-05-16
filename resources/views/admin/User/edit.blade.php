@extends('admin.layout.main')

@section('title', 'کاربران')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-12 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            <a href="{{ route('admin.user.index') }}">
              کاربران
            </a>
            /
            مدیریت کاربر ({{$user->user_id}})
          </h4>
        </div>
        <!-- /.col-lg-12 -->
      </div>
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
        <div class="col-lg-4 col-md-12">
          <div class="white-box">
            <div class="user-btm-box">
              <div class="row text-center">
                <div class="col-md-6 b-l"><strong>نام و نام خانوادگی :</strong>
                  <p>{{$user->full_name}}</p>
                </div>
                <div class="col-md-6">
                  <strong class="float-left">گروه :</strong>
                  <p class="float-right m-10"><span
                      class="label label-table @if($user->group_id == \App\Enum\UserGroupEnum::LevelZero) label-info @elseif ($user->group_id == \App\Enum\UserGroupEnum::Plus) label-success @elseif ($user->group_id == \App\Enum\UserGroupEnum::Premium) label-red @elseif ($user->group_id == \App\Enum\UserGroupEnum::Business) label-inverse @endif">{{$user->group_id->name}}</span>
                  </p>
                </div>
              </div>
              <hr>
              <div class="row text-center m-t-10">
                <div class="col-md-6 b-l"><strong>شناسه تلگرام : </strong>
                  <p><span class="ltr_text">{{$user->user_id}}</span></p>
                </div>
                <div class="col-md-6"><strong class="float-left">وضعیت حساب : </strong>
                  <p class="float-right m-10">
                  <span
                    class="label label-table @if($user->status == \App\Enum\UserStatus::Active) label-success @elseif ($user->status == \App\Enum\UserStatus::Inactive) label-red @elseif ($user->status == \App\Enum\UserStatus::Suspend) label-warning @endif">
                      {{$user->status->name}}
                  </span>
                  </p>
                </div>
              </div>
              <hr>
              <div class="row text-center m-t-10">
                <div class="col-md-6 b-l"><strong>تاریخ شروع فعالیت : </strong>
                  <p><b class="ltr_text">{{ verta($user->created_at)->format('Y/m/d-H:i')}}</b></p>
                </div>
                <div class="col-md-6"><strong class="float-left">آخرین بروز رسانی : </strong>
                  <p><b><b class="ltr_text">{{ verta($user->updated_at)->format('Y/m/d-H:i')}}</b></b></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-12">
          <div class="white-box vtabs customvtab">
            <ul class="nav tabs-vertical" role="tablist">
              <li role="presentation" class="nav-item">
                <a href="#info" class="nav-link active" aria-controls="info" role="tab" data-toggle="tab"
                   aria-expanded="true">
                  <span class="visible-xs"> <i class="fa fa-home"></i></span>
                  <span class="hidden-xs"> اطلاعات پایه </span>
                </a>
              </li>
              <li role="presentation" class="nav-item">
                <a href="#credit" class="nav-link" aria-controls="credit" role="tab" data-toggle="tab"
                   aria-expanded="true">
                <span class="visible-xs">
                    <i class="fa fa-credit-card-alt"></i>
                </span>
                  <span class="hidden-xs"> کیف پول </span>
                </a>
              </li>
              <li role="presentation" class="nav-item">
                <a href="#webservice" class="nav-link" aria-controls="webservice" role="tab" data-toggle="tab"
                   aria-expanded="true">
                <span class="visible-xs">
                    <i class="fa fa-link"></i>
                </span>
                  <span class="hidden-xs"> وب سرویس </span>
                </a>
              </li>
              <li role="presentation" class="nav-item">
                <a href="#security" class="nav-link" aria-controls="security" role="tab" data-toggle="tab"
                   aria-expanded="true">
                <span class="visible-xs">
                    <i class="fa fa-gavel"></i>
                </span>
                  <span class="hidden-xs"> امنیت </span>
                </a>
              </li>
            </ul>
            <div class="tab-content" style="width: 100%;">
              <div class="tab-pane active" id="info">
                <div class="row">
                  <div class="col-md-12 col-12">
                    <form action="{{ route('admin.user.update',[$user->id]) }}" method="post">
                      @method('PUT')
                      @csrf
                      <input type="hidden" value="{{$user->id}}" name="id">
                      <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <div class="form-group">
                            <label for="name">نام : </label>
                            <div class="input-group">
                              <input {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"readonly":""}}  type="text"
                                     class="form-control" id="first_name" name="first_name"
                                     value="{{old('first_name',$user->first_name)}}">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="lastName">نام خانوادگی : </label>
                            <div class="input-group">
                              <input {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"readonly":""}}  type="text"
                                     class="form-control" id="lastName" name="last_name"
                                     value="{{old('last_name',$user->last_name)}}">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="discount">درصد تخفیف : </label>
                            <div class="input-group">
                              <input {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"readonly":""}} type="text"
                                     class="form-control" id="discount" name="discount"
                                     value="{{old('discount',$user->discount)}}">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <div class="form-group">
                            <label for="groups">گروه : </label>
                            <div class="input-group" id="groups">
                              <select class="form-control"
                                      name="group_id" {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"disabled":""}} >
                                <option value="-1">انتخاب کنید</option>
                                @foreach (\App\Enum\UserGroupEnum::toArray() as $key => $value)
                                  <option value="{{ $key }}" {{ $user->group_id->value == $key ? 'selected' : '' }}>
                                    {{ $value['label'] }}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="groups">وضعیت : </label>
                            <div class="input-group" id="groups">
                              <select class="form-control"
                                      name="status" {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"disabled":""}} >
                                @foreach (\App\Enum\UserStatus::toArray() as $key => $value)
                                  <option value="{{ $key }}" {{ $user->status->value == $key ? 'selected' : '' }}>
                                    {{ $value['label'] }}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="groups">درگاه : </label>
                            <div class="input-group" id="gateway">
                              <select class="form-control"
                                      name="gateway" {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"disabled":""}} >
                                @foreach (\App\Enum\UserGatewayEnum::toArray() as $key => $value)
                                  <option value="{{ $key }}" {{ $user->gateway->value == $key ? 'selected' : '' }}>
                                    {{ $value['label'] }}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="text-left">
                            <button type="reset" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="credit">
                <div class="row">
                  <div class="col-md-12 col-12">
                    <form action="{{ route('admin.user.updateWallet') }}" method="post">
                      @csrf
                      <input type="hidden" class="form-control" name="id" value="{{$user->id}}">

                      <div class="row">
                        <div class="col-md-4 col-sm-4">
                          <div class="form-group">
                            <label for="IRRcredit">کیف پول ریالی : </label>
                            <div class="input-group">
                              <input {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"readonly":""}} type=""
                                     class="form-control" id="IRRcredit" name="irr_wallet"
                                     value="{{$user->irr_wallet}}">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                          <div class="form-group">
                            <label for="USDcredit">کیف پول دلاری : </label>
                            <div class="input-group">
                              <input {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"readonly":""}} type="text"
                                     class="form-control" id="USDcredit" name="gift_wallet"
                                     value="{{$user->gift_wallet}}">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                          <div class="form-group">
                            <label for="digitalcredit">کیف پول دیجیتال : </label>
                            <div class="input-group">
                              <input {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"readonly":""}} type="text"
                                     class="form-control" id="digitalcredit" name="digital_wallet"
                                     value="{{$user->digital_wallet}}">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-md-12">
                          <div class="text-left">
                            <button type="reset" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="webservice">
                @if(auth()->user()->hasRole([\App\Enum\Roles::SuperAdmin , \App\Enum\Roles::TechnicalExpert]))

                  <div class="row">
                    <div class="col-md-12 col-12">

                      <form action="{{ route('admin.user.updateApi') }}" method="post">
                        @csrf
                        <div class="row">
                          <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <label for="apikey">کلید API : </label>
                              <div class="input-group">
                                <input type="text" class="form-control" id="apikey" disabled value="{{$user->api_key}}">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <label for="APIIP">آدرس آی پی api : </label>
                              <div class="input-group">
                                <input   {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"readonly":""}}  type="text" class="form-control" id="APIIP" value="{{$user->ip_address}}"
                                       name="ip_address">
                                <input type="hidden" class="form-control" value="{{$user->id}}" name="id">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-md-12">
                            <div class="text-left">
                              <button type="reset" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                              <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت</button>
                            </div>
                          </div>
                        </div>
                      </form>
                      <form class="text-center m-10 " action="{{ route('admin.user.updateApiKey') }}" method="post">
                        @csrf
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-md-12">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <button type="submit" class="btn btn-twitter waves-effect waves-light m-l-10"> تعویض کلید
                              api
                            </button>
                          </div>
                        </div>
                      </form>

                    </div>
                  </div>
                @else
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <strong class="text-danger">
                        عدم دسترسی
                      </strong>
                    </div>
                  </div>
                @endif

              </div>

              <div class="tab-pane" id="security">
                @if(auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin))

                <div class="row">
                  <div class="col-md-12 col-12">
                    <form action="{{ route('admin.user.updateNoVerify') }}" method="post">
                      @csrf
                      <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <div class="form-group">
                            <input type="hidden" value="{{$user->id}}" name="id"/>

                            <div class="checkbox checkbox-success">
                              <input id="checkboxSuccess" type="checkbox" @checked($user->noVerify==1) value="1"
                                     name="noVerify"/>
                              <label for="checkboxSuccess"> بدون تایید </label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <div class="m-15 text-center">
                            <button type="reset" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                @else
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <strong class="text-danger">
                        عدم دسترسی
                      </strong>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="white-box">
            <section class="m-b-40">
              <div class="sttabs tabs-style-circle">
                <nav>
                  <ul>
                    <li>
                      <a href="{{ route('admin.user-service', $user->id) }}" class="sticon fa fa-shopping-cart" target="_blank">
                        <span>سرویس ها</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('admin.user-ticket', $user->id) }}" class="sticon fa fa-support" target="_blank">
                        <span>تیکت ها</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('admin.user-invoice', $user->id) }}" class="sticon fa fa-bank" target="_blank">
                        <span>فاکتور ها</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('admin.user-card', $user->id) }}" class="sticon fa fa-credit-card" target="_blank">
                        <span>کارت ها</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('admin.user-log', $user->id) }}" class="sticon fa fa-bookmark" target="_blank">
                        <span>لاگ ها</span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')

@endpush

