@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Chart Pendaftar Harian -->
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between py-3 align-items-center">
                        <h5 class="m-0 fw-bold text-primary">Pendaftar Harian</h5>
                        {{-- <a href="/admin/pendaftar/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a> --}}
                    </div>
                    <div class="card-body">
                        <canvas id="dailyRegistrationsChart" width="400" height="300" ></canvas>
                    </div>
                </div>
            </div>
            <!-- Chart Pendaftar Mingguan -->
            <div class="col">
                <div class="">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between py-3 align-items-center">
                            <h5 class="m-0 fw-bold text-primary">Pendaftar Mingguan</h5>
                            {{-- <a href="/admin/pendaftar/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a> --}}
                        </div>
                        <div class="card-body">

                            <canvas id="weeklyRegistrationsChart" width="400" height="300"></canvas>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Chart Total Pendaftar Dalam Setiap Tahun Ajaran-->
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between py-3 align-items-center">
                        <h5 class="m-0 fw-bold text-primary">Total Pendaftar Setiap Tahun Ajaran</h5>
                        {{-- <a href="/admin/pendaftar/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a> --}}
                    </div>
                    <div class="card-body">

                        <canvas id="tahunAjaranChart" width="400" height="200"></canvas>

                    </div>

                </div>
                
            </div>
            
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between py-3 align-items-center">
                        <h5 class="m-0 fw-bold text-primary">Kota Sekolah Asal Pendaftar</h5>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a>
                    </div>
                    <div class="card-body">

                    
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kota Asal Sekolah</th>
                                <th>Jumlah Pendaftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kotaSekolahAsal as $kotaSekolah)
                            <tr>
                                <td>{{ $kotaSekolah->kotaSekolahAsal }}</td>
                                <td>{{ $kotaSekolah->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var dailyRegistrationsChart = document.getElementById('dailyRegistrationsChart').getContext('2d');
        var weeklyRegistrationsChart = document.getElementById('weeklyRegistrationsChart').getContext('2d');
        var tahunAjaranChart = document.getElementById('tahunAjaranChart').getContext('2d');
        // Fetch data for daily registrations
        fetch("{{ route('daily.registrations') }}")
            .then(response => response.json())
            .then(data => {
                var dailyChart = new Chart(dailyRegistrationsChart, {
                    type: 'bar',
                    data: {
                        labels: ['Today'],
                        datasets: [{
                            label: 'Pendaftar Hari Ini',
                            data: [data.registrations],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                min: 0,
                                ticks: {
                                    stepSize: 2, // Setiap langkahnya adalah 10
                                    precision: 0
                                    
                                }
                            }
                        }
                    }
                });
            });

        
            // Fetch data for weekly registrations
        fetch("{{ route('weekly.registrations') }}")
        .then(response => response.json())
        .then(data => {
            var weeklyChart = new Chart(weeklyRegistrationsChart, {
                type: 'bar',
                data: {
                    labels: data.labels, 
                    datasets: [{
                        label: 'Jumlah Pendaftar Mingguan',
                        data: data.data, // Jumlah pendaftaran untuk setiap hari
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            min: 0,
                        }
                    }
                }
            });
        });


        

    
    fetch("{{ route('academic.year') }}") 
    .then(response => response.json())
    .then(data => {
        var tahunAjaranChart = document.getElementById('tahunAjaranChart').getContext('2d');
        var yearlyChart = new Chart(tahunAjaranChart, {
            type: 'bar',
            data: {
                labels: data.map(entry => entry.academic_year), // Tahun ajaran
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: data.map(entry => entry.total_registrations),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                                ticks: {
                                    stepSize: 2,
                                    precision: 0
                                }
                    }
                }
            }
        });
    });
    </script>
@endsection
