@extends('admin.layout.main')
@section('title', 'لیست فاکتور ها')

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
            مشاهده فاکتور ها
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
                <h3 class="box-title m-b-0 mt-0">لیست فاکتور ها</h3>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="text-left">
                  <button data-toggle="modal" data-target="#add-new-invoice" class="btn btn-custom btn-rounded">
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
  <div class="modal fade" id="add-new-invoice" tabindex="-1" aria-labelledby="checkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body text-center">
          <form id="checkForm" action="{{ route('admin.invoice.store') }}" method="post">
            @csrf
            <div class="row">
              <input type="hidden" class="form-control text-center" id="userId" name="userId"  value="{{$user->id}}">
              <div class="col-lg-6 col-md-6 col-12">
                <input type="hidden" id="idInput" name="id" value="">
                <div class="form-group">
                    <label for="YC_amount">تعداد YC :</label>
                    <div class="input-group">
                      <input type="text" class="form-control text-center" id="YC_amount" name="YC_amount" >
                    </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group mt-4">
                  <div class="text-center">
                    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ایجاد فاکتور</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      $('#checkModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('invoice-id');
        var amount = button.data('amount');
        var cardNumber = button.data('card-number');
        var iban = button.data('iban');
        var imgSrc = button.data('image');

        var modal = $(this);
        var formattedAmount = formatAmount(amount);
        modal.find('#idInput').val(id);
        modal.find('#amountInput').val(formattedAmount);
        modal.find('#cardnumberInput').val(cardNumber);
        modal.find('#IbanInput').val(iban);
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
      function formatAmount(amount) {
        var amountAsNumber = parseFloat(amount);
        var amountRounded = Math.floor(amountAsNumber);
        var formattedString = amountRounded.toLocaleString('fa-IR', { style: 'currency', currency: 'IRR', minimumFractionDigits: 0, maximumFractionDigits: 0 });
        formattedString = formattedString.replace('ریال', 'تومان');
        return formattedString;
      }

    });
  </script>
  {{ $dataTable->scripts() }}
@endpush
