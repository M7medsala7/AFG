<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="/AdminDashboard/assets/css/normalize.css">
    <link rel="stylesheet" href="/AdminDashboard/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/AdminDashboard/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/AdminDashboard/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/AdminDashboard/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="/AdminDashboard/assets/css/cs-skin-elastic.css">
     <link rel="stylesheet" href="/AdminDashboard/assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <!-- <link rel="stylesheet" href="/AdminDashboard/assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="/AdminDashboard/assets/scss/style.css">
    <link href="/AdminDashboard/assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/AdminDashboard/assets/css/lib/chosen/chosen.min.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


        <!-- LeftPanel -->

   @include('DashbordAdminPanel.layout.LeftPanel')

    <!-- Left Panel -->

    <!-- RightPanel -->
    <div id="right-panel" class="right-panel">

    @include('DashbordAdminPanel.layout.RightPanel')

    @yield('content')
</div>
    
    <!-- Right Panel -->

    <script src="/AdminDashboard/assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="/AdminDashboard/assets/js/plugins.js"></script>
    <script src="/AdminDashboard/assets/js/main.js"></script>
 <script src="/AdminDashboard/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="/AdminDashboard/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="/AdminDashboard/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="/AdminDashboard/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="/AdminDashboard/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="/AdminDashboard/assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="/AdminDashboard/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="/AdminDashboard/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="/AdminDashboard/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="/AdminDashboard/assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="/AdminDashboard/assets/js/lib/data-table/datatables-init.js"></script>

    <script src="/AdminDashboard/assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="/AdminDashboard/assets/js/dashboard.js"></script>
    <script src="/AdminDashboard/assets/js/widgets.js"></script>
    <script src="/AdminDashboard/assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="/AdminDashboard/assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="/AdminDashboard/assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="/AdminDashboard/assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
     <script src="/AdminDashboard/assets/js/lib/chosen/chosen.jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>

      <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });

            $('.standardSelect').trigger("chosen:updated");

        });
    </script>
 
</body>

@yield('scripts')
</html>
