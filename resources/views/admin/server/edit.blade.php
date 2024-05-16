@extends('admin.layout.main')

@section('title','ویرایش سرور')
@section('content')
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-4 col-md-5 col-12">
            <h4 class="page-title">
              <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
              /
              <a href="{{ route('admin.server.index') }}">
                سرور ها
              </a>
              /
              ویرایش سرور ({{$server->id}})
            </h4>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <div class="white-box">
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
              <div class="clearfix"></div>
			  <div class="row">
				<div class="col-lg-3 col-sm-12 col-12">
				  <div class="white-box">
					   <h3 class="box-title text-center"> همه سرویس ها  </h3>
					  <ul class="list-inline text-center">
						<li class="text-left">{{$AllServicesCount}}</li>
					  </ul>
				   </div>
				</div>
				<div class="col-lg-2 col-sm-12 col-12">
				  <div class="white-box">
					   <h3 class="box-title text-center">سرویس های فعال</h3>
					  <ul class="list-inline text-center">
						<li class="text-left"><span class="counter text-purple">{{$ActiveServicesCount}}</span></li>
					  </ul>
				   </div>
				</div>
				<div class="col-lg-2 col-sm-12 col-12">
				  <div class="white-box">
					   <h3 class="box-title text-center">سرویس های لغو شده</h3>
					  <ul class="list-inline text-center">
						<li class="text-left"><span class="counter text-info">{{$CanceledServicesCount}}</span></li>
					  </ul>
				   </div>
				</div>
				<div class="col-lg-3 col-sm-12 col-12">
				  <div class="white-box">
					   <h3 class="box-title text-center">سرویس های مسدود شده</h3>
					  <ul class="list-inline text-center">
						<li class="text-left"><span class="text-danger">{{$SuspendedServicesCount}}</span></li>
					  </ul>
				   </div>
				</div>
				<div class="col-lg-2 col-sm-12 col-12">
					<div class="white-box">
						<h3 class="box-title text-center">سرویس های در انتظار</h3>
						<ul class="list-inline text-center">
						  <li class="text-left"><span class="text-danger">{{$PendingServicesCount}}</span></li>
						</ul>
					</div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-lg-9 col-md-12 col-12">
					<form action="{{ route('admin.server.update') }}" method="post">
						@csrf
						<input type="hidden" name="id" value="{{$server->id}}">
						<div class="vtabs">
						  <ul class="nav tabs-vertical">
							<li class="tab nav-item active">
							  <a data-toggle="tab" class="nav-link" href="#Information" aria-expanded="true"> اطلاعات پایه</a>
							</li>
							<li class="tab nav-item">
							  <a data-toggle="tab" class="nav-link" href="#security" aria-expanded="false"> امنیتی </a>
							</li>
							<li class="tab nav-item">
							  <a aria-expanded="false" class="nav-link" data-toggle="tab" href="#Protocols">پروتکل ها</a>
							</li>
						  </ul>
						  <div class="tab-content w-100">
							<div id="Information" class="tab-pane active">
							  <div class="form-group row">
								<label for="nickname" class="col-4 col-sm-3 col-md-2 col-form-label">نام سرور</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <input class="form-control" type="text" value="{{$server->nickname}}" id="nickname" name="nickname">
								</div>
							  </div>
							  <div class="form-group row">
								<label for="location" class="col-4 col-sm-3 col-md-2 col-form-label">کشور</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <select name="location" id="location" class="form-control">
									@foreach (\App\Enum\ServerLocation::toArray() as $key => $value)
										<option value="{{ $key }}" {{$server->location == $key ? 'selected' : '' }}>
											{{ $value['label'] }}
										</option>
									  @endforeach
								  </select>
								</div>
							  </div>
							  <div class="form-group row">
								<label for="ip" class="col-4 col-sm-3 col-md-2 col-form-label">آی پی سرور</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <input class="form-control" type="text" value="{{$server->ip}}" id="ip" name="ip">
								</div>
							  </div>
							  <div class="form-group row">
								<label for="domain" class="col-4 col-sm-3 col-md-2 col-form-label">دامنه سرور</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <input class="form-control" type="text" value="{{$server->domain}}" id="domain" name="domain">
								</div>
							  </div>
							  <div class="form-group row">
								<label for="port" class="col-4 col-sm-3 col-md-2 col-form-label">پورت سرور</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <input class="form-control" type="number" value="{{$server->port}}" id="port" name="port">
								</div>
							  </div>
							  <div class="form-group row">
								<label for="https" class="col-4 col-sm-3 col-md-2 col-form-label">گواهی اس اس ال</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <input type="checkbox" value="{{$server->https}}" id="https" name="https" {{ $server->https ? 'checked' : '' }} onchange="updateCheckbox(this)">
								</div>
							  </div>
							  <div class="form-group row">
								<label for="status" class="col-4 col-sm-3 col-md-2 col-form-label">وضعیت</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <select name="status" id="status" class="form-control">
									@foreach (\App\Enum\ServerStatus::toArray() as $key => $value)
										<option value="{{ $key }}" {{ $server->status == $key ? 'selected' : '' }}>
											{{ $value['label'] }}
										</option>
									  @endforeach
								  </select>
								</div>
							  </div>
							  <div class="clearfix"></div>
							</div>
							<div id="security" class="tab-pane">
							  <div class="form-group row">
								<label for="username" class="col-4 col-sm-3 col-md-2 col-form-label">یوزرنیم سرور</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <input class="form-control" type="text" value="{{$server->username}}" id="username" name="username">
								</div>
							  </div>
							  <div class="form-group row">
								<label for="password" class="col-4 col-sm-3 col-md-2 col-form-label">پسورد سرور</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <input class="form-control" type="password" value="{{$server->password}}" id="password" name="password">
								</div>
							  </div>
							  <div class="clearfix"></div>
							</div>
							<div id="Protocols" class="tab-pane">
							  <div class="form-group row">
								<label for="vmess" class="col-4 col-sm-3 col-md-2 col-form-label">vmess</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <input type="checkbox" value="{{$server->vmess}}" id="vmess" name="vmess" {{ $server->vmess ? 'checked' : '' }} onchange="updateCheckbox(this)">
								</div>
							  </div>
							  <div class="form-group row">
								<label for="vless" class="col-4 col-sm-3 col-md-2 col-form-label">vless</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <input type="checkbox" value="{{$server->vless}}" id="vless" name="vless" {{ $server->vless ? 'checked' : '' }} onchange="updateCheckbox(this)">
								</div>
							  </div>
							  <div class="form-group row">
								<label for="trojan" class="col-4 col-sm-3 col-md-2 col-form-label">trojan</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <input type="checkbox" value="{{$server->trojan}}" id="trojan" name="trojan" {{ $server->trojan ? 'checked' : '' }} onchange="updateCheckbox(this)">
								</div>
							  </div>
							  <div class="form-group row">
								<label for="ss" class="col-4 col-sm-3 col-md-2 col-form-label">ss</label>
								<div class="col-8 col-sm-9 col-md-10">
								  <input type="checkbox" value="{{$server->ss}}" id="ss" name="ss" {{ $server->ss ? 'checked' : '' }} onchange="updateCheckbox(this)">
								</div>
							  </div>
							</div>
						  </div>
						</div>
						<hr>
						<div class="form-group text-center">
						  <button type="submit" class="btn btn-danger waves-effect waves-light">ذخیره تغییرات</button>
						</div>
					  </form>
				</div>
				<div class="col-lg-3 col-md-12 col-12">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                      <div class="card">
                        <div class="card-block">
                          <h4 class="card-title">تاریخ ایجاد : <b class="ltr_text">{{ verta($server->created_at)->format('Y/m/d-H:i')}}</b></h4>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted">آخرین به روز رسانی : <b class="ltr_text">{{ verta($server->updated_at)->format('Y/m/d-H:i')}}</b></small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-5">
                    <div class="col-lg-12 col-md-12 col-12">
                      <div class="card">
                        <div class="card-block">
                          <h5>
                            اطلاعات سرور
                          </h5>
                        </div>
                        <div class="card-footer">
                          	<small class="text-muted">ورژن : <b class="ltr_text">{{ ($info["version"])}}</b></small><br/>
                           	<small class="text-muted"> مقدار رم : <b class="ltr_text">{{ ($info["mem_total"])}}</b></small><br/>
                           	<small class="text-muted">مقدار مصرفی رم : <b class="ltr_text">{{ ($info["mem_used"])}}</b></small><br/>
                           	<small class="text-muted">پردازنده : <b class="ltr_text">{{ ($info["cpu_cores"])}}</b></small><br/>
                           	<small class="text-muted">پردازنده مصرف شده :<b class="ltr_text">{{ ($info["cpu_usage"])}}</b></small><br/>
                           	<small class="text-muted"> همه کاربران :  <b class="ltr_text">{{ ($info["total_user"])}}</b></small><br/>
                           	<small class="text-muted">   کاربران فعال :  <b class="ltr_text">{{ ($info["users_active"])}}</b></small><br/>
                           	<small class="text-muted"> incoming_bandwidth :  <b class="ltr_text">{{ ($info["incoming_bandwidth"])}}</b></small><br/>
                           	<small class="text-muted"> outgoing_bandwidth :  <b class="ltr_text">{{ ($info["outgoing_bandwidth"])}}</b></small><br/>
                           	<small class="text-muted"> incoming_bandwidth_speed :  <b class="ltr_text">{{ ($info["incoming_bandwidth_speed"])}}</b></small><br/>
                           	<small class="text-muted"> outgoing_bandwidth_speed :  <b class="ltr_text">{{ ($info["outgoing_bandwidth_speed"])}}</b></small><br/>
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
@push('scripts')
<script>
  function updateCheckbox(checkbox) {
      if (checkbox.checked) {
          checkbox.value = 1;
      }
  }
</script>
@endpush

