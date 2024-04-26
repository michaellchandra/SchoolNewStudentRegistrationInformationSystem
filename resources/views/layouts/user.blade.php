<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Informasi Pendaftaran Siswa Baru') }}</title>

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @include('includes.style')

    @stack('scripts')
    
</head>

<body>

     <div id="wrapper">

        @include('includes.user-sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="flex-grow-1">

                @include('includes.user-navbar')

                @yield('content')
               
                
            </div>
            <!-- End of Main Content -->
            @include('includes.footer')
           

        </div>
        <!-- End of Content Wrapper -->
        
    </div>

    
    <!-- End of Page Wrapper -->
    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    @include('includes.script')
    


</body>

</html>
