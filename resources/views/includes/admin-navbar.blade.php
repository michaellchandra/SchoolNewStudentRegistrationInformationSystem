<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow p-5">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav">
        {{-- <img class="img-profile rounded-circle" src="storage/undraw_profile_1.svg"> --}}
        <li class="nav-item">

            <label class="nav-item m-0 text-s">Welcome,</label>
            <div class="nav-item fw-bold">SMA Zion Makassar</div>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">


        <!-- Authentication Links -->
        @guest
            @if (Route::has('login'))
                <li class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown bg-light rounded">

                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">

                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                        {{ Auth::user()->name }} </span>


                    <img class="img-profile rounded-circle" src="storage/undraw_profile_1.svg">
                </a>


                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in w-100"
                    aria-labelledby="navbarDropdown">

                    <a class="nav-link dropdown-item d-flex align-items-center " href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="row d-flex align-items-center">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small w-100">
                                {{ Auth::user()->name }}
                            </span>
                            <p>Admin</p>
                        </div>



                        <img class="img-profile rounded-circle" src="storage/undraw_profile_1.svg">
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                    <div class="dropdown-divider"></div>

                    


                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="create" class="dropdown-item">
                        <div class="row d-flex align-items-center">
                            <p class="text-primary fw-bold">+ Tambah Admin</p>
                            <p class="mr-2 d-none d-lg-inline text-gray-600 small w-100">You can add maximum 5 admin</p>
                        </div>

                    </a>
                </div>
            </li>
        @endguest



        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">


    </ul>

</nav>
<!-- End of Topbar -->
