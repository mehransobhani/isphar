@extends('admin.layout.main')


@section('title','پروفایل')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-5 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            <strong>
              پروفایل
            </strong>

          </h4>
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
      <div class="row">
        <div class="col-md-12 col-12">
          <div class="white-box">
            <div class="user-btm-box">
              <div class="row text-center">
                <div class="col-md-2 b-l"><strong> نام :</strong>
                  <p>{{$admin->name}}</p>
                </div>
                <div class="col-md-2 b-l"><strong>ایمیل :</strong>
                  <div>
                    <form action="{{ route('admin.profile.email-update') }}" method="post">
                      @csrf
                      <input type="hidden" name="id" class="form-control" value="{{$admin->id}}"/>
                      <input type="text" name="email" class="form-control" value="{{$admin->email}}"/>
                      <button class="btn btn-custom mt-3">
                        تغییر
                      </button>
                    </form>
                  </div>
                </div>
                <div class="col-md-2 b-l"><strong>شماره کارت :</strong>
                  <div>
                    <form action="{{ route('admin.profile.update-card-number') }}" method="post">
                      @csrf
                      <input type="hidden" name="id" class="form-control" value="{{$admin->id}}"/>
                      <input type="text" name="card" class="form-control" value="{{$admin->card_number}}"/>
                      <button class="btn btn-custom mt-3">
                        تغییر
                      </button>
                    </form>
                  </div>
                 </div>
                <div class="col-md-2 b-l"><strong> امتیاز :</strong>
                  <p>{{$admin->point}}</p>
                </div>
                <div class="col-md-2 b-l"><strong>والت :</strong>
                  <p>{{$admin->wallet}}</p>
                </div>
                <div class="col-md-2 b-l"><strong>نقش :</strong>
                  <p>{{ \App\Classes\Role\GetRoleName::getRole($admin)}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-12">
          <div class="white-box">
            <div class="row">
              <div class="col-md-6 b-l">
                <div class="box-title">
                  <div class="float-left m-t-10">
                    <h3 class="box-title"> عملیات : </h3>
                  </div>
                  <div class="float-right" style="margin: inherit;">
                    <form action="{{ route('admin.profile.wallet') }}" method="post">
                      @csrf
                      <input type="hidden" name="id" value="{{$admin->id}}">
                        <button class="btn btn-custom mt-3">
                          انتقال هزینه به کیف پول
                        </button>
                    </form>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div>
                  
                </div>
                <div class="table-responsive m-t-15">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>توضیحات</th>
                        <th> تاریخ </th>
                      </tr>
                    </thead>
                    <tbody>
                      @if ($TransferToClientArea && count($TransferToClientArea) > 0)
                        @foreach ($TransferToClientArea as $index => $message)
                          <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $message->id }}</td>
                              <td>{{ $message->description }}</td>
                              <td>{{ $message->created_at }}</td>
                          </tr>
                        @endforeach
                      @else
                      <tr>
                        <td colspan="3">نتیجه ای یافت نشد</td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="box-title m-b-10">
                  <div class="float-left m-t-10">
                    <h3 class="box-title"> عملیات </h3>
                  </div>
                  <div class="float-right" style="margin: inherit;">
                    <form action="{{ route('admin.profile.checkout') }}" method="post">
                      @csrf
                      <input type="hidden" name="id" value="{{$admin->id}}">
                      <button class="btn btn-custom mt-3">
                        درخواست تسویه
                      </button>
                    </form>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div>
                  <div class="table-responsive m-t-15">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>هزینه</th>
                          <th>کد پیگیری</th>
                          <th>شماره کارت</th>
                          <th>  تصویر </th>
                          <th>  تاریخ </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($checkouts ?? [] as $checkout)
                        <tr>
                          <td>
                            {{$checkout->id}}
                          </td>
                          <td>
                            <span class="ltr_text">
                              {{$checkout->amount}} YC
                            </span>
                          </td>
                          <td>
                            {{$checkout->tracking_code}}
                          </td>
                          <td>
                            {{$checkout->card_number}}
                          </td>
                          <td>
                            @if($checkout->file_id)
                              <img src="{{ route('file.get', [$checkout->file_id]) }}"
                                   data-image="{{ route('file.get', [$checkout->file_id]) }}"
                                   class="showImagePrevModal h-100 rounded-3 aspect-ratio:1/1 cursor-pointer"
                                   style="width: 50px;">
                            @endif
                          </td>
                          <td>
                            <p>{{ verta($checkout->created_at)->format('Y/m/d-H:i') }}</p>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                    {{$checkouts->links()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body text-center">
          <img id="modalImage" class="img-fluid" src="#" alt="Large Image">
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      $('.showImagePrevModal').on('click', function () {
        var imgSrc = $(this).data('image');
        $('#modalImage').attr('src', imgSrc);
        $('#imageModal').modal('show');
      });
    });
  </script>
@endpush
