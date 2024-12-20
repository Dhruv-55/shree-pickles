@extends('admin.template.layout')
@section('title','Dashboard')
    
@section('content')
      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row">
            <div class="col-lg-8 mb-4 order-0">
              <div class="card">
                <div class="d-flex align-items-end row">
                  <div class="col-sm-7">
                    <div class="card-body">
                      <h5 class="card-title text-primary">
                        @php
                            $salesData = App\Models\Order::salesPercentageChange();
                            $percentageChange = $salesData['percentage_change'];
                            $status = $salesData['status'];
                        @endphp
                    
                        @if ($status == 'Higher')
                            Amazing job! 🎉 You're doing great!
                        @elseif ($status == 'Lower')
                            Don't worry, you'll bounce back! 💪
                        @else
                            It's a new day—let's make it happen tomorrow! 💪
                        @endif
                    </h5>
                    
                    <p class="mb-4">
                        @if ($status == 'Higher')
                            You have done 
                            <span class="fw-bold">{{ $percentageChange }}%</span> 
                            more sales today. Keep up the great work!
                        @elseif ($status == 'Lower')
                            You have done 
                            <span class="fw-bold">{{ $percentageChange }}%</span> 
                            fewer sales today. Don't worry, keep pushing and you'll bounce back!
                        @else
                            You have no sales today. It's a new day—let's make it happen tomorrow! 
                        @endif
                    
                        <br>
                    </p>
                    

                    </div>
                  </div>
                  <div class="col-sm-5 text-center text-sm-left">
                 
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
              <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                          <img
                            src="{{env('LOCAL_URL').'admin-assets/img/icons/unicons/chart-success.png' }}"
                            alt="chart success"
                            class="rounded"
                          />
                        </div>
                        <div class="dropdown">
                          <button
                            class="btn p-0"
                            type="button"
                            id="cardOpt3"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                            <a class="dropdown-item" href="{{ route('admin-order-view') }}">View More</a>
                            {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                          </div>
                        </div>
                      </div>
                      <span class="fw-semibold d-block mb-1">Today Sales</span>
                      <h3 class="card-title mb-2"> £{{ $todaySales }}</h3>
                      {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                          <img
                          src="{{env('LOCAL_URL').'admin-assets/img/icons/unicons/chart-success.png' }}"
                            alt="Credit Card"
                            class="rounded"
                          />
                        </div>
                        <div class="dropdown">
                          <button
                            class="btn p-0"
                            type="button"
                            id="cardOpt6"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                            <a class="dropdown-item" href="{{route('admin-order-view') }}">View More</a>
                          </div>
                        </div>
                      </div>
                      <span>This Month </span>
                      <h3 class="card-title text-nowrap mb-1">£{{ $thisMonthSales }}</h3>
                      {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>     
          </div>
          <div class="row">
             <!-- Total Revenue -->
             <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
              <div class="card">
                <div class="row row-bordered g-0">
                  <div class="col-md-8">
                    <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                    <div id="totalRevenueChart" class="px-2"></div>
                  </div>
                  <div class="col-md-4">
                    <div class="card-body">
                     
                    </div>
                    <div id="growthChart"></div>
                    <div class="text-center fw-semibold pt-3 mb-2">{{$growthPercentage}}% Company Growth</div>

                    <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                      <div class="d-flex">
                        <div class="me-2">
                          <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                        <small>{{ \Carbon\Carbon::now()->year }}</small>
                          <h6 class="mb-0">{{ $thisYearSales }}</h6>
                        </div>
                      </div>
                      <div class="d-flex">
                        <div class="me-2">
                          <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                          <small>{{ \Carbon\Carbon::now()->subYear()->year }}</small>
                          <h6 class="mb-0">{{ $lastYearSales }}</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Total Revenue -->
          </div>
        </div>
        <!-- / Content -->

@endsection

@section('page-js')
<script>
   const totalRevenueChartEl = document.querySelector('#totalRevenueChart');
   let cardColor, headingColor, axisColor, shadeColor, borderColor;

cardColor = config.colors.white;
headingColor = config.colors.headingColor;
axisColor = config.colors.axisColor;
borderColor = config.colors.borderColor;

const totalRevenueChartOptions = {
  series: [
    {
      name: 'Current Year',
      data: @json($currentYearData)  // Inject dynamic data for the current year
    },
    {
      name: 'Last Year',
      data: @json($lastYearData)  // Inject dynamic data for the last year
    }
  ],
  chart: {
    height: 300,
    stacked: true,
    type: 'bar',
    toolbar: { show: false }
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '33%',
      borderRadius: 12,
      startingShape: 'rounded',
      endingShape: 'rounded'
    }
  },
  colors: ['#00E396', '#FF4560'],  // Example colors, replace with your config values
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth',
    width: 6,
    lineCap: 'round',
    colors: ['#fff']
  },
  legend: {
    show: true,
    horizontalAlign: 'left',
    position: 'top',
    markers: {
      height: 8,
      width: 8,
      radius: 12,
      offsetX: -3
    }
  },
  grid: {
    borderColor: '#e7e7e7',
    padding: {
      top: 0,
      bottom: -8,
      left: 20,
      right: 20
    }
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
    labels: {
      style: {
        fontSize: '13px',
        colors: '#a3a3a3'
      }
    },
    axisTicks: {
      show: false
    },
    axisBorder: {
      show: false
    }
  },
  yaxis: {
    labels: {
      style: {
        fontSize: '13px',
        colors: '#a3a3a3'
      }
    }
  },
  responsive: [
    {
      breakpoint: 1700,
      options: {
        plotOptions: {
          bar: {
            borderRadius: 10,
            columnWidth: '32%'
          }
        }
      }
    }
  ],
};

if (totalRevenueChartEl) {
  const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
  totalRevenueChart.render();
}


  // Growth Chart - Radial Bar Chart
  // --------------------------------------------------------------------
  const growthPercentage = {{ $growthPercentage > 0  ? $growthPercentage: 100 }}; // Get the growth percentage from PHP

  const growthChartEl = document.querySelector('#growthChart');
  const growthChartOptions = {
    series: [growthPercentage],  // Use the dynamic growth percentage value here
    labels: ['Growth'],
    chart: {
      height: 240,
      type: 'radialBar'
    },
    plotOptions: {
      radialBar: {
        size: 150,
        offsetY: 10,
        startAngle: -150,
        endAngle: 150,
        hollow: {
          size: '55%'
        },
        track: {
          background: cardColor,
          strokeWidth: '100%'
        },
        dataLabels: {
          name: {
            offsetY: 15,
            color: headingColor,
            fontSize: '15px',
            fontWeight: '600',
            fontFamily: 'Public Sans'
          },
          value: {
            offsetY: -25,
            color: headingColor,
            fontSize: '22px',
            fontWeight: '500',
            fontFamily: 'Public Sans'
          }
        }
      }
    },
    colors: [config.colors.primary],
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'dark',
        shadeIntensity: 0.5,
        gradientToColors: [config.colors.primary],
        inverseColors: true,
        opacityFrom: 1,
        opacityTo: 0.6,
        stops: [30, 70, 100]
      }
    },
    stroke: {
      dashArray: 5
    },
    grid: {
      padding: {
        top: -35,
        bottom: -10
      }
    },
    states: {
      hover: {
        filter: {
          type: 'none'
        }
      },
      active: {
        filter: {
          type: 'none'
        }
      }
    }
  };

  if (typeof growthChartEl !== undefined && growthChartEl !== null) {
    const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
    growthChart.render();
  }

</script>

</div>

@endsection