@extends('admin.layout.main')
@section('title','اخبار')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-6 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            اخبار
          </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="white-box">
            <div class="box-title m-b-10">
              <div class="float-left">
                <h3 class="box-title"> لیست اخبار </h3>
              </div>
              <div class="float-right">
              <button alt="default" data-toggle="modal" data-target="#add-news" class="btn btn-custom btn-rounded">ثبت  جدید</button>
              </div>
              <div class="clearfix"></div>
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
            <div class="table-responsive">
              {{ $dataTable->table() }}
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="add-news" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">ثبت خبر جدید</h4>
        </div>
        <form action="{{ route('admin.new.store')}}" method="post">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="title" class="control-label">عنوان خبر :</label>
              <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
              <label for="content" class="control-label">متن خبر :</label>
              <textarea type="text" class="form-control" id="content" name="content"></textarea>
            </div>
            <div class="form-group">
              <label for="group_id">گروه : </label>
              <div class="input-group">
                <select class="form-control" name="group_id">
                  <option value="">همه</option>
                  @foreach(\App\Enum\UserGroupEnum::cases() as $item)
                    <option value="{{$item->value}}">{{$item->getLabel()}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="color">رنگ : </label>
              <div class="input-group">
                <select class="form-control" name="color">
                  @foreach(\App\Enum\NewsColor::cases() as $item)
                    <option value="{{$item->value}}">{{$item->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
            <button type="submit" class="btn btn-danger waves-effect waves-light">ایجاد خبر</button>
          </div>
        </form>
      </div>
    </div>
  </div>
 @endsection

@push('scripts')
  {{ $dataTable->scripts() }}
@endpush
