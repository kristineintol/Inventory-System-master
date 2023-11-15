@extends('dashboard.body.main')


@section('specificpagestyles')
<link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
@endsection

@section('specificpagescripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
{{-- <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script> --}}
<script>
    var chartData = @json("{{$chartData}}");
    var ctx = document.getElementById('myBarChart');
    var ctxx = document.getElementById('myAreaChart');
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(chartData), // dates
            datasets: [{
                label: 'Quantity',
                data: Object.values(chartData), // quantities
                // backgroundColor: 'rgba(0, 123, 255, 0.5)',
                // borderColor: 'rgba(0, 123, 255, 1)',
                backgroundColor: 'rgba(0, 97, 242, 1)',
                hoverBackgroundColor: 'rgba(0, 97, 242, 0.9)',
                borderColor: '#4e73df',
                maxBarThickness: 25,
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        // max: 100,
                        beginAtZero: true
                    }
                }]
            },
            // scales: {
            //     xAxes: [{
            //         time: {
            //             unit: "month"
            //         },
            //         gridLines: {
            //             display: false,
            //             drawBorder: false
            //         },
            //         ticks: {
            //             maxTicksLimit: 6
            //         }
            //     }],
            //     yAxes: [{
            //         ticks: {
            //             min: 0,
            //             max: 15000,
            //             maxTicksLimit: 5,
            //             padding: 10,
            //             // Include a dollar sign in the ticks
            //             callback: function(value, index, values) {
            //                 return "₱" + value;
            //             }
            //         },
            //         gridLines: {
            //             color: "rgb(234, 236, 244)",
            //             zeroLineColor: "rgb(234, 236, 244)",
            //             drawBorder: false,
            //             borderDash: [2],
            //             zeroLineBorderDash: [2]
            //         }
            //     }]
            // },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: "#6e707e",
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel =
                            chart.datasets[tooltipItem.datasetIndex].label || "";
                        return datasetLabel + ": ₱" + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });



    var myAreaChart = new Chart(ctxx, {
        type: 'doughnut',
        data: {
            labels: Object.keys(chartData), // dates
            datasets: [{
                label: 'Quantity',
                data: Object.values(chartData), // quantities
                // backgroundColor: 'rgba(0, 123, 255, 0.5)',
                // borderColor: 'rgba(0, 123, 255, 1)',
                backgroundColor: 'rgba(0, 97, 242, 1)',
                hoverBackgroundColor: 'rgba(0, 97, 242, 0.9)',
                borderColor: '#4e73df',
                maxBarThickness: 25,
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        // max: 100,
                        beginAtZero: true
                    }
                }]
            },
            // scales: {
            //     xAxes: [{
            //         time: {
            //             unit: "month"
            //         },
            //         gridLines: {
            //             display: false,
            //             drawBorder: false
            //         },
            //         ticks: {
            //             maxTicksLimit: 6
            //         }
            //     }],
            //     yAxes: [{
            //         ticks: {
            //             min: 0,
            //             max: 15000,
            //             maxTicksLimit: 5,
            //             padding: 10,
            //             // Include a dollar sign in the ticks
            //             callback: function(value, index, values) {
            //                 return "₱" + value;
            //             }
            //         },
            //         gridLines: {
            //             color: "rgb(234, 236, 244)",
            //             zeroLineColor: "rgb(234, 236, 244)",
            //             drawBorder: false,
            //             borderDash: [2],
            //             zeroLineBorderDash: [2]
            //         }
            //     }]
            // },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: "#6e707e",
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel =
                            chart.datasets[tooltipItem.datasetIndex].label || "";
                        return datasetLabel + ": ₱" + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/litepicker.js') }}"></script>
@endsection

@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        Dashboard
                    </h1>
                    <div class="page-header-subtitle">Overview and content summary</div>
                </div>
                <div class="col-12 col-xl-auto mt-4">
                    {{-- <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                        <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                        <input class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." />
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main page content -->
<div class="container-xl px-4 mt-n10">
    <!-- Example Colored Cards for Dashboard Demo -->
    <div class="row">
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Requisitions</div>
                            <div class="text-lg fw-bold">{{$requisitions->count()}}</div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="calendar"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="{{ route('requisitions.index') }}">View Requisitions</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
        
        @if (auth()->user()->is_admin)
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Earnings</div>
                                @php
                                    $earning = 0;
                                    foreach ($procurements as $key => $procurement) {
                                        $earning += $procurement->price;
                                    }    
                                @endphp
                                <div class="text-lg fw-bold">₱{{$earning}}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="dollar-sign"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="{{ route('procurements.index') }}">View Procurements</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Inventory</div>
                                <div class="text-lg fw-bold">{{$products->count()}}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="check-square"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="{{ route('products.index') }}">View Inventory</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-danger text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Technicians</div>
                                <div class="text-lg fw-bold">{{$technicians->count()}}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="message-circle"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="{{ route('technicians.index') }}">View Technicians</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Purchased</div>
                                <div class="text-lg fw-bold">{{$procurements->count()}}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="check-square"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="{{ route('procurements.index') }}">View Purchased</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Total Spent</div>
                                @php
                                    $earning = 0;
                                    foreach ($procurements as $key => $procurement) {
                                        $earning += $procurement->price;
                                    }    
                                @endphp
                                <div class="text-lg fw-bold">₱{{$earning}}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="dollar-sign"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="{{ route('report') }}">View Reports</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @if (auth()->user()->is_admin)
        <!-- Example Charts for Dashboard Demo -->
        <div class="row">
            <div class="col-xl-6 mb-4">
                <div class="card card-header-actions h-100">
                    <div class="card-header">
                        Revenue Chart
                        <div class="dropdown no-caret">
                            <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                            <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample">
                                <a class="dropdown-item" href="#">Last 12 Months</a>
                                <a class="dropdown-item" href="#">Last 30 Days</a>
                                <a class="dropdown-item" href="#">Last 7 Days</a>
                                <a class="dropdown-item" href="#">This Month</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Custom Range</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-4">
                <div class="card card-header-actions h-100">
                    <div class="card-header">
                        Daily Revenue
                        <div class="dropdown no-caret">
                            <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                            <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample">
                                <a class="dropdown-item" href="#">Last 12 Months</a>
                                <a class="dropdown-item" href="#">Last 30 Days</a>
                                <a class="dropdown-item" href="#">Last 7 Days</a>
                                <a class="dropdown-item" href="#">This Month</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Custom Range</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar"><canvas id="myBarChart" width="100%" height="30"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection