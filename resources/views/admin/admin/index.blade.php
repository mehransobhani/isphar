@extends('admin.layout.main')
@section('title','مدیران')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-6 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            مدیران
          </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="white-box">
            <div class="box-title m-b-10">
              <div class="float-left">
                <h3 class="box-title"> لیست مدیران </h3>
              </div>
              <div class="float-right">
                <button alt="default" data-toggle="modal" data-target="#add-new-admin" class="btn btn-custom btn-rounded">
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
  <div id="add-new-admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">ثبت مدیر جدید</h4>
        </div>
        <form action="{{ route('admin.admin.store')}}" method="post">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="name" class="control-label">لقب مدیر :</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
              <label for="email" class="control-label">ایمیل مدیر :</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
              <label for="card_number" class="control-label">شماره کارت مدیر :</label>
              <input type="text" class="form-control" id="card_number" name="card_number">
            </div>
            <div class="form-group">
              <label for="user_id" class="control-label">شناسه تلگرام مدیر :</label>
              <input type="text" class="form-control" id="user_id" name="user_id">
            </div>
            <div class="form-group">
              <label for="user_id" class="control-label">نقش ها :</label>
              <div class="input-group">
                <select name="role[]" class="form-control" multiple>
                  @foreach(\App\Enum\Roles::cases() as $role)
                    <option value="{{$role->value}}" >{{$role->text()}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
            <button type="submit" class="btn btn-danger waves-effect waves-light">ایجاد</button>
          </div>
        </form>
      </div>
    </div>
  </div>
 @endsection

@push('scripts')
  {{ $dataTable->scripts() }}
@endpush
