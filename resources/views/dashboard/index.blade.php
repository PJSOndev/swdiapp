<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container">
            <h4 class="mb-4">Dashboard Summary</h4>
            <div class="container mt-4">
                <div class="text-center fw-bold">
                    <h1>Total Beneficiaries: {{ number_format($grandTotal) }}</h1>
                </div>
            </div>
            <hr>
            <div class="row">
                @foreach($totals as $region => $count)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow border-primary" data-bs-toggle="modal" data-bs-target="#modal-{{ Str::slug($region) }}" style="cursor:pointer;">

                        <div class="card-body text-center">
                            @php
                            $icon = strtolower(str_replace(' ', '_', $region)) . '.png';
                            @endphp
                            <img src="{{ asset('assets/img/' . $icon) }}" alt="{{ $region }}" style="height: 100px;" class="mb-3">
                            <h5 class="card-title">{{ $region }}</h5>
                            <p><strong>Total Beneficiaries:</strong> {{ number_format($count) }}</p>
                            <p><strong>Updated:</strong> {{ number_format($updated[$region]) }}</p>
                            <hr>
                            <div class="mb-3">
    <h6 class="fw-bold text-dark">Level of Well-being</h6>

    @php
        $levelOrder = ['LEVEL 3', 'LEVEL 2', 'LEVEL 1'];
    @endphp

    @if (!empty($levels[$region]))
        <div class="table-responsive ps-3">
            <table class="table table-sm table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50%">Level</th>
                        <th style="width: 50%">Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($levelOrder as $orderedLevel)
                        @php
                            $count = $levels[$region][$orderedLevel] ?? null;
                            $badgeClass = match ($orderedLevel) {
                                'LEVEL 1' => 'bg-gradient-danger',
                                'LEVEL 2' => 'bg-gradient-warning',
                                'LEVEL 3' => 'bg-gradient-success',
                                default => 'bg-gradient-secondary',
                            };
                        @endphp

                        @if (!is_null($count))
                            <tr>
                                <td>
                                    <span class="badge {{ $badgeClass }} text-white">
                                        {{ ucwords(strtolower($orderedLevel)) }}
                                    </span>
                                </td>
                                <td class="fw-semibold text-dark">
                                    {{ number_format($count) }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-muted ps-3">No level data</p>
    @endif
</div>


                        </div>
                    </div>
                </div>

                <!-- Modal per region -->
                <div class="modal fade" id="modal-{{ Str::slug($region) }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">City/Municipality - {{ $region }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if(!empty($cities[$region]))
                                <ul class="list-group">
                                    @foreach($cities[$region] as $cityMuni => $num)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $cityMuni }}
                                        <span class="badge bg-success rounded-pill">{{ $num }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                <p>No city/municipality data available.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
    <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["M", "T", "W", "T", "F", "S", "S"],
                datasets: [{
                    label: "Sales",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "rgba(255, 255, 255, .8)",
                    data: [50, 20, 10, 22, 50, 10, 40],
                    maxBarThickness: 6
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

        new Chart(ctx3, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#f8f9fa',
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    @endpush
</x-layout>
