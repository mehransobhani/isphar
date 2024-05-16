@extends('admin.layout.main')
@section('title','فاکتور های ارزی')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-6 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            فاکتور های ارزی
          </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="white-box">
            <h3 class="box-title m-b-10"> لیست فاکتور های ارزی </h3>
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
