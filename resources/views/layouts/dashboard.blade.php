<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <title>@yield('titulo') - GPS Rutas</title>

    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/menu.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/jquery.timepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/bootstrap-datepicker3.standalone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert2.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/toastr/toastr.css')}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{asset('assets/js/modernizr.min.js')}}"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" type="text/css" />



</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="index.html" class="logo">
                {{--<img style="padding: 10px" src="http://idi.unisinucartagena.edu.co:8000/cuenta-facil/public/images/LogoUnisinu.png" alt="" class="img-responsive">--}}
            </a>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">

                <!-- Page title -->
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <button class="button-menu-mobile open-left">
                            <i class="zmdi zmdi-menu"></i>
                        </button>
                    </li>
                    <li>
                        <h4 class="page-title">Dashboard</h4>
                    </li>
                </ul>
            </div><!-- end container -->
        </div><!-- end navbar -->
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">

            <!-- User -->
            <div class="user-box">
                <div class="user-img">
                    <img src="https://cdn0.iconfinder.com/data/icons/superuser-web-kit/512/686909-user_people_man_human_head_person-512.png" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">
                    <div class="user-status online"><i class="zmdi zmdi-dot-circle"></i></div>
                </div>
                <h5><a href="#">{{Auth::user()->name}}</a> </h5>
                <ul class="list-inline">
                    <li>
                        <a href="#" >
                            <i class="zmdi zmdi-settings"></i>
                        </a>
                    </li>

                    <li>
                        <a href="{{url('logout')}}" class="text-custom">
                            <i class="zmdi zmdi-power"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End User -->

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                @role('admin|super-admin')
                    @include('menu.admin')
                @endrole

                @role('user')
                    @include('menu.user')
                @endrole

                @role('conductor')
                @include('menu.conductor')
                @endrole

                @role('familiar')
                @include('menu.familiar')
                @endrole


                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>

    </div>
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                @yield('content')
            </div> <!-- container -->
        </div> <!-- content -->
        <footer class="footer text-right">
            Universidad del SINU
        </footer>

    </div>

    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

    @yield('modals')

</div>
<!-- END wrapper -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/detect.js')}}"></script>
<script src="{{asset('assets/js/fastclick.js')}}"></script>
<script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('assets/js/waves.js')}}"></script>
<script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>

<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript" src="{{asset('assets/plugins/jquery-knob/excanvas.js')}}"></script>
<![endif]-->
<script src="{{asset('assets/plugins/jquery-knob/jquery.knob.js')}}"></script>

<!--Chart.js-->
<script src="{{asset('assets/plugins/chart.js/dist/Chart.js')}}"></script>

<!-- Datatable -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>

<!-- App js -->
<script src="{{asset('assets/js/jquery.core.js')}}"></script>
<script src="{{asset('assets/js/jquery.app.js')}}"></script>
<script src="{{asset('assets/js/underscore.js')}}"></script>

<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert2.js')}}"></script>
<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/js/validator.js')}}"></script>

<script src="{{asset('assets/js/sha3.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.formdata.js')}}"></script>

<script src="{{asset('assets/js/moment-with-locales.js')}}"></script>
<script src="{{asset('assets/js/livestamp.js')}}"></script>

<script src="{{asset('assets/js/jquery.timepicker.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-datepicker.es.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>



{{--<script src="//maps.googleapis.com/maps/api/js?libraries=drawing%2Cplaces&#038;key=AIzaSyDo0coYsmPFssj1tiYZLIY7yQur-e8aVIs&#038;ver=3">--}}
{{--</script>--}}

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo0coYsmPFssj1tiYZLIY7yQur-e8aVIs">
</script>

@stack('script')

<script src="{{asset('assets/js/arduino.js')}}"></script>


</body>
</html>