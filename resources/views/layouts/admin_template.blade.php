<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>{{"EduPortal" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/bower_components/bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset("/bower_components/font-awesome/css/font-awesome.min.css")}}"  rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{ asset("/bower_components/ionicons/css/ionicons.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset("/bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/bower_components/select2/dist/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/select2-bootstrap-theme-0.1.0-beta.10/dist/select2-bootstrap.min.css")}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
    .select2-results__option[aria-selected=true] {
    display: none;
}
    </style>
</head>
<body class="skin-blue">
<div class="wrapper">

    <!-- Header -->
    @include('header')

    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ Request::segment(1) }}
                <!-- <small>{{ "page description" }}</small> -->
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <!-- <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol> -->
        </section>

        <main class="py-4">
        <!-- Main content -->
        <section class="content">
        <!-- Your Page Content Here -->
        
            @yield('content')
        
        </section><!-- /.content -->
        </main>
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('footer')


</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->

<script src="{{ asset ("/bower_components/jQuery/dist/jQuery.min.js") }}"></script>
<script src="{{ asset ("/bower_components/jQuery/dist/jQuery.min.js") }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ("/bower_components/bootstrap/dist/js/bootstrap.min.js") }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/admin-lte/dist/js/adminlte.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/bower_components/select2/dist/js/select2.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/bower_components/datatables.net/js/jquery.dataTables.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js") }}" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->
      <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
$(document).ready(function() {
    $('#subjectSelect').select2({
        theme: "bootstrap",
        placeholder: "Select Subject",
        minimumResultsForSearch: -1,
        allowClear: true
    });

    $('#lecturerSelect').select2({
        theme: "bootstrap",
        placeholder: "Select Lecturer",
        minimumResultsForSearch: -1,
        allowClear: true
    });

    $("select").on("select2:select", function (evt) {
    var element = evt.params.data.element;
    var $element = $(element);
    $element.detach();
    $(this).append($element);
    $(this).trigger("change");
});
});
</script>
<script>
$(document).ready(function() {
    $('#SelectCamera').select2({
        theme: "bootstrap",
        placeholder: "Select Camera"
    });
});

$(document).ready(function(){
    $('#roles').select2({
        theme: "bootstrap",
        placeholder: "Select Role"
    });
});

jQuery(document).ready(function ($) {
        $('select[name=subject_id]').on('change', function () {
            var selected = $(this).find(":selected").attr('value');
            var base_url = 'localhost:8000';
        	$.ajax({
                        url: base_url + '/staff/timetable/getlecturer/'+selected,
                        type: 'GET',
                        dataType: 'json',
 
                }).done(function (data) {
 
                	var select = $('select[name=lecturer_id]');
                	select.empty();
                	select.append('<option value="0" >Please Select Lecturer</option>');
                    $.each(data,function(key, value) {
                		select.append('<option value=' + key.id + '>' + value.name + '</option>');
            		});
                    console.log("success");
            })
        });
    });

</script>
</body>
</html>