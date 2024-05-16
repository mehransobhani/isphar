@extends('admin.layout.main')

@section('title','ویرایش دلیل رد کارت بانکی')
@section('content')
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-4 col-md-5 col-12">
            <h4 class="page-title">
              <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
              /
              <a href="{{ route('admin.card-reason.index') }}">
                دلیل رد کارت بانکی
              </a>
              /
              ویرایش دلیل رد کارت بانکی ({{$cardReason->id}})
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
              <div class="row">
                <div class="col-lg-9 col-md-12 col-12">
                  <form action="{{ route('admin.card-reason.update',$cardReason->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $cardReason->id }}">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                          <label for="title">عنوان : </label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="title" name="title" value="{{ $cardReason->title }}">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                          <label for="content">توضیحات : </label>
                          <div class="input-group">
                            <textarea type="text" class="form-control" id="content" name="content">{{ $cardReason->content }}</textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                          <label for="content">وضعیت : </label>
                          <div class="input-group">
                            <select class="form-control" name="status">
                              @foreach(\App\Enum\BankCardReasonStatus::cases() as $item)
                                <option @selected($cardReason->status && $item->value==$cardReason->status->value) value="{{$item->value}}">{{$item->text()}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                          <div class="text-center">
                            <button type="reset" class="btn btn-inverse waves-effect waves-light">انصراف</button>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">ثبت</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-lg-3 col-md-12 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="card">
                              <div class="card-block">
                                <h4 class="card-title">تاریخ ایجاد : <b class="ltr_text">{{ verta($cardReason->created_at)->format('Y/m/d-H:i')}}</b></h4>
                              </div>
                              <div class="card-footer">
                                <small class="text-muted">آخرین به روز رسانی : <b class="ltr_text">{{ verta($cardReason->updated_at)->format('Y/m/d-H:i')}}</b></small>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
