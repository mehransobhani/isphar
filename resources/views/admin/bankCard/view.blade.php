@extends('admin.layout.main')

@section('title','مشاهده کارت بانکی')
@section('content')
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-4 col-md-5 col-12">
            <h4 class="page-title">
              <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
              /
              <a href="{{ route('admin.card.index') }}">
                کارت های بانکی
              </a>
              /
              مشاهده کارت بانکی ({{$card->id}})
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
                  <form action="{{ route('admin.card.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$card->id}}">
                    <div class="form-group row">
                      <label for="bank" class="col-4 col-sm-3 col-md-2 col-form-label">نام بانک</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <input class="form-control" type="text" value="{{$card->bank}}" id="bank" name="bank">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="first_name" class="col-4 col-sm-3 col-md-2 col-form-label">نام</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <input class="form-control" type="text" value="{{$card->first_name}}" id="first_name" name="first_name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="last_name" class="col-4 col-sm-3 col-md-2 col-form-label">نام خانوادگی</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <input class="form-control" type="text" value="{{$card->last_name}}" id="last_name" name="last_name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="card_number" class="col-4 col-sm-3 col-md-2 col-form-label">شماره کارت</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <input class="form-control" type="text" value="{{$card->card_number}}" id="card_number" name="card_number">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="depositNumber" class="col-4 col-sm-3 col-md-2 col-form-label">شماره حساب</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <input class="form-control" type="text" value="{{$card->depositNumber}}" id="depositNumber" name="depositNumber">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="iban" class="col-4 col-sm-3 col-md-2 col-form-label">شماره شبا</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <input class="form-control" type="text" value="{{$card->iban}}" id="iban" name="iban">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="card_image_file_id" class="col-4 col-sm-3 col-md-2 col-form-label">آدرس تصویر</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <input class="form-control" type="text" value="{{$card->card_image_file_id}}" id="card_image_file_id" name="card_image_file_id">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="status" class="col-4 col-sm-3 col-md-2 col-form-label">وضعیت</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <select name="status" id="status" class="form-control">
                          @foreach (\App\Enum\BankCardStatus::toArray() as $key => $value)
                              <option value="{{ $key }}" {{ $card->status->value == $key ? 'selected' : '' }}>
                                  {{ $value['label'] }}
                              </option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="default" class="col-4 col-sm-3 col-md-2 col-form-label">کارت پیشفرض</label>
                      <div class="col-8 col-sm-9 col-md-10">
                        <input type="checkbox" value="{{$card->default}}" id="default" name="default" {{ $card->default ? 'checked' : '' }} onchange="updateCheckbox(this)">
                      </div>
                    </div>
                    @if($card->reason_id)
                      <div class="form-group row">
                        <label for="reason" class="col-4 col-sm-3 col-md-2 col-form-label">دلیل رد</label>
                        <div class="col-8 col-sm-9 col-md-10">
                          @php
                              $cardReasons = \App\Models\BankCardReason::all();
                          @endphp
                          <select name="reason" id="reason" class="form-control">
                            @foreach($cardReasons as $reason)
                                <option value="{{ $reason->id }}" {{ $card->reason_id == $reason->id ? 'selected' : '' }}>{{ $reason->title }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    @endif
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
						  <h4 class="card-title">تاریخ ایجاد : <b class="ltr_text">{{ verta($card->created_at)->format('Y/m/d-H:i')}}</b></h4>
                          <p class="card-text">این کارت توسط ادمین <b>{{$card->admin->name??""}}</b> مورد بررسی قرار گرفته است.</p>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted">آخرین به روز رسانی : <b class="ltr_text">{{ verta($card->updated_at)->format('Y/m/d-H:i')}}</b> </small>
                        </div>
                      </div>
                    </div>
                  </div>
                  @if($card->card_image_file_id)
                  <div class="row mt-3">
                    <div class="col-lg-12 col-md-12 col-12">
                      <div class="card">
                        <div class="card-block">
                          <h4 class="card-title">عکس کارت</h4>
                          <p class="card-text">
                            <img src="{{ route('file.get', [$card->card_image_file_id]) }}" class="img-fluid img-rounded m-b-10 w-100 cursor-pointer" style="box-shadow: 0 0 20px 1px #66666652;">
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
