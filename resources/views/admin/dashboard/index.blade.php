@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <div class="dashboard-container">
        <div class="welcome-section">
            <div class="welcome-content">
                <h1 class="welcome-title">Selamat Datang, <span id="adminName">Admin</span>!</h1>
                <p class="welcome-subtitle">Berikut adalah ringkasan aktivitas dan statistik sekolah hari ini.</p>
            </div>
            <div class="welcome-actions">
                <div class="date-display">
                    <i class="fas fa-calendar-alt"></i>
                    <span id="currentDate">{{ now()->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
        </div>

        <div class="stats-overview">
            <div class="stat-card primary">
                <div class="stat-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $totalJurusan }}</h3>
                    <p class="stat-label">Total Jurusan</p>
                    <div class="stat-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>Program Keahlian</span>
                    </div>
                </div>
            </div>

            <div class="stat-card success">
                <div class="stat-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $totalPengajar }}</h3>
                    <p class="stat-label">Tenaga Pendidik</p>
                    <div class="stat-trend positive">
                        <i class="fas fa-users"></i>
                        <span>Guru & Staff</span>
                    </div>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-icon">
                    <i class="fas fa-school"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $totalFasilitas }}</h3>
                    <p class="stat-label">Fasilitas</p>
                    <div class="stat-trend positive">
                        <i class="fas fa-building"></i>
                        <span>Sarana Prasarana</span>
                    </div>
                </div>
            </div>

            <div class="stat-card info">
                <div class="stat-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $totalPrestasi }}</h3>
                    <p class="stat-label">Prestasi</p>
                    <div class="stat-trend positive">
                        <i class="fas fa-medal"></i>
                        <span>Penghargaan</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-column wide">
                <div class="chart-section">
                    <div class="section-header">
                        <div class="section-title">
                            <i class="fas fa-chart-bar"></i>
                            <h3>Statistik Prestasi per Tahun</h3>
                        </div>
                        <div class="section-actions">
                            <div class="chart-controls">
                                <button class="chart-btn active" data-type="bar">
                                    <i class="fas fa-chart-bar"></i>
                                    Bar
                                </button>
                                <button class="chart-btn" data-type="line">
                                    <i class="fas fa-chart-line"></i>
                                    Line
                                </button>
                            </div>
                            <button class="btn-refresh" onclick="refreshChart()">
                                <i class="fas fa-sync-alt"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="prestasiChart"></canvas>
                    </div>
                    <div class="chart-stats">
                        <div class="chart-stat-item">
                            <span class="stat-label">Total Prestasi</span>
                            <span class="stat-value-total" id="totalPrestasi">0</span>
                        </div>
                        <div class="chart-stat-item">
                            <span class="stat-label">Rata-rata/Tahun</span>
                            <span class="stat-value-avg" id="avgPrestasi">0</span>
                        </div>
                        <div class="chart-stat-item">
                            <span class="stat-label">Tertinggi</span>
                            <span class="stat-value-max" id="maxPrestasi">0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-column narrow">
                <div class="quick-actions">
                    <div class="section-header">
                        <div class="section-title">
                            <i class="fas fa-bolt"></i>
                            <h3>Quick Actions</h3>
                        </div>
                    </div>
                    <div class="actions-grid">
                        <a href="{{ route('admin.manajemen-pengumuman.index') }}" class="action-btn primary">
                            <div class="action-icon">
                                <i class="fas fa-plus"></i>
                            </div>
                            <span>Tambah Pengumuman</span>
                        </a>
                        
                        <a href="{{ route('admin.manajemen-gallery.index') }}" class="action-btn success">
                            <div class="action-icon">
                                <i class="fas fa-upload"></i>
                            </div>
                            <span>Upload Gallery</span>
                        </a>
                        
                        <a href="{{ route('admin.manajemen-prestasi.store') }}" class="action-btn warning">
                            <div class="action-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <span>Tambah Prestasi</span>
                        </a>
                        
                        <a href="{{ route('admin.manajemen-struktur.index') }}" class="action-btn info">
                            <div class="action-icon">
                                <i class="fas fa-sitemap"></i>
                            </div>
                            <span>Update Struktur</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let prestasiChart;
        let currentChartType = 'bar';

        document.addEventListener('DOMContentLoaded', function() {
            initializeChart();
            updateLiveTime();
            setupChartControls();
        });

        function initializeChart() {
            const ctx = document.getElementById('prestasiChart').getContext('2d');
            
            const labels = @json($prestasiPerTahun->pluck('tahun_prestasi'));
            const data = @json($prestasiPerTahun->pluck('total'));

            // Calculate statistics
            const total = data.reduce((sum, value) => sum + value, 0);
            const average = (total / data.length).toFixed(1);
            const max = Math.max(...data);

            // Update statistics display
            document.getElementById('totalPrestasi').textContent = total;
            document.getElementById('avgPrestasi').textContent = average;
            document.getElementById('maxPrestasi').textContent = max;

            // Gradient function
            function createGradient(ctx, color1, color2) {
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, color1);
                gradient.addColorStop(1, color2);
                return gradient;
            }

            const chartData = {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Prestasi',
                    data: data,
                    backgroundColor: createGradient(ctx, 'rgba(0, 102, 204, 0.8)', 'rgba(0, 102, 204, 0.2)'),
                    borderColor: 'rgba(0, 102, 204, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                    barPercentage: 0.7,
                    categoryPercentage: 0.8,
                    hoverBackgroundColor: 'rgba(0, 102, 204, 0.9)',
                    hoverBorderColor: 'rgba(0, 102, 204, 1)',
                    hoverBorderWidth: 3
                }]
            };

            const commonOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.85)',
                        titleFont: {
                            family: 'Inter, sans-serif',
                            size: 12,
                            weight: '600'
                        },
                        bodyFont: {
                            family: 'Inter, sans-serif',
                            size: 11
                        },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return `Prestasi: ${context.parsed.y}`;
                            },
                            title: function(context) {
                                return `Tahun ${context[0].label}`;
                            }
                        }
                    },
                    datalabels: {
                        display: true,
                        color: '#1a1a2e',
                        font: {
                            family: 'Inter, sans-serif',
                            size: 11,
                            weight: '600'
                        },
                        anchor: 'end',
                        align: 'top',
                        formatter: function(value) {
                            return value;
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                family: 'Inter, sans-serif',
                                size: 11
                            },
                            padding: 10,
                            color: '#6c757d'
                        },
                        border: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Inter, sans-serif',
                                size: 11,
                                weight: '500'
                            },
                            padding: 10,
                            color: '#6c757d'
                        },
                        border: {
                            display: false
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                },
                elements: {
                    bar: {
                        borderRadius: 8
                    }
                }
            };

            const barOptions = {
                ...commonOptions,
                plugins: {
                    ...commonOptions.plugins,
                    datalabels: {
                        ...commonOptions.plugins.datalabels,
                        display: true
                    }
                }
            };

            const lineOptions = {
                ...commonOptions,
                plugins: {
                    ...commonOptions.plugins,
                    datalabels: {
                        display: false
                    }
                },
                elements: {
                    line: {
                        tension: 0.4,
                        fill: true
                    },
                    point: {
                        radius: 6,
                        hoverRadius: 8,
                        backgroundColor: 'rgba(0, 102, 204, 1)',
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }
                }
            };

            prestasiChart = new Chart(ctx, {
                type: currentChartType,
                data: chartData,
                options: currentChartType === 'bar' ? barOptions : lineOptions
            });
        }

        function setupChartControls() {
            const chartButtons = document.querySelectorAll('.chart-btn');
            
            chartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const chartType = this.dataset.type;
                    
                    // Update active button
                    chartButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update chart type
                    currentChartType = chartType;
                    prestasiChart.destroy();
                    initializeChart();
                });
            });
        }

        function refreshChart() {
            const btn = event.target.closest('.btn-refresh');
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            btn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                prestasiChart.destroy();
                initializeChart();
                
                btn.innerHTML = originalHtml;
                btn.disabled = false;
                
                // Show success notification
                Swal.fire({
                    icon: 'success',
                    title: 'Data Diperbarui',
                    text: 'Chart berhasil diperbarui',
                    timer: 1500,
                    showConfirmButton: false
                });
            }, 1000);
        }

        function updateLiveTime() {
            const dateElement = document.getElementById('currentDate');
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            dateElement.textContent = now.toLocaleDateString('id-ID', options);
        }

        setInterval(updateLiveTime, 60000);
    </script>
@endsection