@extends('admin.layout.main')

@section('title', 'دسته بندی بلاگ ها')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-4 col-md-6 col-12">
                    <h4 class="page-title">
                        دسته بندی بلاگ ها
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-10"> لیست دسته بندی بلاگ ها </h3>
                        <a href="{{route("post_cat.create")}}">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10"> افزودن
                                دسته بندی بلاگ
                            </button>
                        </a>
                        <hr/>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table">
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>نام </th>
                                    <th>نام مستعار</th>
                                    <th>تصویر</th>
                                     <th>تاریخ ایجاد</th>
                                    <th>ویرایش</th>
                                    <th>حذف</th>

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

                ajax: '{!! route('post_cat.dataTable') !!}',
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
                    {data: 'name', name: 'name'},
                    {data: 'alias', name: 'alias'},
                    {data: 'image', name: 'image'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'edit', name: 'edit'},
                    {data: 'delete', name: 'delete'},
                ],


            });

        });
    </script>


@endpush
