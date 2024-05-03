@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between py-3 align-items-center">
                        <h5 class="m-0 fw-bold text-primary">Pendaftar Harian</h5>
                        {{-- <a href="/admin/pendaftar/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a> --}}
                    </div>
                    <div class="card-body">
                        <canvas id="dailyRegistrationsChart" width="400" height="400" ></canvas>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between py-3 align-items-center">
                            <h5 class="m-0 fw-bold text-primary">Pendaftar Mingguan</h5>
                            {{-- <a href="/admin/pendaftar/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a> --}}
                        </div>
                        <div class="card-body">

                            <canvas id="weeklyRegistrationsChart" width="400" height="400"></canvas>

                        </div>

                    </div>
                </div>

            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var dailyRegistrationsChart = document.getElementById('dailyRegistrationsChart').getContext('2d');
        var weeklyRegistrationsChart = document.getElementById('weeklyRegistrationsChart').getContext('2d');

        // Fetch data for daily registrations
        fetch("{{ route('daily.registrations') }}")
            .then(response => response.json())
            .then(data => {
                var dailyChart = new Chart(dailyRegistrationsChart, {
                    type: 'bar',
                    data: {
                        labels: ['Today'],
                        datasets: [{
                            label: 'Daily Registrations',
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
                                ticks: {
                                    stepSize: 10, // Setiap langkahnya adalah 10
                                    min: 0,
                                    max: 50
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
                    labels: data.labels, // Nama hari
                    datasets: [{
                        label: 'Weekly Registrations',
                        data: data.data, // Jumlah pendaftaran untuk setiap hari
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
