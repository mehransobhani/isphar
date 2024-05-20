@extends('admin.layout.main')

@section('title', 'دارو ها')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-4 col-md-6 col-12">
                    <h4 class="page-title">
                        دارو ها
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-10"> لیست دارو ها </h3>
                        <a href="{{route("drug.create")}}">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10"> افزودن
                                دارو
                            </button>
                        </a>
                        <hr/>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table">
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>نام فارسی</th>
                                    <th>نام انگلیسی</th>
                                    <th>نام برند فارسی</th>
                                    <th>نام برند انگلیسی</th>
                                    <th>طریقه مصرف</th>
                                    <th>شکل</th>
                                    <th>قدرت</th>
                                    <th>تاریخ ایجاد</th>
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

                ajax: '{!! route('drug.dataTable') !!}',
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
                    {data: 'fa_name', name: 'fa_name'},
                    {data: 'en_name', name: 'en_name'},
                    {data: 'fa_brand', name: 'fa_brand'},
                    {data: 'en_brand', name: 'en_brand'},
                    {data: 'usage_way', name: 'usage_way'},
                    {data: 'shape', name: 'shape'},
                    {data: 'strength', name: 'strength'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'edit', name: 'edit'},
                ],


            });

        });
    </script>


@endpush
