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
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-10">  شرایط خاص بیمار  {{$model->Patient->fullname}}  </h3>
                        <a href="{{route("PatientSpecialCondition.edit",$model->id)}}">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">
                                ویرایش شرایط خاص بیمار
                            </button>
                        </a>
                        <hr/>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table">
                                <tbody>
                                <tr>
                                    <td>قد</td>
                                    <td>{{$model->height}}</td>
                                </tr>
                                <tr>
                                    <td>وزن</td>
                                    <td>{{$model->weight}}</td>
                                </tr>
                                <tr>
                                    <td>نارسایی کلیوی</td>
                                    <td>{{$model->naresayi_koliavi}}</td>
                                </tr>
                                <tr>
                                    <td>مصرف سیگار</td>
                                    <td>{{$model->masrafe_sigar}}</td>
                                </tr>
                                <tr>
                                    <td>کمبود g6pd</td>
                                    <td>{{$model->kambode_g6pd}}</td>
                                </tr>
                                <tr>
                                    <td>نارسایی کبدی</td>
                                    <td>{{$model->naresayi_kabedi}}</td>
                                </tr>
                                <tr>
                                    <td>رادیولوژی</td>
                                    <td>{{$model->radiology}}</td>
                                </tr>
                                <tr>
                                    <td>مصرف الکل</td>
                                    <td>{{$model->masrafe_alcol}}</td>
                                </tr>
                                <tr>
                                    <td>حساسیت دارویی</td>
                                    <td>{{$model->hasasiate_daruyi}}</td>
                                </tr>
                                <tr>
                                    <td>توضیحات حساسیت دارویی</td>
                                    <td>{{$model->hasasiate_daruyi_desc}}</td>
                                </tr>
                                <tr>
                                    <td>سو مصرف مواد</td>
                                    <td>{{$model->soe_masrafe_mavad}}</td>
                                </tr>
                                <tr>
                                    <td>توضیحات سو مصرف مواد</td>
                                    <td>{{$model->soe_masrafe_mavad_desc}}</td>
                                </tr>
                                <tr>
                                    <td>بارداری</td>
                                    <td>{{$model->bardari}}</td>
                                </tr>
                                <tr>
                                    <td>هفته بارداری</td>
                                    <td>{{$model->bardari_weeks}}</td>
                                </tr>
                                <tr>
                                    <td>شیردهی</td>
                                    <td>{{$model->shirdehi}}</td>
                                </tr>
                                <tr>
                                    <td>آنتی بیوتیک</td>
                                    <td>{{$model->anti_biotic}}</td>
                                </tr>
                                <tr>
                                    <td>نام آنتی بیوتیک</td>
                                    <td>{{$model->anti_biotic_name}}</td>
                                </tr>
                                <tr>
                                    <td>واکسن</td>
                                    <td>{{$model->vaksan}}</td>
                                </tr>    <tr>
                                    <td>نام واکسن</td>
                                    <td>{{$model->vaksan_name}}</td>
                                </tr>
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
