<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1">
  <link rel="canonical" href="https://preline.co/">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Comprehensive overview with charts, tables, and a streamlined dashboard layout for easy data visualization and analysis.">

  <meta name="twitter:site" content="@preline">
  <meta name="twitter:creator" content="@preline">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Email sender">
  <meta name="twitter:description" content="Comprehensive overview with charts, tables, and a streamlined dashboard layout for easy data visualization and analysis.">
  <meta name="twitter:image" content="https://preline.co/assets/img/og-image.png">

  <meta property="og:url" content="https://preline.co/">
  <meta property="og:locale" content="en_US">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Preline">
  <meta property="og:title" content="Email sender">
  <meta property="og:description" content="Comprehensive overview with charts, tables, and a streamlined dashboard layout for easy data visualization and analysis.">
  <meta property="og:image" content="https://preline.co/assets/img/og-image.png">

  <!-- Title -->
  <title>Email sender</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="../../favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  @vite('resources/js/app.js')
  @vite('resources/css/app.css')


  <!-- Theme Check and Update -->
  <script>
    const html = document.querySelector('html');
    const isLightOrAuto = localStorage.getItem('hs_theme') === 'light' || (localStorage.getItem('hs_theme') === 'auto' && !window.matchMedia('(prefers-color-scheme: dark)').matches);
    const isDarkOrAuto = localStorage.getItem('hs_theme') === 'dark' || (localStorage.getItem('hs_theme') === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches);

    if (isLightOrAuto && html.classList.contains('dark')) html.classList.remove('dark');
    else if (isDarkOrAuto && html.classList.contains('light')) html.classList.remove('light');
    else if (isDarkOrAuto && !html.classList.contains('dark')) html.classList.add('dark');
    else if (isLightOrAuto && !html.classList.contains('light')) html.classList.add('light');
  </script>

  <!-- Apexcharts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.min.css">
  <style type="text/css">
    .apexcharts-tooltip.apexcharts-theme-light
    {
      background-color: transparent !important;
      border: none !important;
      box-shadow: none !important;
    }
  </style>

  <!-- CSS Preline -->
  <link rel="stylesheet" href="https://preline.co/assets/css/main.min.css">
</head>

<body class="bg-[#fef2ea]">
  <!-- ========== HEADER ========== -->
  <header class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-[48] w-full bg-white border-b text-sm py-2.5 lg:ps-[260px] dark:bg-neutral-800 dark:border-neutral-700">
    @include('layouts.navbar')
  </header>
  <!-- ========== END HEADER ========== -->

  <!-- ========== MAIN CONTENT ========== -->
  <!-- Breadcrumb -->
  <div class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 lg:px-8 lg:hidden dark:bg-neutral-800 dark:border-neutral-700">
    <div class="flex items-center py-2">
      <!-- Navigation Toggle -->
      <button type="button" class="size-8 flex justify-center items-center gap-x-2 border border-gray-200 text-gray-800 hover:text-gray-500 rounded-lg focus:outline-none focus:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-application-sidebar" aria-label="Toggle navigation" data-hs-overlay="#hs-application-sidebar">
        <span class="sr-only">Toggle Navigation</span>
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect width="18" height="18" x="3" y="3" rx="2" />
          <path d="M15 3v18" />
          <path d="m8 9 3 3-3 3" />
        </svg>
      </button>
      <!-- End Navigation Toggle -->

      <!-- Breadcrumb -->
      <ol class="ms-3 flex items-center whitespace-nowrap">
        <li class="flex items-center text-sm text-gray-800 dark:text-neutral-400">
          Application Layout
          <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
          </svg>
        </li>
        <li class="text-sm font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
          Dashboard
        </li>
      </ol>
      <!-- End Breadcrumb -->
    </div>
  </div>
  <!-- End Breadcrumb -->

  <!-- Sidebar -->
  @include('layouts.sidebar')
  <!-- End Sidebar -->

  <!-- Content -->
  <div class="mx-5 mt-5 max-w-screen lg:ps-64">
    @yield('content')
  </div>
  <!-- End Content -->


  <!-- JS Implementing Plugins -->

  <!-- JS PLUGINS -->
  <!-- Required plugins -->
  <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.min.js"></script>

  <!-- Apexcharts -->
  <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

  <script>
    window.addEventListener("load", () => {
      (function () {
        buildChart(
          "#hs-multiple-bar-charts",
          (mode) => ({
            chart: {
              type: "bar",
              height: 300,
              toolbar: {
                show: false,
              },
              zoom: {
                enabled: false,
              },
            },
            series: [
              {
                name: "Chosen Period",
                data: [
                  23000, 44000, 55000, 57000, 56000, 61000, 58000, 63000, 60000,
                  66000, 34000, 78000,
                ],
              },
              {
                name: "Last Period",
                data: [
                  17000, 76000, 85000, 101000, 98000, 87000, 105000, 91000, 114000,
                  94000, 67000, 66000,
                ],
              },
            ],
            plotOptions: {
              bar: {
                horizontal: false,
                columnWidth: "16px",
                borderRadius: 0,
              },
            },
            legend: {
              show: false,
            },
            dataLabels: {
              enabled: false,
            },
            stroke: {
              show: true,
              width: 8,
              colors: ["transparent"],
            },
            xaxis: {
              categories: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
              ],
              axisBorder: {
                show: false,
              },
              axisTicks: {
                show: false,
              },
              crosshairs: {
                show: false,
              },
              labels: {
                style: {
                  colors: "#9ca3af",
                  fontSize: "13px",
                  fontFamily: "Inter, ui-sans-serif",
                  fontWeight: 400,
                },
                offsetX: -2,
                formatter: (title) => title.slice(0, 3),
              },
            },
            yaxis: {
              labels: {
                align: "left",
                minWidth: 0,
                maxWidth: 140,
                style: {
                  colors: "#9ca3af",
                  fontSize: "13px",
                  fontFamily: "Inter, ui-sans-serif",
                  fontWeight: 400,
                },
                formatter: (value) => (value >= 1000 ? `${value / 1000}k` : value),
              },
            },
            states: {
              hover: {
                filter: {
                  type: "darken",
                  value: 0.9,
                },
              },
            },
            tooltip: {
              y: {
                formatter: (value) =>
                  `$${value >= 1000 ? `${value / 1000}k` : value}`,
              },
              custom: function (props) {
                const { categories } = props.ctx.opts.xaxis;
                const { dataPointIndex } = props;
                const title = categories[dataPointIndex];
                const newTitle = `${title}`;

                return buildTooltip(props, {
                  title: newTitle,
                  mode,
                  hasTextLabel: true,
                  wrapperExtClasses: "min-w-28",
                  labelDivider: ":",
                  labelExtClasses: "ms-2",
                });
              },
            },
            responsive: [
              {
                breakpoint: 568,
                options: {
                  chart: {
                    height: 300,
                  },
                  plotOptions: {
                    bar: {
                      columnWidth: "14px",
                    },
                  },
                  stroke: {
                    width: 8,
                  },
                  labels: {
                    style: {
                      colors: "#9ca3af",
                      fontSize: "11px",
                      fontFamily: "Inter, ui-sans-serif",
                      fontWeight: 400,
                    },
                    offsetX: -2,
                    formatter: (title) => title.slice(0, 3),
                  },
                  yaxis: {
                    labels: {
                      align: "left",
                      minWidth: 0,
                      maxWidth: 140,
                      style: {
                        colors: "#9ca3af",
                        fontSize: "11px",
                        fontFamily: "Inter, ui-sans-serif",
                        fontWeight: 400,
                      },
                      formatter: (value) =>
                        value >= 1000 ? `${value / 1000}k` : value,
                    },
                  },
                },
              },
            ],
          }),
          {
            colors: ["#2563eb", "#d1d5db"],
            grid: {
              borderColor: "#e5e7eb",
            },
          },
          {
            colors: ["#6b7280", "#2563eb"],
            grid: {
              borderColor: "#404040",
            },
          }
        );
      })();
    });
  </script>
  <script>
    window.addEventListener("load", () => {
      (function () {
        buildChart(
          "#hs-single-area-chart",
          (mode) => ({
            chart: {
              height: 300,
              type: "area",
              toolbar: {
                show: false,
              },
              zoom: {
                enabled: false,
              },
            },
            series: [
              {
                name: "Visitors",
                data: [180, 51, 60, 38, 88, 50, 40, 52, 88, 80, 60, 70],
              },
            ],
            legend: {
              show: false,
            },
            dataLabels: {
              enabled: false,
            },
            stroke: {
              curve: "straight",
              width: 2,
            },
            grid: {
              strokeDashArray: 2,
            },
            fill: {
              type: "gradient",
              gradient: {
                type: "vertical",
                shadeIntensity: 1,
                opacityFrom: 0.1,
                opacityTo: 0.8,
              },
            },
            xaxis: {
              type: "category",
              tickPlacement: "on",
              categories: [
                "25 January 2023",
                "26 January 2023",
                "27 January 2023",
                "28 January 2023",
                "29 January 2023",
                "30 January 2023",
                "31 January 2023",
                "1 February 2023",
                "2 February 2023",
                "3 February 2023",
                "4 February 2023",
                "5 February 2023",
              ],
              axisBorder: {
                show: false,
              },
              axisTicks: {
                show: false,
              },
              crosshairs: {
                stroke: {
                  dashArray: 0,
                },
                dropShadow: {
                  show: false,
                },
              },
              tooltip: {
                enabled: false,
              },
              labels: {
                style: {
                  colors: "#9ca3af",
                  fontSize: "13px",
                  fontFamily: "Inter, ui-sans-serif",
                  fontWeight: 400,
                },
                formatter: (title) => {
                  let t = title;

                  if (t) {
                    const newT = t.split(" ");
                    t = `${newT[0]} ${newT[1].slice(0, 3)}`;
                  }

                  return t;
                },
              },
            },
            yaxis: {
              labels: {
                align: "left",
                minWidth: 0,
                maxWidth: 140,
                style: {
                  colors: "#9ca3af",
                  fontSize: "13px",
                  fontFamily: "Inter, ui-sans-serif",
                  fontWeight: 400,
                },
                formatter: (value) => (value >= 1000 ? `${value / 1000}k` : value),
              },
            },
            tooltip: {
              x: {
                format: "MMMM yyyy",
              },
              y: {
                formatter: (value) =>
                  `${value >= 1000 ? `${value / 1000}k` : value}`,
              },
              custom: function (props) {
                const { categories } = props.ctx.opts.xaxis;
                const { dataPointIndex } = props;
                const title = categories[dataPointIndex].split(" ");
                const newTitle = `${title[0]} ${title[1]}`;

                return buildTooltip(props, {
                  title: newTitle,
                  mode,
                  valuePrefix: "",
                  hasTextLabel: true,
                  markerExtClasses: "!rounded-sm",
                  wrapperExtClasses: "min-w-28",
                });
              },
            },
            responsive: [
              {
                breakpoint: 568,
                options: {
                  chart: {
                    height: 300,
                  },
                  labels: {
                    style: {
                      colors: "#9ca3af",
                      fontSize: "11px",
                      fontFamily: "Inter, ui-sans-serif",
                      fontWeight: 400,
                    },
                    offsetX: -2,
                    formatter: (title) => title.slice(0, 3),
                  },
                  yaxis: {
                    labels: {
                      align: "left",
                      minWidth: 0,
                      maxWidth: 140,
                      style: {
                        colors: "#9ca3af",
                        fontSize: "11px",
                        fontFamily: "Inter, ui-sans-serif",
                        fontWeight: 400,
                      },
                      formatter: (value) =>
                        value >= 1000 ? `${value / 1000}k` : value,
                    },
                  },
                },
              },
            ],
          }),
          {
            colors: ["#2563eb", "#9333ea"],
            fill: {
              gradient: {
                stops: [0, 90, 100],
              },
            },
            grid: {
              borderColor: "#e5e7eb",
            },
          },
          {
            colors: ["#3b82f6", "#a855f7"],
            fill: {
              gradient: {
                stops: [100, 90, 0],
              },
            },
            grid: {
              borderColor: "#404040",
            },
          }
        );
      })();
    });
    </script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    @stack('js')

</body>
</html>