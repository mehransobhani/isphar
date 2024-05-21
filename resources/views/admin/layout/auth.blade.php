<!DOCTYPE html>
<html lang="fa">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("admin-assets/images/favicon.png") }}">
  <title>@yield('title')</title>
  <link href="{{ asset("admin-assets/plugins/bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet">
  <link href="{{ asset("admin-assets/plugins/bootstrap-extension/css/bootstrap-extension.css") }}" rel="stylesheet">
  <link href="{{ asset("admin-assets/plugins/sidebar-nav/dist/sidebar-nav.min.css") }}" rel="stylesheet">
  <link href="{{ asset("admin-assets/plugins/animate/animate.css") }}" rel="stylesheet">
  <link href="{{ asset("admin-assets/plugins/datatables/jquery.dataTables.min.css") }}" rel="stylesheet">
  <link href="{{ asset("admin-assets/plugins/datatables/buttons/buttons.dataTables.min.css") }}" rel="stylesheet">
  <link href="{{ asset("admin-assets/css/colors/default.css") }}" id="theme" rel="stylesheet">
  <link href="{{ asset("admin-assets/plugins/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet">
  <link href="{{ asset("admin-assets/plugins/material-design-iconic-font/css/material-design-iconic-font.css") }}" rel="stylesheet">
  <link href="{{ asset("admin-assets/css/style.css") }}" rel="stylesheet">
  <link href="{{ asset("admin-assets/plugins/switchery/dist/switchery.min.css") }}" rel="stylesheet">
  <link href="{{ asset("admin-assets/plugins/custom-select/custom-select.css") }}" rel="stylesheet">
  <link href="{{ asset("admin-assets/css/datePicker.css") }}" rel="stylesheet">

    @stack('styles')
</head>

<body class="fix-header fix-sidebar">
<!-- Preloader -->
<div class="preloader">
  <svg class="circular" viewbox="25 25 50 50">
    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
  </svg>
</div>
<div id="wrapper">
   <!-- Page Content -->
  @yield('content')
  <!-- /#page-wrapper -->
{{--  <footer class="footer text-center">isphar</footer>--}}
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="{{ asset("admin-assets/plugins/jquery/dist/jquery.min.js") }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset("admin-assets/plugins/bootstrap/dist/js/tether.min.js") }}"></script>
<script src="{{ asset("admin-assets/plugins/bootstrap/dist/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("admin-assets/plugins/bootstrap-extension/js/bootstrap-extension.min.js") }}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{ asset("admin-assets/plugins/sidebar-nav/dist/sidebar-nav.min.js") }}"></script>

<script src="{{ asset("admin-assets/js/persian-date.js") }}"></script>
<script src="{{ asset("admin-assets/js/persian-datepicker.js") }}"></script>
<!--slimscroll JavaScript -->
<script src="{{ asset("admin-assets/plugins/jquery.slimscroll/jquery.slimscroll.min.js") }}"></script>
<!--Wave Effects -->
<script src="{{ asset("admin-assets/plugins/waves/waves.min.js") }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset("admin-assets/js/custom.js") }}"></script>
<script src="{{ asset("admin-assets/js/dataTable.js") }}"></script>
<!--Style Switcher -->
<script src="{{ asset("admin-assets/js/style-switcher.js") }}"></script>

<!-- Data Table JavaScript -->
<script src="{{ asset("admin-assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
{{--<script src="{{ asset("admin-assets/plugins/datatables/dataTables.bootstrap.js") }}"></script>--}}
<script src="{{ asset("admin-assets/plugins/datatables/buttons/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("admin-assets/plugins/datatables/buttons/buttons.flash.min.js") }}"></script>
<script src="{{ asset("admin-assets/plugins/datatables/buttons/buttons.html5.min.js") }}"></script>
<script src="{{ asset("admin-assets/plugins/datatables/buttons/buttons.print.min.js") }}"></script>

<script src="{{  asset("admin-assets/js/style-switcher.js")  }}"></script>
<script src="{{  asset("admin-assets/plugins/switchery/dist/switchery.min.js")  }}"></script>

<script src="{{  asset("admin-assets/plugins/custom-select/custom-select.min.js")  }}"></script>



<script>
$(document).ready(function () {
        var isNavbarOpen = false;
        $('.open-close').click(function () {
            isNavbarOpen = !isNavbarOpen;

            if (isNavbarOpen) {
                $('#collapsed-logo').hide();
                $('#expanded-logo').show();
            } else {
                $('#expanded-logo').hide();
                $('#collapsed-logo').show();
            }
        });
    });
</script>
     <script>
        jQuery(document).ready(function() {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function () {
                new Switchery($(this)[0], $(this).data());

            });

            $(".select2").select2();

        });
    </script>

@stack('scripts')
</body>

</html>
