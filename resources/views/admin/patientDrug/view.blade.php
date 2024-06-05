@extends('admin.layout.main')

@section('title', 'داشبورد')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-4 col-md-6 col-12">
                    <h4 class="page-title">

                        بیماران
                    </h4>
                </div>
            </div>
            @foreach($models as $model)

            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-10">  تلفیق دارویی بیمار  {{$model->Patient->fullname}}  </h3>
                        <a href="{{route("patient_drug.edit",$model->id)}}">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">
                                ویرایش تلفیق دارویی بیمار
                            </button>
                        </a>
                        <hr/>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table">
                                <tbody>
                                <tr>
                                    <td>دارو</td>
                                    <td>{{$model->drug_id}}</td>
                                </tr>
                                <tr>
                                    <td>نوع</td>
                                    <td>{{$model->type}}</td>
                                </tr>
                                <tr>
                                    <td>نام</td>
                                    <td>{{$model->name}}</td>
                                </tr>
                                <tr>
                                    <td>زمان مصرف</td>
                                    <td>{{$model->usage_intervals}}</td>
                                </tr>
                                <tr>
                                    <td>تاریخ مصرف آخرین دوز  </td>
                                    <td>{{$model->last_dose_date}}</td>
                                </tr>
                                <tr>
                                    <td>مقدار دوز  </td>
                                    <td>{{$model->dose_amount}}</td>
                                </tr>
                                <tr>
                                    <td>دستور پزشک معالج</td>
                                    <td>{{$model->doctor_order}}</td>
                                </tr>
                                <tr>
                                    <td>دارای هشدار</td>
                                    <td>{{$model->has_alert}}</td>
                                </tr>
                                <tr>
                                    <td>توضیحات</td>
                                    <td>{{$model->description}}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var descriptionContainers = document.querySelectorAll('.description-container');

            descriptionContainers.forEach(function (container) {
                var fullDescription = container.getAttribute('data-full-description');

                if (fullDescription.length <= 60) {
                    container.innerHTML = fullDescription;
                } else {
                    var maxLength = Math.floor(fullDescription.length * 0.8);
                    container.innerHTML = fullDescription.substring(0, maxLength) + '...';
                }
            });
        });
    </script>

@endpush
