@extends('admin.layout.main')
@section('title', 'لیست سرویس ها')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-6 col-md-6 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            <a href="{{ route('admin.user.index') }}">
              کاربران
            </a>
            /
            <a href="{{ route('admin.user.edit', $user->id )}}">
              مدیریت کاربر ( {{ $user->user_id }} )
            </a>
            /
            مشاهده سرویس ها
          </h4>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
          <div class="text-left">
            <a href="{{ route('admin.user.edit', $user->id )}}" class="btn btn-danger btn-rounded pl-3 pr-3">
              بازگشت
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="white-box">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-12">
                <h3 class="box-title m-b-0 mt-0">لیست سرویس ها</h3>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="text-left">
                  <button data-toggle="modal" data-target="#add-new-service" class="btn btn-custom btn-rounded">
                    ثبت  جدید
                  </button>
                </div>
              </div>
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
            <div class="table-responsive mt-3">
              {{ $dataTable->table() }}
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="add-new-service" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">ثبت سرویس جدید</h4>
        </div>
        <form action="{{ route('admin.service.store') }}" method="post">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12">
                <input type="hidden" value="{{$user->id}}" class="form-control" name="userId">

                <div class="form-group">
                  <label for="main_traffic" class="control-label">  ترافیک :</label>
                  <input type="text" class="form-control" id="main_traffic" name="main_traffic">
                </div>
                <div class="form-group">
                  <label for="server_id" class="control-label">سرور :</label>
                  <select name="server_id" id="server_id" class="form-control">
                    @foreach ($servers as $server)
                      <option value="{{ $server->id }}">
                        {{ $server->nickname }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
            <button type="submit" class="btn btn-danger waves-effect waves-light">ساخت سرویس</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
  {{ $dataTable->scripts() }}
@endpush
