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
                        <h3 class="box-title m-b-10"> لیست بیماران </h3>
                        <a href="{{route("patient.create")}}">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10"> افزودن
                                بیمار
                            </button>
                        </a>
                        <hr/>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table">
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>قد</th>
                                    <th>وزن</th>
                                    <th>نارسایی کلیوی</th>
                                    <th>مصرف سیگار</th>
                                    <th>کمبود g6pd</th>
                                    <th>نارسایی کبدی</th>
                                    <th>رادیولوژی</th>
                                    <th>مصرف الکل</th>
                                    <th> حساسیت دارویی</th>
                                    <th>توضیحات حساسیت دارویی</th>
                                    <th>سو مصرف مواد</th>
                                    <th>توضیحات سو مصرف مواد</th>
                                    <th>بارداری</th>
                                    <th>هفته بارداری</th>
                                    <th>آنتی بیوتیک</th>
                                    <th>نام آنتی بیوتیک</th>
                                    <th>شیردهی</th>
                                    <th> واکسن</th>
                                    <th>نام واکسن</th>

                                </tr>
                                </thead>
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
        $(function () {

            $('#users-table').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{!! route('PatientSpecialCondition.dataTable') !!}',
                language: {
                    "decimal": "",
                    "emptyTable": "هیچ داده‌ای موجود نیست",
                    "info": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                    "infoEmpty": "نمایش 0 تا 0 از 0 رکورد",
                    "infoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "نمایش _MENU_ رکورد",
                    "loadingRecords": "در حال بارگزاری...",
                    "processing": "در حال پردازش...",
                    "search": "جستجو:",
                    "zeroRecords": "رکوردی با این مشخصات پیدا نشد",
                    "paginate": {
                        "first": "اول",
                        "last": "آخر",
                        "next": "بعدی",
                        "previous": "قبلی"
                    },
                    "aria": {
                        "sortAscending": ": فعال سازی نمایش به صورت صعودی",
                        "sortDescending": ": فعال سازی نمایش به صورت نزولی"
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'height', name: 'height'},
                    {data: 'weight', name: 'weight'},
                    {data: 'naresayi_koliavi', name: 'naresayi_koliavi'},
                    {data: 'masrafe_sigar', name: 'masrafe_sigar'},
                    {data: 'kambode_g6pd', name: 'kambode_g6pd'},
                    {data: 'naresayi_kabedi', name: 'naresayi_kabedi'},
                    {data: 'radiology', name: 'radiology'},
                    {data: 'masrafe_alcol', name: 'masrafe_alcol'},
                    {data: 'hasasiate_daruyi', name: 'hasasiate_daruyi'},
                    {data: 'hasasiate_daruyi_desc', name: 'hasasiate_daruyi_desc'},
                    {data: 'soe_masrafe_mavad', name: 'soe_masrafe_mavad'},
                    {data: 'soe_masrafe_mavad_desc', name: 'soe_masrafe_mavad_desc'},
                    {data: 'bardari', name: 'bardari'},
                    {data: 'bardari_weeks', name: 'bardari_weeks'},
                    {data: 'anti_biotic', name: 'anti_biotic'},
                    {data: 'anti_biotic_name', name: 'anti_biotic_name'},
                    {data: 'shirdehi', name: 'shirdehi'},
                    {data: 'vaksan', name: 'vaksan'},
                    {data: 'vaksan_name', name: 'vaksan_name'},
                ],

            });

        });
    </script>
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
