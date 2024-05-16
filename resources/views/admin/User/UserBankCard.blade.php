@extends('admin.layout.main')
@section('title', 'لیست کارت ها')

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
            مشاهده کارت ها
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
                <h3 class="box-title m-b-0 mt-0">لیست کارت ها</h3>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="text-left">
                  <button data-toggle="modal" data-target="#add-new-card" class="btn btn-custom btn-rounded">
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

  <div id="add-new-card" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">ثبت کارت بانکی جدید</h4>
        </div>
        <form action="{{ route('admin.card.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <input type="hidden" class="form-control" id="userId" name="userId" value="{{$user->id}}">
            <div class="form-group">
              <label for="card_number" class="control-label">شماره کارت :</label>
              <input type="text" class="form-control" id="card_number" name="card_number">
            </div>
            <div class="form-group">
              <label for="bank" class="control-label">  بانک :</label>
              <input type="text" class="form-control" id="bank" name="bank">
            </div>
            <div class="form-group">
              <label for="first_name" class="control-label">نام :</label>
              <input type="text" class="form-control" id="first_name" name="first_name">
            </div>
            <div class="form-group">
              <label for="last_name" class="control-label">  نام خانوادگی :</label>
              <input type="text" class="form-control" id="last_name" name="last_name">
            </div>
            <div class="form-group">
              <label for="depositNumber" class="control-label">شماره حساب :</label>
              <input type="text" class="form-control" id="depositNumber" name="depositNumber">
            </div>
            <div class="form-group">
              <label for="iban" class="control-label">شماره شبا :</label>
              <input type="text" class="form-control" id="iban" name="iban">
            </div>
            <div class="form-group">
              <label for="iban" class="control-label">  وضعیت :</label>
              <select name="status" class="form-control">
                @foreach(\App\Enum\BankCardStatus::cases() as $item)
                    <option value="{{$item->value}}">{{$item->text()}}</option>
                @endforeach
              </select>
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
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#checkModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var cardId = button.data('card-id');
            var cardNumber = button.data('card-number');
            var imgSrc = button.data('image');

            var modal = $(this);
            modal.find('#cardIdInput').val(cardId);
            modal.find('#cardnumberInput').val(cardNumber);
            modal.find('#imgurl').attr('src', imgSrc);

            var selectedValue = modal.find('#statusSelect').val();
            if (selectedValue === '2') {
                modal.find('#rejectReasonDiv').show();
            } else {
                modal.find('#rejectReasonDiv').hide();
            }
        });
        $('#statusSelect').on('change', function () {
            var selectedValue = $(this).val();
            var rejectReasonDiv = $('#rejectReasonDiv');

            if (selectedValue === '2') {
                rejectReasonDiv.show();
            } else {
                rejectReasonDiv.hide();
            }
        });
    });
  </script>
  {{ $dataTable->scripts() }}
@endpush
