@php

    use App\Models\Admin;
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();

    if ($user->role === 'admin') {
        $admin = Admin::where('user_id', $user->id)->first();
    }
@endphp


<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow p-5">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav">

        <li class="nav-item">

            <label class="nav-item m-0 text-s text-black fw-bold">Selamat Datang di Sistem Pendaftaran Siswa Baru</label>
            <p class="fst-italic">Admin Panel</p>
            </p>


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



                    @if (isset($admin))
                        <div class="col d-flex align-items-end flex-column">
                            <span class="mr-2 d-none d-sm-inline text-gray-600 small row">

                                {{ $admin->adminNama }} </span>
                            <span class="mr-2 d-none d-lg-inline small row align-items-end">{{ Auth::user()->role }}</span>

                        </div>



                        <img class="img-profile rounded-circle"
                            src="{{ asset('storage/AdminProfile/' . $admin->user_id . '/' . $admin->adminFoto) }}">
                    @endif
                </a>


                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in w-100"
                    aria-labelledby="navbarDropdown">

                    {{-- <a class="nav-link dropdown-item d-flex align-items-center " href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="row d-flex align-items-center">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small w-100">
                                {{ Auth::user()->name }}
                            </span>
                            <p>Admin</p>
                        </div>



                        <img class="img-profile rounded-circle" src="storage/undraw_profile_1.svg">
                    </a> --}}


                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>






                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </li>
        @endguest



        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">


    </ul>

</nav>
<!-- End of Topbar -->
