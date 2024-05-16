@extends('admin.layout.main')

@section('title', 'داشبورد')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-4 col-md-6 col-12">
                    <h4 class="page-title">
                        <a href=" ">پیشخوان</a>
                        /
                        فاکتور های ریالی
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-10"> لیست بیماران </h3>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Nname</th>
                                    <th>edit</th>
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

                columns: [

                    { data: 'id', name: 'id' },

                    { data: 'fullname', name: 'fullname' },
                    { data: 'national_code', name: 'national_code' },
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
