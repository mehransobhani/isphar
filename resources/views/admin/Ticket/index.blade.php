@extends('admin.layout.main')
@section('title', 'تیکت ها')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-6 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            تیکت ها
          </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="white-box">
            <h3 class="box-title m-b-0">لیست تیکت ها </h3>
            <div class="table-responsive">
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
