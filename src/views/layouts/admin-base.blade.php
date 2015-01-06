{{--*/   
    $models = PaulVL\MagicAdmin\MagicController::getMagicModels();
    $title = trim(Config::get('packages/paulvl/magicadmin/config.title'));
    $title = (empty($title)) ? 'PaulVL - MagicAdmin v1.0.0' : $title;

    $navbar_brand = trim(Config::get('packages/paulvl/magicadmin/config.navbar_brand'));
    $navbar_brand = (empty($navbar_brand)) ? 'PaulVL - MagicAdmin v1.0.0' : $navbar_brand;

/*--}}
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{$title}}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('packages/paulvl/magicadmin/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('packages/paulvl/magicadmin/css/plugins/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{{ asset('packages/paulvl/magicadmin/css/plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('packages/paulvl/magicadmin/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('packages/paulvl/magicadmin/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('magic.index') }}">{{$navbar_brand}}</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{ route('magic.index') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        @foreach ($models as $model)
                            <li>
                                <a href="{{ route('magic.all', $model['model_name']) }}"><i class="fa {{ PaulVL\MagicAdmin\MagicIcon::getRandomIcon() }} fa-fw"></i> {{$model['friendly_name']}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" style="text-decoration:underline">
                            @section('title')
                                Welcome to <i class="fa fa-magic fa-fw"></i> MagicAdmin
                            @show
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        @yield('main-content')
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('packages/paulvl/magicadmin/js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('packages/paulvl/magicadmin/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('packages/paulvl/magicadmin/js/plugins/metisMenu/metisMenu.min.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{ asset('packages/paulvl/magicadmin/js/plugins/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('packages/paulvl/magicadmin/js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('packages/paulvl/magicadmin/js/sb-admin-2.js') }}"></script>


    <!-- DataTable default init -->
    @section('datatable')
        <script>
        $(document).ready(function() {
            $('#datatable').dataTable();
        });
        </script>
    @show

</body>

</html>
