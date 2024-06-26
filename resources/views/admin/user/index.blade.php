@extends('admin.layout.main')

@section('title', 'کاربران')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-4 col-md-6 col-12">
                    <h4 class="page-title">

                    کاربران
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-10"> لیست کاربران </h3>
                        <a href="{{route("user.create")}}">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10"> افزودن کاربر</button>
                        </a>
                        <hr/>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table">
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>موبایل</th>
                                     <th>نام  </th>
                                    <th>شماره  </th>
                                    <th>نام داروساز</th>
                                    <th>نام خانوادگی داروساز  </th>
                                    <th>کد پزشکی</th>
                                    <th>تصویر امضا</th>
                                    <th>تاریخ ایجاد</th>

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

                ajax: '{!! route('user.dataTable') !!}',
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
                    { data: 'mobile', name: 'mobile' },
                     { data: 'name', name: 'name' },
                    { data: 'tell', name: 'tell' },
                    { data: 'pharmacist_firstname', name: 'pharmacist_firstname' },
                    { data: 'pharmacist_lastname', name: 'pharmacist_lastname' },
                    { data: 'medical_code', name: 'medical_code' },
                     { data: 'sign_image', name: 'sign_image' },
                    { data: 'created_at', name: 'created_at' },
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
