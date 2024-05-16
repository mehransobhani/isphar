@extends('admin.layout.main')

@section('title','ویرایش خبر')
@section('content')
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-4 col-md-5 col-12">
            <h4 class="page-title">
              <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
              /
              <a href="{{ route('admin.new.index') }}">
                اخبار
              </a>
              /
              ویرایش خبر ({{$new->id}})
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
                  <form action="{{ route('admin.new.update',$new->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$new->id}}">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                          <label for="title">عنوان : </label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{old('title',$new->title)}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                          <label for="content">محتوا : </label>
                          <div class="input-group">
                            <textarea type="text" class="form-control" id="content" name="content">{{old('content',$new->content)}}</textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                          <label for="group_id">گروه : </label>
                          <div class="input-group">

                            <select class="form-control" name="group_id">
                              <option value="">همه</option>
                              @foreach(\App\Enum\UserGroupEnum::cases() as $item)
                                <option @selected($new->group_id && $item->value==$new->group_id->value) value="{{$item->value}}">{{$item->getLabel()}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                          <label for="color">رنگ : </label>
                          <div class="input-group">
                            <select class="form-control" name="color">
                              @foreach(\App\Enum\NewsColor::cases() as $item)
                                <option value="{{$item->value}}" @selected($new->color && $item->value==$new->color->value) >{{$item->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                          <label for="group_id">وضعیت : </label>
                          <div class="input-group">

                            <select class="form-control" name="status">
                               @foreach(\App\Enum\NewStatus::cases() as $item)
                                <option @selected($new->status && $item->value==$new->status->value) value="{{$item->value}}">{{$item->text()}}</option>
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
                <div class="col-lg-3">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                      <div class="card">
                        <div class="card-block">
                          <h4 class="card-title">تاریخ ایجاد : <b class="ltr_text">{{ verta($new->created_at)->format('Y/m/d-H:i')}}</b></h4>
                          <p class="card-text">این خبر توسط ادمین <b>{{$new->admin->name}}</b> مورد بررسی قرار گرفته است.</p>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted">آخرین به روز رسانی : <b class="ltr_text">{{ verta($new->created_at)->format('Y/m/d-H:i')}}</b></small>
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
