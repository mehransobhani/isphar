@extends('admin.layout.main')

@section('title','سرور ها')

@section('content')


  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-6 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            سرور ها
          </h4>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="white-box">
            <div class="box-title m-b-10">
              <div class="float-left">
                <h3 class="box-title"> لیست سرور ها </h3>
              </div>
              <div class="float-right">
                <button alt="default" data-toggle="modal" data-target="#add-new-server" class="btn btn-custom btn-rounded">
                  ثبت  جدید
                </button>
              </div>
              <div class="clearfix"></div>
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

            <div class="table-responsive">
              {{ $dataTable->table() }}
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="add-new-server" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">ثبت سرور جدید</h4>
        </div>
        <form action="{{ route('admin.server.store') }}" method="post">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                  <label for="nickname" class="control-label">نام سرور :</label>
                  <input type="text" class="form-control" id="nickname" name="nickname">
                </div>
                <div class="form-group">
                  <label for="location" class="control-label">لوکیشن :</label>
                  <select name="location" id="location" class="form-control">
                    @foreach (\App\Enum\ServerLocation::toArray() as $key => $value)
                        <option value="{{ $key }}">
                            {{ $value['label'] }}
                        </option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="username" class="control-label">یوزرنیم :</label>
                  <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                  <label for="password" class="control-label">پسورد :</label>
                  <input type="text" class="form-control" id="password" name="password">
                </div>
              </div>
              <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                  <label for="ip" class="control-label">آی پی :</label>
                  <input type="text" class="form-control" id="ip" name="ip">
                </div>
                <div class="form-group">
                  <label for="domain" class="control-label">دامنه :</label>
                  <input type="text" class="form-control" id="domain" name="domain">
                </div>
                <div class="form-group">
                  <label for="port" class="control-label">پورت :</label>
                  <input type="text" class="form-control" id="port" name="port">
                </div>
                <div class="form-group">
                  <label for="https" class="control-label">https :</label>
                  <input type="checkbox" class="input-group" id="https" name="https" value="1">
                </div>
              </div>
              <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                  <label for="vmess" class="control-label">vmess :</label>
                  <input type="checkbox" class="input-group" id="vmess" name="vmess" value="1">
                </div>
                <div class="form-group">
                  <label for="vless" class="control-label">vless :</label>
                  <input type="checkbox" class="input-group" id="vless" name="vless" value="1">
                </div>
                <div class="form-group">
                  <label for="trojan" class="control-label">trojan :</label>
                  <input type="checkbox" class="input-group" id="trojan" name="trojan" value="1">
                </div>
                <div class="form-group">
                  <label for="ss" class="control-label">ss :</label>
                  <input type="checkbox" class="input-group" id="ss" name="ss" value="1">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
            <button type="submit" class="btn btn-danger waves-effect waves-light">ساخت سرور</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  {{ $dataTable->scripts() }}
@endpush

