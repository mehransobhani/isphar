@extends('admin.layout.main')
@section('title','درخواست های تسویه')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-6 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
           درخواست های تسویه
          </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="white-box">
            <h3 class="box-title m-b-10"> لیست  درخواست های تسویه </h3>
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
  <div class="modal fade" id="checkModal" tabindex="-1" aria-labelledby="checkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <form id="checkForm" action="{{ route('admin.checkout.submit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12">
                <input type="hidden" id="IdInput" name="id" value="">
                <div class="form-group row">
                  <div class="col-lg-6 col-md-12 col-12">
                    <label for="cardnumberInput">شماره کارت :</label>
                    <div class="input-group">
                      <input type="text" class="form-control text-center ltr_text" id="cardnumberInput" name="card_number" value="" readonly>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12 col-12">
                    <label for="amountInput">مبلغ به ریال :</label>
                    <div class="input-group">
                      <input type="text" class="form-control text-center ltr_text" id="amountInput" name="IRTamount" value="" readonly>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-6 col-md-12 col-12">
                    <label for="tracking_code">کد رهگیری :</label>
                    <div class="input-group">
                      <input type="text" class="form-control text-center ltr_text" id="tracking_code" name="tracking_code" placeholder = "لطفا کد رهگیری که از طریق بانک اعلام شده وارد بکنید." >
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12 col-12">
                    <label for="file_id">پیوست :</label>
                    <div class="input-group">
                      <input type="file" class="form-control text-center ltr_text" id="file_id" name="file_id" placeholder = "رسید رو وارد کنید" >
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group">
                  <div class="text-center">
                    <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت</button>
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
            var Id = button.data('id');
            var Amount = button.data('price');
            var cardNumber = button.data('card-number');
            var imgSrc = button.data('image');

            var modal = $(this);
            var formattedAmount = formatAmount(Amount);
            modal.find('#IdInput').val(Id);
            modal.find('#cardnumberInput').val(cardNumber);
            modal.find('#amountInput').val(formattedAmount);
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
