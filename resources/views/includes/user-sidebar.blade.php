<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-3" href="">
        <div class="col align-items-center">
            {{-- @if ($school->schoolLogo)
                                        <img src="{{ asset('storage/schoolSettings/' . $school->schoolLogo) }}"
                                            alt="School Logo" class="img-fluid img-thumbnail">
                                            @endif --}}
            <div class="row text-xs fw-lighter">School Admission System</div>
        {{-- <div class="row text-s text-center fw-bold">{{ $school->schoolNama }}</div> --}}
        </div>
        
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="pengumuman">
            <i class="fas fa-solid fa-users"></i>
            <span>Pengumuman</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="payment">
            <i class="fas fa-solid fa-money-bill"></i>
            <span>Pembayaran</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>

