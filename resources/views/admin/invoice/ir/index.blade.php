@extends('admin.layout.main')
@section('title','فاکتور های ریالی')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-6 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            فاکتور های ریالی
          </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="white-box">
            <h3 class="box-title m-b-10"> لیست فاکتور های ریالی </h3>
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
        <div class="modal-body text-center">
          <form id="checkForm" action="{{ route('admin.action-ir-invoice') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-lg-6 col-md-12 col-12">
                <img id="imgurl" class="img-fluid img-rounded m-b-10" src="" alt="card image" width="100%" style="box-shadow: 0 0 20px 1px #66666652;">
              </div>
              <div class="col-lg-6 col-md-12 col-12">
                <input type="hidden" id="idInput" name="id" value="">
                <div class="form-group">
                  <label for="cardnumberInput">واریز به حساب :</label>
                  <div class="input-group">
                    <input type="text" class="form-control text-center" id="admincardnumberInput" value="" readonly>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="cardnumberInput">پرداخت از شماره شبا :</label>
                    <div class="input-group">
                      <input type="text" class="form-control text-center" id="IbanInput" name="iban" value="" readonly>
                    </div>
                  </div>
                <div class="form-group">
                  <label for="cardnumberInput">پرداخت از شماره کارت :</label>
                  <div class="input-group">
                    <input type="text" class="form-control text-center" id="cardnumberInput" name="card_number" value="" readonly>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="amountInput">مبلغ :</label>
                  <div class="input-group">
                    <input type="text" class="form-control text-center" id="amountInput" name="total" value="" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="status">وضعیت :</label>
                  <div class="input-group">
                    <select id="statusSelect" name="status" class="form-control">
                      <option value="1">
                        تایید میگردد
                      </option>
                      <option value="2">
                        رد میگردد
                      </option>
                    </select>
                  </div>
                </div>
                <div id="rejectReasonDiv" class="form-group" style="display: none;">
                  <label for="rejectReason">دلیل رد:</label>
                  <div class="input-group">
                    @php
                        $invoiceReason = \App\Models\InvoicesReason::all();
                    @endphp
                    <select name="reason_id" class="form-control" id="reasonSelect">
                      @foreach($invoiceReason as $reason)
                        <option value="{{$reason->id}}">
                          {{$reason->title}}
                        </option>
                      @endforeach
                    </select>
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
        var id = button.data('invoice-id');
        var amount = button.data('amount');
        var cardNumber = button.data('card-number');
        var admincardNumber = button.data('admin-card-number');
        var iban = button.data('iban');
        var imgSrc = button.data('image');

        var modal = $(this);
        var formattedAmount = formatAmount(amount);
        modal.find('#idInput').val(id);
        modal.find('#amountInput').val(formattedAmount);
        modal.find('#cardnumberInput').val(cardNumber);
        modal.find('#admincardnumberInput').val(admincardNumber);
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
