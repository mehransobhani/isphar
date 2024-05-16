@extends('admin.layout.main')


@section('title','مشاهده تیکت')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-5 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            <a href="{{ route('admin.ticket.index') }}">
              تیکت ها
            </a>
            /
            مشاهده تیکت ({{$ticket->id}})
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
        <div class="col-lg-6 col-md-12 col-12">
          <div class="white-box">
            <div class="user-btm-box">
              <div class="row text-center">
                <div class="col-md-3 b-l"><strong>شناسه تیکت :</strong>
                  <p>{{$ticket->id}}</p>
                </div>
                <div class="col-md-3 b-l"><strong>عنوان :</strong>
                  <p>{{$ticket->title}}</p>
                </div>
                <div class="col-md-3 b-l"><strong>دپارتمان :</strong>
                  <p>{{ config('ticket.departments.' . $ticket->department, $ticket->department) }}</p>
                </div>
                <div class="col-md-3 "><strong>وضعیت تیکت :</strong>
                  <p>{{ $ticket->status->text() }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
          <div class="white-box">
            <div class="user-btm-box">
              <div class="row text-center">
                <div class="col-md-3 b-l"><strong>شناسه سرویس :</strong>
                  @if($ticket->service_id)
                    <p><a
                        href="{{ route('admin.service.view', ['id' => $ticket->service_id]) }}">{{ $ticket->service_id }}</a>
                    </p>
                  @else
                    <p>ندارد</p>
                  @endif
                </div>
                <div class="col-md-3 b-l"><strong>تاریخ ایجاد :</strong>
                  <p>{{ verta($ticket->created_at)->format('Y/m/d-H:i') }}</p>
                </div>
                <div class="col-md-3 b-l"><strong>آخرین بروزرسانی :</strong>
                  <p>{{ verta($ticket->updated_at)->format('Y/m/d-H:i') }}</p>
                </div>
                <div class="col-md-3 b-l"><strong>لاگ مربوط به این تیکت :</strong>
                  <p>
                    <a href="{{ route('admin.ticket.log', $ticket->id) }}" target="_blank" class="btn btn-block btn-custom mt-3">
                      مشاهده
                    </a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-12 col-12">
          <div class="white-box">
            <form method="post" action="{{ route('admin.ticket.change-operator') }}">
              @csrf
                <input type="hidden" name="id" value="{{$ticket->id}}">
                <h5>ارجاع تیکت</h5>
                <select class="form-control" name="operator">
                  @if(empty($ticket->operator))
                    <option value="" selected>انتخاب نشده</option>
                  @else
                    <option value="">انتخاب نشده</option>
                  @endif
                  @foreach(\App\Enum\Roles::cases() as $role)
                  <option value="{{$role->value}}" @if($ticket->operator && $ticket->operator->value == $role->value) selected @endif>{{$role->text()}}</option>
                  @endforeach
                </select>
                <button class="btn btn-block btn-custom mt-3"> ارجاع </button>
            </form>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
          <div class="white-box">
            <form method="post" action="{{ route('admin.ticket.change-status') }}">
              @csrf
              <input type="hidden" name="id" value="{{$ticket->id}}">
              <h5> تغییر وضعیت تیکت </h5>
              <select class="form-control" name="status" {{ $ticket->status->value == \App\Enum\TicketStatus::CLOSED->value ? 'disabled' : '' }}>
                @foreach(\App\Enum\TicketStatus::cases() as $status)
                    <option value="{{ $status->value }}" {{ $ticket->status->value == $status->value ? 'selected' : '' }}>
                        {{ $status->text() }}
                    </option>
                @endforeach
              </select>
              <button class="btn btn-block btn-custom mt-3">
                تغییر وضعیت
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="chat-main-box">
        <div class="chat-right-aside" style="margin-right: 0px !important;">
          <div class="chat-main-header">
            <div class="p-10 b-b">
              <h3 class="box-title">پیام چت</h3>
            </div>
          </div>
          <div class="chat-box">
            <ul class="chat-list slimscroll p-t-30">
              @foreach($ticket->messages as $message)
                <li class="{{ $message->is_admin || $message->is_system ? 'odd' : '' }}">
                  <div class="chat-image">
                    <img alt="user" src="{{ asset('/assets/img/user.png') }}">
                  </div>
                  <div class="chat-body">
                    <div class="chat-text">
                    @if($message->is_admin)
                        <h4 class="b-b p-10 text-center">{{ $message->admin ? $message->admin->name : 'Unknown Admin' }}</h4>
                    @elseif($message->user_id)
                        <h4 class="b-b p-10 text-center">{{ $message->user->fullName }}</h4>
                    @else
                        <h4 class="b-b p-10 text-center">پیام سیستمی</h4>
                    @endif

                      <p class="p-10 text-right">{{ $message->message }}</p>

                      <b class="ltr_text">{{ verta($message->created_at)->format('Y/m/d-H:i') }}</b>
                      <div class="clearfix"></div>
                      @if($message->file_id)
                        <img src="{{ route('file.get', [$message->file_id]) }}"
                             data-image="{{ route('file.get', [$message->file_id]) }}"
                             class="showImagePrevModal h-100 rounded-3 aspect-ratio:1/1 cursor-pointer"
                             style="width: 200px;">
                      @endif
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
            <hr>
            @if($ticket->status->value != \App\Enum\TicketStatus::CLOSED->value)
            <form action="{{ route('admin.ticket.submit') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" value="{{$ticket->id}}" name="ticket_id">
              <div class="form-group row p-15 text-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                  <textarea class="form-control mb-5" placeholder="پیام خود را وارد کنید" name="message"
                            required></textarea>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                  <input type="file" name="file" id="" class="form-control" data-toggle="tooltip" title="پیوست فایل">
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-1">
                  <button class="btn btn-danger btn-rounded" type="submit">ارسال</button>
                </div>
              </div>
            </form>
            @else
                <div class="row p-15">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="alert alert-danger"> در وضعیت بسته ، امکان ثبت پاسخ وجود ندارد </div>
                    </div>
                </div>
            @endif
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
