@extends('admin.layout.main')
@section('title','کارت های بانکی ادمین')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-6 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            کارت های بانکی ادمین
          </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="white-box">
            <div class="box-title m-b-10">
              <div class="float-left">
                <h3 class="box-title"> لیست کارت های بانکی ادمین </h3>
              </div>
              <div class="float-right">
                <button alt="default" data-toggle="modal" data-target="#add-new-card" class="btn btn-custom btn-rounded">
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
  <div id="add-new-card" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">ثبت کارت بانکی ادمین جدید</h4>
        </div>
        <form action="{{ route('admin.admin-bank-card.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="card_number" class="control-label">شماره کارت :</label>
              <input type="text" class="form-control" id="card_number" name="card_number">
            </div>
            <div class="form-group">
              <label for="card_image_file_id" class="control-label">تصویر کارت :</label>
              <input type="file" name="card_image_file_id" id="card_image_file_id" class="form-control" data-toggle="tooltip" title="تصویر کارت">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
            <button type="submit" class="btn btn-danger waves-effect waves-light">ثبت کارت جدید</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  {{ $dataTable->scripts() }}
@endpush
