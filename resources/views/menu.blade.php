<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->username }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Menú</li>
            <!-- Optionally, you can add icons to the links -->
            @if(Auth::user()->can('view-users') || Auth::user()->can('view-roles') || Auth::user()->can('view-permissions'))
            <li class="treeview {{ Request::is('users') || Request::is('users/*') || Request::is('role')
            || Request::is('permission') || Request::is('role/*') || Request::is('permission/*') ? 'active' : ''}}">
                <a href=""><i class="fa fa-link"></i> <span>Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(Auth::user()->can('view-users'))
                    <li class="{{ Request::is('users') ? 'active' : ''}}"><a href="{{ url('users') }}">
                            <i class="fa fa-circle-o"></i>Lista de Usuarios</a></li>
                    @endif
                    @if(Auth::user()->can('view-roles'))
                    <li class="{{ Request::is('role') ? 'active' : ''}}"><a href="{{ url('role') }}">
                            <i class="fa fa-circle-o"></i>Roles</a></li>
                    @endif
                    @if(Auth::user()->can('view-permissions'))
                    <li class="{{ Request::is('permission') ? 'active' : ''}}"><a href="{{ url('permission') }}">
                            <i class="fa fa-circle-o"></i>Permisos</a></li>
                    @endif
                </ul>
            </li>
            @endif
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>