<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('kitchen.index') }}" class="brand-link">
        <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Waiter Dashboard</span>
    </a>

    <!-- Sidebar -->

        <!-- Sidebar user panel -->
        <div class="sidebar mt-0">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="{{asset('uploads/profile/avater.png')}}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                @auth
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        @endauth
              </div>
            </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('waiter.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>Orders <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('waiter.ordered') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Ordered</p>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('waiter.inprogress') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>In Progress </p>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('waiter.ready') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Ready for Delivery</p>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('waiter.completed') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Completed </p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{ route('waiter.tables') }}" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>Tables</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="dropdown-item nav-link bg-transparent" id="logout" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      <i class="far fa-circle nav-icon"></i>

                          {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>

                </a>
               </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    <!-- /.sidebar -->
</aside>
<!-- /.sidebar -->
