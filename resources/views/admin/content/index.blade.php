@extends('admin.layout.main')

@section('title', 'محتوای سایت')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-4 col-md-6 col-12">
                    <h4 class="page-title">
                        محتوای سایت
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-10"> لیست محتوای سایت </h3>

                        <hr/>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table">
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>صفحه</th>
                                    <th>موقعیت</th>
                                    <th> نام مستعار</th>
                                    <th> عنوان</th>
                                    <th>عنوان فرعی</th>
                                    <th>محتوا</th>
                                    <th>عکس</th>
                                    <th>دارای عنوان</th>
                                    <th>دارای عنوان فرعی</th>
                                    <th>دارای عکس</th>
                                    <th>دارای محتوا</th>
                                    <th>ویرایش</th>

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

                ajax: '{!! route('content.dataTable') !!}',
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
                    {data: 'page', name: 'page'},
                    {data: 'location', name: 'location'},
                    {data: 'alias', name: 'alias'},
                    {data: 'title', name: 'title'},
                    {data: 'subtitle', name: 'subtitle'},
                    {data: 'content', name: 'content'},
                    {data: 'image', name: 'image'},
                    {data: 'has_title', name: 'has_title'},
                    {data: 'has_subtitle', name: 'has_subtitle'},
                    {data: 'has_content', name: 'has_content'},
                    {data: 'has_image', name: 'has_image'},
                    {data: 'edit', name: 'edit'},
                ],
            });
        });
    </script>

@endpush
