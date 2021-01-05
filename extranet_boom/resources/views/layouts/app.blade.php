<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Antares Agencia Interactiva') }}</title>
        <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <!-- Toastr style -->
        <link href="{{ url('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
        <!-- Gritter -->
        <link href="{{ url('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

        @yield('css')

        <link href="{{ url('css/animate.css') }}" rel="stylesheet">
        <link href="{{ url('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <span>
                                <?php
                                  $folder = (Session::get('avatar') != '') ? url('uploads') : url('img');
                                  $avatar = (Session::get('avatar') != '') ? Session::get('avatar') : 'profile.gif';
                                ?>
                                <img alt="image" class="img-circle img-responsive" src="{{ $folder }}/{{ $avatar }}" width="48" height="48" />
                                </span>
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Session::get('name') }}</strong>
                                </span> <span class="text-muted text-xs block">
                                  @if (Session::get('kind') == 2)
                                  Consultor
                                  @endif
                                  @if (Session::get('kind') == 3)
                                  Administraci&oacute;n
                                  @endif
                                  @if (Session::get('kind') == 4)
                                  Administrador
                                  @endif
                                </span> </span>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a href="{{ url('/logout') }}">Salir</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                BD
                            </div>
                        </li>
                        @if (Session::get('kind') == 4)
                        <li @if($module == 'admin') class="active" @endif>
                            <a href="index.html"><i class="fa fa-gears"></i> <span class="nav-label">Administrador</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li @if($module == 'admin' && $sub_module == 'user') class="active" @endif><a href="{{ url('admin/usuarios') }}">Usuarios</a></li>
                                <li @if($module == 'admin' && $sub_module == 'client') class="active" @endif><a href="{{ url('admin/clientes') }}">Clientes</a></li>
                                <li @if($module == 'admin' && $sub_module == 'brand') class="active" @endif><a href="{{ url('admin/marcas') }}">Marcas</a></li>
                                <li @if($module == 'admin' && $sub_module == 'contact') class="active" @endif><a href="{{ url('admin/contactos') }}">Contactos</a></li>
                                <li @if($module == 'admin' && $sub_module == 'vars') class="active" @endif><a href="{{ url('admin/variables') }}">Variables</a></li>
                            </ul>
                        </li>
                        @endif
                        <li @if($module == 'cotizacion') class="active" @endif>
                            <a href="{{ url('cotizaciones') }}"><i class="fa fa-file-o"></i> <span class="nav-label">Cotizaciones</span></a>
                        </li>
                        @if (Session::get('kind') == 3 || Session::get('kind') == 4)
                        <li @if($module == 'factura') class="active" @endif>
                            <a href="{{ url('facturas') }}"><i class="fa fa-dollar"></i> <span class="nav-label">Facturas</span></a>
                        </li>
                        @endif
                        @if (Session::get('kind') == 3 || Session::get('kind') == 4)
                        <li @if($module == 'notas') class="active" @endif>
                            <a href="{{ url('notas') }}"><i class="fa fa-file-text-o"></i> <span class="nav-label">Notas de Cr&eacute;dito</span></a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
            <div id="page-wrapper" class="gray-bg dashbard-1">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <span class="m-r-sm text-muted welcome-message">Caracas, {{ date('d') }} de {{ date('M') }} {{ date('Y') }}.</span>
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}">
                                <i class="fa fa-sign-out"></i> Salir
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                @yield('content-header')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            @yield('content')
                        </div>
                        <div class="footer">
                            <div class="pull-right">
                                Boom Digital {{ date('Y') }}
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mainly scripts -->
        <script src="{{ url('js/jquery-2.1.1.js') }}"></script>
        <script src="{{ url('js/bootstrap.min.js') }}"></script>
        <script src="{{ url('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
        <script src="{{ url('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
        <!-- Flot -->
        <script src="{{ url('js/plugins/flot/jquery.flot.js') }}"></script>
        <script src="{{ url('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
        <script src="{{ url('js/plugins/flot/jquery.flot.spline.js') }}"></script>
        <script src="{{ url('js/plugins/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ url('js/plugins/flot/jquery.flot.pie.js') }}"></script>
        <!-- Custom and plugin javascript -->
        <script src="{{ url('js/inspinia.js') }}"></script>
        <script src="{{ url('js/plugins/pace/pace.min.js') }}"></script>
        <!-- jQuery UI -->
        <script src="{{ url('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

        @yield('scripts')
    </body>
</html>
