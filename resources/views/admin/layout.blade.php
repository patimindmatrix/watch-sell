<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link href="{{ asset("admin/dist/css/styles.css") }}" rel="stylesheet" />
        <link href="{{ asset("admin/dist/css/core.css") }}" rel="stylesheet">
    </head>
    <body class="sb-nav-fixed">
        <!------ Top Navbar ------>
        @include("admin.partials.top_navbar")
        <div id="layoutSidenav">
            <!------ Left Navbar ------>
            @include("admin.partials.left_navbar")
            <!------ Main Content ------>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid mt-5">
                        @yield("content_main")
                    </div>
                </main>
                <!------ Footer Section ------>
                @include("admin.partials.footer")
            </div>
        </div>
        <!----- JQUERY 3.6.0 JS ----->
        <script src="{{ asset("admin/plugins/jquery/dist/jquery.min.js") }}" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <!----- BS4 4.5.3 JS ----->
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!----- FontAwesome JS ----->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <!----- SweetAlert2 ----->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!----- Select 2 ----->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!----- Ckeditor JS ----->
        <script src="{{ asset("admin/plugins/ckeditor/ckeditor.js") }}"></script>
        <script> CKEDITOR.replace('ckeditor',{
                language: 'en',
                uiColor: '#343a40',
            });
        </script>

        @stack('scripts')

        <script src="{{ asset("admin/dist/js/scripts.js") }}" type="text/javascript"></script>
    </body>
</html>
