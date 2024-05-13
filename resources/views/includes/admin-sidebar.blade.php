@php
    use App\Models\School;
    $school = School::first();
@endphp
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-3 mb-5" href="#">
        <div class="col align-items-center">
            
            <div class="row text-xs fw-lighter mt-3">School Admission System</div>
            
        <div class="row text-s text-center fw-bold mb-3">
            @isset($school)
            {{ $school->schoolNama }}
        @else
        
        @endisset</div>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin/dashboard">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="/admin/pendaftar">
            <i class="fas fa-solid fa-users"></i>
            <span>Pendaftar</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="/admin/payment">
            <i class="fas fa-solid fa-money-bill"></i>
            <span>Pembayaran</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="/admin/survey">
            <i class="fas fa-solid fa-poll-h"></i>
            <span>Survey</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="/admin/analytic">
            <i class="fas fa-solid fa-chart-line"></i>
            <span>Analitik</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href=/admin/pengumuman>
            <i class="fas fa-solid fa-info"></i>
            <span>Pengumuman</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="/admin/settings">
            <i class="fas fa-solid fa-wrench"></i>
            <span>Pengaturan</span></a>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>

