@extends('admin.layout.main')

@section('title','ویرایش محتوا ')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-4 col-md-5 col-12">
                        <h4 class="page-title">
                            <a href="{{ route('content.index') }}">
                                محتوا
                            </a>
                            /
                            ویرایش محتوا
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="white-box">
                            @if ($errors && $errors->any())
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
                                    <form action="{{ route('content.update',$model->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                         <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="page">صفحه : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="page" value="{{$model->page}}"
                                                               name="page">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="location">موقعیت : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="location" value="{{$model->location}}"
                                                               name="location">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="alias">نام مستعار : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="alias" value="{{$model->alias}}"
                                                               name="alias">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">عنوان : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="title" value="{{$model->title}}"
                                                               name="title">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="subtitle">عنوان فرعی : </label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="subtitle" value="{{$model->subtitle}}"
                                                               name="subtitle">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="strength">دارای محتوا : </label>
                                                    <div class="input-group">
                                                        <input  type="checkbox" @checked($model->has_content) class="js-switch" data-color="#f96262"   id="has_content" name="has_content" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="image">عکس : </label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="image" value="{{$model->image}}"
                                                               name="image">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="strength">دارای عنوان : </label>
                                                    <div class="input-group">
                                                        <input  type="checkbox" @checked($model->has_title) class="js-switch" data-color="#f96262"   id="has_title" name="has_title" value="1">

                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="strength">دارای عنوان فرعی : </label>
                                                    <div class="input-group">
                                                        <input  type="checkbox" @checked($model->has_subtitle) class="js-switch" data-color="#f96262"   id="has_subtitle" name="has_subtitle" value="1">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="strength"> دارای عکس : </label>
                                                    <div class="input-group">
                                                        <input  type="checkbox" @checked($model->has_image) class="js-switch" data-color="#f96262"   id="has_image" name="has_image" value="1">

                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                        <div class="row">
                                            <div class="  col-12">
                                                <div class="form-group">
                                                    <label for="content">محتوا : </label>
                                                    <div class="input-group">
                                                        <textarea id="mymce" name="content">{{old("content",$model->content)}}</textarea>

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
                                                    <h4 class="card-title"> ویرایش محتوا </h4>
                                                </div>
                                                <div class="card-footer">
                                                    <small class="text-muted">تاریخ ایجاد: <b class="ltr_text">{{ verta($model->created_at)->format('Y/m/d-H:i')}}</b></small>
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
@push("scripts")

    <script src={{asset("admin-assets/plugins/tinymce/langs/fa_IR.js")}}></script>
    <script src={{asset("admin-assets/plugins/tinymce/tinymce.min.js")}}></script>
    <script>
        $(document).ready(function() {

            if ($("#mymce").length > 0) {
                tinymce.init({
                    selector: "textarea#mymce",
                    directionality : 'rtl',
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "newdocument | undo redo | styleselect | bold italic removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

                });
            }
        });
    </script>
@endpush
