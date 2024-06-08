@php

    use App\Models\Admin;
    use App\Models\School;
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
    $school = School::first();

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
    <ul class="navbar-nav d-flex align-items-center">
        @if ($school && $school->schoolLogo)
            <img src="{{ asset('storage/schoolSettings/' . $school->schoolLogo) }}" alt="School Logo"
                class="img-fluid img-thumbnail p-2 me-2" style="width:75px; height:75px">
        @else
            <img src="{{ asset('storage/assets/graduation-cap-icon.svg') }}" alt="School Logo"
                class="img-fluid img-thumbnail p-2 me-2" style="width:75px; height:75px">
        @endif
        <li class="nav-item">

            <p class="nav-item pt-3 m-0 text-s text-black fw-bold">Selamat Datang di Sistem Pendaftaran Siswa Baru</p>
            <p class=""> @isset($school)
                    {{ $school->schoolNama }}
                @else
                @endisset
            </p>
            <p class="fst-italic text-xs">Admin Panel</p>
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
