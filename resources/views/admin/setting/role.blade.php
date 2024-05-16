@extends('admin.layout.main')
@section('title','نقش ها')

@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-6 col-12">
          <h4 class="page-title">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            /
            نقش ها
          </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="white-box">
            <h3 class="box-title m-b-10"> لیست نقش ها </h3>
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

            <div class="float-right">
              <form action="{{ route('admin.setting.roles.sync') }}">
              <button alt="default" data-toggle="modal" data-target="#add-new-server" class="btn btn-custom btn-rounded">
                ساختن نقش ها
              </button>
              </form>
            </div>

            <div class="table-responsive">
              <table class="table table-striped text-right">
                <thead>
                <tr>
                  <th>#</th>
                  <th>نقش</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                  <tr>
                    <td>
                      {{$role->id}}
                    </td>
                    <td>
                      {{$role->name}}
                    </td>
                  </tr>
                @endforeach

                </tbody>
              </table>
            </div>

            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
 @endsection

@push('scripts')

@endpush
