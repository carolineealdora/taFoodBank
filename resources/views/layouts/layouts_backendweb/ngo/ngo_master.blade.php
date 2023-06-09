<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets\backendweb\img\apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets\backendweb\img\favicon.png') }}">
  <title>
    FoodBank Kita : NGO - Page
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets\backendweb\css\nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets\backendweb\css\nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets\backendweb\css\nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets\backendweb\css\argon-dashboard.css') }}" rel="stylesheet" />
  {{-- flatpickr --}}
  <script src="{{ asset('assets\backendweb\js\plugins\flatpickr.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('assets\backendweb\css\flatpickr.min.css') }}">
  {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
  <style>
    .form-control.datepicker:disabled, .form-control.datepicker[readonly] {
    background-color: #ffffff;
    opacity: 1;
    }
  </style>
  {{-- photoswipe --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe-ui-default.js"></script> --}}
  {{-- <script src="{{ asset('assets\backendweb\photoswipe\dist\photoswipe.esm.js') }}"></script>
  <script src="{{ asset('assets\backendweb\photoswipe\dist\photoswipe-lightbox.esm.js') }}"></script>
  <script type="module">
    import PhotoSwipeLightbox from 'public/assets/backendweb/photoswipe/dist/photoswipe-lightbox.esm.js';
    import PhotoSwipe from 'public/assets/backendweb/photoswipe/dist/photoswipe.esm.js';

    const options = {
      gallery: '#gallery',
      children: 'a',
      pswpModule: PhotoSwipe,
      bgOpacity: 0.2,

      // to apply styles just to this instance of PhotoSwipe
      // mainClass: 'pswp--custom-bg'
    }

    const lightbox = new PhotoSwipeLightbox(options);
    lightbox.init();
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe-ui-default.min.js"></script>
  <link rel="stylesheet" href="{{ asset('assets/backendweb/photoswipe/dist/photoswipe.css') }}"> --}}

</head>

<body class="g-sidenav-show bg-gray-100">
    @include('layouts.layouts_backendweb.ngo.ngo_sidebar')

  <main class="main-content position-relative border-radius-lg ">

    @include('layouts.layouts_backendweb.ngo.ngo_header')

    @yield('ngo_content')

    @include('layouts.layouts_backendweb.ngo.ngo_footer')
    </div>
  </main>

  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Style Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Side Navigation Type</h6>
          <p class="text-sm">Choose between 2 different side navigation types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    // const flatpickr = require("flatpickr");
    flatpickr("#datepicker", {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d", // set the date format
    minDate: "today", // set the minimum selectable date to today
    maxDate: new Date().fp_incr(100), // set the maximum selectable date to 30 days from today
    defaultDate: "today", // set the default selected date to today
    // disable: ["2023-03-27", { from: "2023-03-30", to: "2023-04-03" }], // disable specific dates or date ranges
    locale: {
      firstDayOfWeek: 1, // set Monday as the first day of the week
      weekdays: {
        shorthand: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
        longhand: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
      },
      months: {
        shorthand: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        longhand: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
      }
    }
  });
  </script>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/backendweb/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/backendweb/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/backendweb/js/core/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/backendweb/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/backendweb/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/backendweb/js/plugins/chartjs.min.js') }}"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
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
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
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
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/backendweb/js/argon-dashboard.min.js') }}"></script>
</body>

</html>
