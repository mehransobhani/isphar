@extends('admin.layout.main')
@section('title', 'لیست تیکت ها')

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
            مشاهده تیکت ها
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
                <h3 class="box-title m-b-0 mt-0">لیست تیکت ها</h3>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="text-left">
                  <button data-toggle="modal" data-target="#add-new-ticket" class="btn btn-custom btn-rounded">
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


  <div id="add-new-ticket" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">ثبت تیکت جدید</h4>
        </div>
        <form action="{{ route('admin.ticket.store') }}" method="post">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12">
                <input type="hidden" class="form-control" id="userId" name="userId" value="{{$user->id}}">

                <div class="form-group">
                  <label for="nickname" class="control-label">  عنوان :</label>
                  <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                  <label for="nickname" class="control-label">  متن :</label>
                  <input type="text" class="form-control" id="message" name="message">
                </div>
                <div class="form-group">
                  <label for="department" class="control-label">دپارتمان :</label>
                  <select name="department" id="department" class="form-control">
                    @foreach (config("ticket.departments") as $key => $value)
                      <option value="{{ $key }}">
                        {{ $value }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
            <button type="submit" class="btn btn-danger waves-effect waves-light">ساخت تیکت</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
  {{ $dataTable->scripts() }}
@endpush
