@extends('admin.layout.main')
@section('title', 'لیست لاگ ها')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-6 col-md-6 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            <a href="{{ route('admin.admin.index') }}">
              مدیران
            </a>
            /
            <a href="{{ route('admin.admin.edit', $admin->id )}}">
              ویرایش مدیر ( {{ $admin->user_id }} )
            </a>
            /
            مشاهده لاگ ها
          </h4>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
          <div class="text-left">
            <a href="{{ route('admin.admin.edit', $admin->id )}}" class="btn btn-danger btn-rounded pl-3 pr-3">
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
                <h3 class="box-title m-b-0 mt-0">لیست لاگ ها</h3>
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

@endsection

@push('scripts')
  {{ $dataTable->scripts() }}
@endpush
