@extends('admin.layout.main')
@section('title','دلایل رد تراکنش')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-6 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            دلایل رد تراکنش
          </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="white-box">
            <div class="box-title m-b-10">
              <div class="float-left">
                <h3 class="box-title"> لیست دلایل رد تراکنش </h3>
              </div>
              <div class="float-right">
                <button alt="default" data-toggle="modal" data-target="#rejectinvoice-modal" class="btn btn-custom btn-rounded">
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
  <div id="rejectinvoice-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.invoice-reason.store') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="title">عنوان : </label>
              <div class="input-group">
                <input type="text" class="form-control" id="title" name="title">
              </div>
            </div>
            <div class="form-group">
              <label for="content">توضیحات : </label>
              <div class="input-group">
                <textarea type="text" class="form-control" id="content" name="content" ></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="text-center">
                <button type="reset" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  {{ $dataTable->scripts() }}
@endpush
