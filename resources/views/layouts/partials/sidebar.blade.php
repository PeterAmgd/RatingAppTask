<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                <li class="nav-item has-treeview">
                    <a href="{{route('rate-users')}}" class="nav-link {{ activeSegment('Rate Client') }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>{{ __('Rate Client') }}</p>
                    </a>
                </li>
                
                <li class="nav-item has-treeview">
                    <a href="{{route('rate-clients')}}" class="nav-link {{ activeSegment('Rate User') }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>{{ __('Rate User') }}</p>
                    </a>
                </li>


                @if (auth()->user())
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>{{ __('common.Logout') }}</p>
                        <form action="{{route('logout')}}" method="POST" id="logout-form">
                            @csrf
                        </form>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
