@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Analitik Dashboard</h1>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary active" data-filter="week">Minggu Ini</button>
                <button type="button" class="btn btn-outline-primary" data-filter="month">Bulan Ini</button>
                <button type="button" class="btn btn-outline-primary" data-filter="year">Tahun Ini</button>
            </div>
        </div>

        <!-- Statistics Cards Row -->
        {{-- <div class="row">
            <!-- Total Users Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-users">
                                    {{ $analytics['total_users'] ?? 0 }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Users Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Active Users (Period)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="active-users">
                                    {{ $analytics['active_users'] ?? 0 }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Registrations Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    New Registrations</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="new-registrations">
                                    {{ $analytics['new_registrations'] ?? 0 }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tour Guide Bookings Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Tour Guide Bookings</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="tour-bookings">
                                    {{ $analytics['tour_bookings'] ?? 0 }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-map-marked-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Charts Row -->
        <div class="row">
            <!-- User Activity Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Ringkasan Aktivitas Pengguna</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="userActivityChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Types Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Distribusi Pengguna</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="userTypesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Analytics Row -->
        <div class="row">
            <!-- Monthly Registration Trends -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tren Pendaftaran Bulanan</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="monthlyRegistrationChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Facilities Usage -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Fasilitas Terpopuler</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="facilitiesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Facilities Details Row -->
        <div class="row">
            <!-- Most Used Facilities -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Fasilitas yang Paling Sering Digunakan</h6>
                    </div>
                    <div class="card-body">
                        @if (isset($analytics['most_used_facilities']) && count($analytics['most_used_facilities']) > 0)
                            @foreach ($analytics['most_used_facilities'] as $facility)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="mr-3">
                                        @if ($facility->foto)
                                            <img src="{{ asset('storage/' . $facility->foto) }}"
                                                alt="{{ $facility->nama_fasilitas }}" class="rounded-circle"
                                                style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                <i class="fas fa-building text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="font-weight-bold">{{ $facility->nama_fasilitas }}</div>
                                        <div class="text-muted small">{{ $facility->lokasi }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-weight-bold text-primary">{{ $facility->usage_count }}</div>
                                        <div class="text-muted small">seringkali digunakan</div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">Belum ada data penggunaan fasilitas.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recently Used Facilities -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Fasilitas yang Baru Digunakan</h6>
                    </div>
                    <div class="card-body">
                        @if (isset($analytics['recently_used_facilities']) && count($analytics['recently_used_facilities']) > 0)
                            @foreach ($analytics['recently_used_facilities'] as $facility)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="mr-3">
                                        @if ($facility->foto)
                                            <img src="{{ asset('storage/' . $facility->foto) }}"
                                                alt="{{ $facility->nama_fasilitas }}" class="rounded-circle"
                                                style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                <i class="fas fa-clock text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="font-weight-bold">{{ $facility->nama_fasilitas }}</div>
                                        <div class="text-muted small">{{ $facility->lokasi }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-weight-bold text-success">
                                            {{ $facility->last_used_at ? $facility->last_used_at->diffForHumans() : 'Never' }}
                                        </div>
                                        <div class="text-muted small">terakhir digunakan</div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">Belum ada data penggunaan terbaru.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Table -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Aktivitas Pengguna Terbaru</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                       <th>Nama Pengguna</th>
                                        <th>Aktivitas</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentActivities ?? [] as $activity)
                                        <tr>
                                            <td>{{ $activity->user->name ?? 'Tidak Dikenal' }}</td>
                                            <td>{{ $activity->activity_type ?? 'Login' }}</td>
                                            <td>{{ $activity->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $activity->status == 'success' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($activity->status ?? 'active') }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary">Lihat Detail</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada aktivitas terbaru.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Chart configurations
        const chartColors = {
            primary: '#4e73df',
            success: '#1cc88a',
            info: '#36b9cc',
            warning: '#f6c23e',
            danger: '#e74a3b',
            secondary: '#858796'
        };

        // User Activity Line Chart
        const userActivityCtx = document.getElementById('userActivityChart').getContext('2d');
        const userActivityChart = new Chart(userActivityCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($analytics['activity_labels'] ?? []) !!},
                datasets: [{
                    label: 'Daily Active Users',
                    data: {!! json_encode($analytics['activity_data'] ?? []) !!},
                    borderColor: chartColors.primary,
                    backgroundColor: chartColors.primary + '20',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // User Types Pie Chart
        const userTypesCtx = document.getElementById('userTypesChart').getContext('2d');
        const userTypesChart = new Chart(userTypesCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($analytics['user_types_labels'] ?? ['Regular Users', 'Tour Guides', 'Admins']) !!},
                datasets: [{
                    data: {!! json_encode($analytics['user_types_data'] ?? [80, 15, 5]) !!},
                    backgroundColor: [chartColors.primary, chartColors.success, chartColors.warning],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Monthly Registration Bar Chart
        const monthlyRegCtx = document.getElementById('monthlyRegistrationChart').getContext('2d');
        const monthlyRegistrationChart = new Chart(monthlyRegCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($analytics['monthly_labels'] ?? []) !!},
                datasets: [{
                    label: 'New Registrations',
                    data: {!! json_encode($analytics['monthly_data'] ?? []) !!},
                    backgroundColor: chartColors.info,
                    borderColor: chartColors.info,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Facilities Usage Chart
        const facilitiesCtx = document.getElementById('facilitiesChart').getContext('2d');
        const facilitiesChart = new Chart(facilitiesCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($analytics['facilities_labels'] ?? []) !!},
                datasets: [{
                    label: 'Usage Count',
                    data: {!! json_encode($analytics['facilities_data'] ?? []) !!},
                    backgroundColor: [
                        chartColors.success,
                        chartColors.primary,
                        chartColors.warning,
                        chartColors.info,
                        chartColors.danger
                    ],
                    borderColor: [
                        chartColors.success,
                        chartColors.primary,
                        chartColors.warning,
                        chartColors.info,
                        chartColors.danger
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Filter functionality
        document.querySelectorAll('[data-filter]').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('[data-filter]').forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');

                // Get filter value
                const filter = this.getAttribute('data-filter');

                // Show loading state
                showLoadingState();

                // Make AJAX request to update data
                fetch(`{{ route('admin.dashboard') }}?filter=${filter}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update statistics cards
                        document.getElementById('total-users').textContent = data.total_users;
                        document.getElementById('active-users').textContent = data.active_users;
                        document.getElementById('new-registrations').textContent = data
                            .new_registrations;
                        document.getElementById('tour-bookings').textContent = data.tour_bookings;

                        // Update charts
                        updateCharts(data);

                        // Hide loading state
                        hideLoadingState();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        hideLoadingState();

                        // Show error message
                        alert('Failed to update dashboard data. Please try again.');
                    });
            });
        });

        function updateCharts(data) {
            // Update User Activity Chart
            userActivityChart.data.labels = data.activity_labels;
            userActivityChart.data.datasets[0].data = data.activity_data;
            userActivityChart.update();

            // Update User Types Chart
            userTypesChart.data.datasets[0].data = data.user_types_data;
            userTypesChart.update();

            // Update Monthly Registration Chart
            monthlyRegistrationChart.data.labels = data.monthly_labels;
            monthlyRegistrationChart.data.datasets[0].data = data.monthly_data;
            monthlyRegistrationChart.update();

            // Update Facilities Chart
            facilitiesChart.data.labels = data.facilities_labels;
            facilitiesChart.data.datasets[0].data = data.facilities_data;
            facilitiesChart.update();
        }

        function showLoadingState() {
            // Add loading overlay or spinner
            const loadingOverlay = document.createElement('div');
            loadingOverlay.id = 'loading-overlay';
            loadingOverlay.innerHTML = `
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            `;
            loadingOverlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(255, 255, 255, 0.8);
                z-index: 9999;
            `;
            document.body.appendChild(loadingOverlay);
        }

        function hideLoadingState() {
            const loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.remove();
            }
        }

        // Auto-refresh dashboard every 5 minutes
        setInterval(function() {
            const activeFilter = document.querySelector('[data-filter].active');
            if (activeFilter) {
                activeFilter.click();
            }
        }, 300000); // 5 minutes

        // Initialize tooltips
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
