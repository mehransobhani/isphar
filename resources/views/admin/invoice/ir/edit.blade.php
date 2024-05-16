@extends('admin.layout.main')

@section('title','ویرایش تراکنش ریالی')
@section('content')
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-4 col-md-5 col-12">
            <h4 class="page-title">
              <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
              /
              <a href="{{ route('admin.index-invoice-irr') }}">
                فاکتور های ریالی
              </a>
              /
              ویرایش تراکنش ریالی ({{$invoice->id}})
            </h4>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <div class="white-box">
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
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-lg-9 col-md-12 col-12">
                  <form action="{{ route('admin.invoice.irr.update',[$invoice->id]) }}" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id" value="{{$invoice->id}}">
                    <div class="form-group row">
                      <label for="amount" class="col-4 col-sm-3 col-md-2 col-form-label">مبلغ  </label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <input class="form-control" type="text" value="{{$invoice->amount}}" id="amount" name="amount">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="yc_amount" class="col-4 col-sm-3 col-md-2 col-form-label">یوز کوین</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <input class="form-control" type="text" value="{{$invoice->yc_amount}}" id="yc_amount" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="tax_avoidance" class="col-4 col-sm-3 col-md-2 col-form-label">مانع زنی مالیاتی </label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <input class="form-control" type="text" value="{{$invoice->tax_avoidance}}" id="tax_avoidance" name="tax_avoidance">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="status" class="col-4 col-sm-3 col-md-2 col-form-label">  وضعیت</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <select name="status" class="form-control">
                          @foreach(\App\Enum\InvoiceStatus::cases() as $item)
                            <option value="{{$item->value}}" @selected($item->value==$invoice->status->value)>{{$item->text()}}</option>
                          @endforeach
                        </select>
                       </div>
                    </div>
                    <div class="form-group row">
                      <label for="admin_bank_card_id" class="col-4 col-sm-3 col-md-2 col-form-label">واریز به حساب</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <select name="admin_bank_card_id" class="form-control">
                          @foreach(\App\Models\AdminBankCard::all() as $bankCard)
                              <option value="{{ $bankCard->id }}" @selected($bankCard->id == $invoice->admin_bank_card_id)>{{ $bankCard->card_number }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="file_id" class="col-4 col-sm-3 col-md-2 col-form-label">فایل</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <input type="text" id="file_id" class="form-control" name="file_id" value="{{$invoice->file_id}}">
                      </div>
                    </div>
                    <hr>
                    <div class="form-group text-center">
                      <button type="submit" class="btn btn-danger waves-effect waves-light">ذخیره تغییرات</button>
                    </div>
                  </form>
                </div>
                <div class="col-lg-3 col-md-12 col-12">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                      <div class="card">
                        <div class="card-block">
                          <h4 class="card-title">تاریخ ایجاد : <b class="ltr_text">{{ verta($invoice->created_at)->format('Y/m/d-H:i')}}</b> </h4>
                          <p class="card-text">این تراکنش توسط ادمین <b>{{$invoice->admin->name??""}}</b> مورد بررسی قرار گرفته است.</p>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted">آخرین به روز رسانی : <b class="ltr_text">{{ verta($invoice->updated_at)->format('Y/m/d-H:i')}}</b> </small>
                        </div>
                      </div>
                    </div>
                  </div>
                  @if($invoice->file_id)
                    <div class="row mt-3">
                      <div class="col-lg-12 col-md-12 col-12">
                        <div class="card">
                          <div class="card-block">
                            <h4 class="card-title">عکس کارت</h4>
                            <p class="card-text">
                              <img src="{{ route('file.get', [$invoice->file_id]) }}" class="img-fluid img-rounded m-b-10 w-100 cursor-pointer" style="box-shadow: 0 0 20px 1px #66666652;">
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    function updateCheckbox(checkbox) {
      if (checkbox.checked) {
        checkbox.value = 1;
      }
    }
  </script>
@endpush
