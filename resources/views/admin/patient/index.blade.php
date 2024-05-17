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
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10"> افزودن بیمار</button>
                        </a>
                        <hr/>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table">
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>نام کامل</th>
                                    <th>کد ملی</th>
                                    <th>نام اتاق</th>
                                    <th>تاریخ تولد</th>
                                    <th>جنسیت</th>
                                    <th>تاریخ پذیرش</th>
                                    <th>شماره فایل</th>
                                    <th>شماره اتاق</th>
                                    <th>شماره تخت</th>
                                    <th>دکتر</th>
                                    <th>علت</th>
                                    <th>منبع</th>
                                    <th>شماره منبع</th>
                                    <th>توضیحات</th>
                                    <th>عملیات</th>
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
        $(function() {

            $('#users-table').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{!! route('data-table') !!}',
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
                    { data: 'id', name: 'id' },
                    { data: 'fullname', name: 'fullname' },
                    { data: 'national_code', name: 'national_code' },
                    { data: 'room_name', name: 'room_name' },
                    { data: 'birth_date', name: 'birth_date' },
                    { data: 'gender', name: 'gender' },
                    { data: 'admission_date', name: 'admission_date' },
                    { data: 'file_number', name: 'file_number' },
                     { data: 'room_number', name: 'room_number' },
                    { data: 'bed_number', name: 'bed_number' },
                    { data: 'doctor', name: 'doctor' },
                    { data: 'cause', name: 'cause' },
                    { data: 'source', name: 'source' },
                    { data: 'source_number', name: 'source_number' },
                    { data: 'description', name: 'description' },
                    { data: 'edit', name: 'edit' },
                ],

            });

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var descriptionContainers = document.querySelectorAll('.description-container');

            descriptionContainers.forEach(function(container) {
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
