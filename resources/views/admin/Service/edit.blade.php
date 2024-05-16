@extends('admin.layout.main')
@section('title', 'مدیریت سرویس')

@section('content')
<style>
  #activity-logs-table{
    width: 100% !important;
  }
</style>
<div id="wrapper">
  <!-- Page Content -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-6 col-md-12 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            <a href="{{ route('admin.user.index') }}">
              کاربران
            </a>
            /
            <a href="{{ route('admin.user.edit', $service->user_id) }}">
              مدیریت کاربر ({{$service->user_id}})
            </a>
            /
            مدیریت سرویس {{$service->id}}
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
                <div class="col-md-6 b-l"><strong>حجم مصرفی :</strong>
                  <p><span class="ltr_text">{{$service->data_usage}} GB / {{ $service->server->location == "IR" ?($service->main_traffic+ $service->traffic)*2:($service->main_traffic+ $service->traffic)}}</span></p>
                </div>
                <div class="col-md-6"><strong>وضعیت سرویس :</strong>
                    <p class="m-10">{!! $service->status->textHtmlAdmin() !!}</p>
                </div>
              </div>
              <hr>
              <div class="row text-center m-t-10">
                <div class="col-md-6 b-l"><strong>تعداد روز های باقی مانده : </strong>
                  @php
                    $diff = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($service->expired_at));
                  @endphp
                  <p><span class="ltr_text">{{$diff}}</span> روز</p>
                </div>
                <div class="col-md-6"><strong>تاریخ تهیه : </strong>
                  <p><span class="ltr_text m-10">{{ verta($service->created_at)->format('Y/m/d-H:i') }}</span></p>
                </div>
              </div>
              <div class="row text-center m-t-10">
                <div class="col-md-6 b-l"><strong>تهیه شده  : </strong>
                  <p>
                    <span class="ltr_text">
                      @if ($service->buy_method == 1)
                        از سایت
                      @elseif ($service->buy_method == 2)
                        از API
                      @else
                          مقدار نامعتبر
                      @endif
                    </span>
                  </p>
                </div>
                <div class="col-md-6"><strong>لینک : </strong>
                  <p>
                    <span class="ltr_text m-10">
                      <button class="btn btn-success waves-effect waves-light btn-rounded" onclick="copyToClipboard('{{ route('subscribe', $service->subscribe_uuid) }}')">
                        کپی کنید
                      </button>
                    </span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="white-box vtabs customvtab">
            <!-- .tabs -->
            <ul class="nav tabs-vertical" role="tablist">
              <li role="presentation" class="nav-item">
                <a href="#info" class="nav-link active" aria-controls="info" role="tab" data-toggle="tab" aria-expanded="true">
                  <span class="visible-xs">
                    <i class="ti-home"></i>
                  </span>
                  <span class="hidden-xs">
                    اطلاعات پایه
                  </span>
                </a>
              </li>
              <li role="presentation" class="nav-item">
                <a href="#editlink" class="nav-link" aria-controls="credit" role="tab" data-toggle="tab" aria-expanded="true">
                  <span class="visible-xs">
                    <i class="fa fa-credit-card-alt"></i>
                  </span>
                  <span class="hidden-xs">
                    ویرایش لینک ها
                  </span>
                </a>
              </li>
              <li role="presentation" class="nav-item">
                <a href="#config" class="nav-link" aria-controls="credit" role="tab" data-toggle="tab" aria-expanded="true">
                  <span class="visible-xs">
                    <i class="fa fa-credit-card-alt"></i>
                  </span>
                  <span class="hidden-xs">
                    کانفیگ
                  </span>
                </a>
              </li>
            </ul>
            <!-- /.tabs -->
            <div class="tab-content" style="width: 100%;">
              <div class="tab-pane active" id="info">
                <div class="row">
                  <div class="col-md-12 col-12">
                    <form action="{{ route('admin.service.updateBase') }}" method="post">
                      @csrf
                      <input type="hidden" class="form-control" id="main_traffic" name="id" value="{{$service->id}}">

                      <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <div class="form-group">
                            <label for="main_traffic">حجم اولیه : </label>
                            <div class="input-group">
                              <input type="text"  {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"readonly":""}}  class="form-control" id="main_traffic" name="main_traffic" value="{{ $service->server->location == "IR" ?$service->main_traffic*2:$service->main_traffic}}">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="traffic">حجم مازاد : </label>
                            <div class="input-group">
                              <input type="text"  {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"readonly":""}}  class="form-control" id="traffic" name="traffic" value="{{$service->traffic}}">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <div class="form-group">
                            <label for="expired_at">تاریخ انقضا : </label>
                            <input  {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"readonly":""}}  class="form-control ltr_text" type="datetime-local" placeholder="2023-08-19T13:45:00" id="expired_at" name="expired_at" value="{{$service->expired_at}}">
                          </div>
                          <div class="form-group">
                            <label for="groups">وضعیت : </label>
                            <div class="input-group" id="groups">
                              <select class="form-control" name="status"  {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"disabled":""}} >
                                @foreach(\App\Enum\ServiceStatus::cases() as $status)
                                    <option value="{{ $status->value }}" {{ $service->status->value == $status->value ? 'selected' : '' }}>
                                        {{ $status->text() }}
                                    </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="text-left">
                            <button type="reset" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                            <button type="submit"   {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"disabled":""}} class="btn btn-success waves-effect waves-light m-l-10">ثبت</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="config">
                <div class="row">
                  <div class="col-md-12 col-12 text-center">
                    <div class="m-20">
                      <form action="{{ route('admin.service.extend') }}" method="post" class="d-inline-block">
                        @csrf
                        <input type="hidden" name="id" value="{{$service->id}}"/>
                        <button   {{!auth()->user()->hasRole([\App\Enum\Roles::SuperAdmin , \App\Enum\Roles::TechnicalSupervisor , \App\Enum\Roles::TechnicalExpert])?"disabled":""}} type="submit" class="fcbtn btn btn-success btn-outline btn-1e waves-effect">تمدید سرویس</button>
                      </form>
                      <form action="{{ route('admin.service.updateSubscribe') }}"  method="post" class="d-inline-block">
                        @csrf
                        <input type="hidden" name="id" value="{{$service->id}}"/>
                        <button   {{!auth()->user()->hasRole([\App\Enum\Roles::SuperAdmin , \App\Enum\Roles::TechnicalSupervisor , \App\Enum\Roles::TechnicalExpert])?"disabled":""}} type="submit" class="fcbtn btn btn-danger btn-outline btn-1e waves-effect">تعویض لینک سابسکرایپ</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="editlink">
                <div class="row">
                  <div class="col-md-12 col-12">
                    <div class="m-20">
                      <form action="{{route("admin.service.updateLink")}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$service->id}}">
                        <div class="row">
                          <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <label for="groups">vless : </label>
                              <div class="input-group" id="groups" name="vless">
                                <select class="form-control" name="vless"   {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"disabled":""}}>
                                  <option value="1" @selected($service->vless==1)>فعال</option>
                                  <option value="0" @selected($service->vless==0)> غیرفعال</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="groups">vmess : </label>
                              <div class="input-group" id="groups">
                                <select class="form-control" name="vmess"   {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"disabled":""}}>
                                  <option value="1" @selected($service->vmess==1)>فعال</option>
                                  <option value="0" @selected($service->vmess==0)>غیرفعال</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <label for="groups">ss : </label>
                              <div class="input-group" id="groups">
                                <select class="form-control" name="ss"   {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"disabled":""}}>
                                  <option value="1" @selected($service->ss==1)>فعال</option>
                                  <option value="0" @selected($service->ss==0)>غیرفعال</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="groups">trojan : </label>
                              <div class="input-group" id="groups">
                                <select class="form-control" name="trojan   {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"disabled":""}}">
                                  <option value="1" @selected($service->trojan==1)>فعال</option>
                                  <option value="0" @selected($service->trojan==0)>غیرفعال</option>
                                </select>
                              </div>
                            </div>
                            <div class="text-left">
                              <button type="reset" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                              <button type="submit" class="btn btn-success waves-effect waves-light m-l-10"   {{!auth()->user()->hasRole(\App\Enum\Roles::SuperAdmin)?"disabled":""}}>ثبت</button>
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
        <div class="col-lg-2 col-md-12">
          <div class="white-box">
            <div class="m-b-10 font-bold text-center">
                QR CODE
            </div>
            <img src="{{\App\Classes\QrCode\QrCodeGenerator::generate("service",$service->id)}}" alt="QrCode" class="img-responsive img-rounded" style="height: 100%;">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="white-box">
            <div class="sttabs tabs-style-circle">
              <nav>
                <ul>
                  <li><a href="#reports" class="sticon fa fa-shopping-cart"><span>اعلام خرابی</span></a></li>
                  <li><a href="#logs" class="sticon fa fa-bank"><span>لاگ ها</span></a></li>
                </ul>
              </nav>
              <div class="content-wrap text-center">
                <section id="reports">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                      <div class="white-box">
                        <h3 class="box-title float-left">اعلام خرابی</h3>
                        <div class="table-responsive">
                          <table class="table table-striped text-right">
                            <thead>
                            <tr>
                              <th>#</th>
                              <th>کاربر</th>
                              <th>توضیحات</th>
                              <th class="text-center">تاریخ</th>
                              <th class="text-center">شناسه تیکت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tickets ? $tickets->messages : [] as $ticket)
                              <tr>
                                  <td>
                                      <a href="{{ route('admin.ticket.view',$ticket->id) }}" class="btn-link">
                                          {{ $ticket->id }}
                                      </a>
                                  </td>
                                  <td>
                                      @if($ticket->is_admin != 0)
                                        {{ $ticket->admin->name }}
                                      @else
                                        @if($ticket->user_id)
                                          {{ $ticket->user->fullName }}
                                        @endif
                                      @endif
                                  </td>
                                  <td>
                                      {{ $ticket->message }}
                                  </td>
                                  <td>
                                      <span class="text-muted text-center">
                                          <i class="fa fa-clock-o"></i>
                                          {{ verta($ticket->updated_at)->format('Y/m/d-H:i') }}
                                      </span>
                                  </td>
                                  <td class="text-center">
                                      <a href="{{ route('admin.ticket.view', $ticket->ticket_id) }}" class="btn btn-block btn-outline btn-primary btn-rounded waves-effect">
                                          مشاهده
                                      </a>
                                  </td>
                              </tr>
                            @empty
                              <tr>
                                  <td colspan="5" class="text-center">کاربر تا کنون اعلام خرابی ثبت نکرده است.</td>
                              </tr>
                            @endforelse
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <section id="logs">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                      <div class="white-box">
                        <h3 class="box-title">آخرین فعالیت ها</h3>
                        <div class="table-responsive">
                          {{ $dataTable->table() }}
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
@endsection

@push('scripts')
<script>
  function copyToClipboard(text) {
      var textarea = document.createElement("textarea");
      textarea.value = text;
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand("copy");
      document.body.removeChild(textarea);
      alert("لینک کپی شد");
  }
</script>
<script src={{asset("admin-assets/plugins/cbpFWTabs/cbpFWTabs.min.js")}}></script>
<script type="text/javascript">
  (function () {

    [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
      new CBPFWTabs(el);
    });

  })();
</script>
{{ $dataTable->scripts() }}
@endpush
