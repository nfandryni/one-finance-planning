<html>
<head>
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <title>@yield('title')</title>
    @yield('header')
    <script src="https://kit.fontawesome.com/4be914391d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <style>
       .nav-link {
            color: #ffffff
        }

        .nav-link:hover {
            color: #221d1d
        }

        .nav-pills .nav-link.active {
            color: #588157;
            background-color: #ffffff;
            font-weight: 700;
        }

        .bdr {
            border-radius: 6px;
        }

        .table-striped>tbody>tr:nth-child(odd)>td,
        .table-striped>tbody>tr:nth-child(odd)>th {
            background-color: #FFC107;
        }

        @media (min-width: 900px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

</head>


<body>
  
  <div class="d-flex" style=" height: 100%;">
  <div class="d-flex flex-column flex-shrink-0 p-3 " style="width: 250px;background-color:#588157;">
     <div><a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <img src="{{url('assets/LOGO (2).png') }}" class="mx-auto d-flex " width="130" height="130" alt="Responsive image">
    </a></div>
    <span class="border-bottom mb-3"></span>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
      <li>
        <a href="/dashboard-bendahara" class="nav-link @yield('dashboard')">
          Dashboard
        </a>
      </li>
      <li>
        <a href="/dashboard-bendahara/pemasukan" class="nav-link @yield('pemasukan')">
         Dana Pemasukan
        </a>
      </li>
      <li>
        <a href="/dashboard-bendahara/pengeluaran" class="nav-link @yield('pengeluaran')">
         Dana Pengeluaran
        </a>
      </li>
      <li>
        <a href="/dashboard-bendahara/gedung" class="nav-link @yield('gedung')">
          Kelola Data Master
        </a>
      </li>
      <li>
        <a href="/dashboard-bendahara/gedung" class="nav-link @yield('gedung')">
          Gedung
        </a>
      </li>
      <li>
        <a href="/dashboard-bendahara/sumber-dana" class="nav-link @yield('sumber-dana')">
          Sumber Dana
        </a>
      </li>
      <li>
        <a href="/dashboard-bendahara/jenis-pengeluaran" class="nav-link @yield('jenis-pengeluaran')">
          Jenis Pengeluaran
        </a>
      </li>
      <li>
        <a href="/dashboard-bendahara/perencanaan-keuangan" class="nav-link @yield('perencanaan-keuangan')">
         Perencanaan Keuangan
        </a>
      </li>
      <li>
        <a href="/dashboard-bendahara/realisasi" class="nav-link @yield('realisasi')">
         Realisasi 
        </a>
      </li>
      <li>
        <a href="/dashboard-bendahara/pengajuan-kebutuhan" class="nav-link @yield('pengajuan-kebutuhan')">
         Pengajuan Kebutuhan
        </a>
      </li>
      <li>
        <a href="/dashboard-bendahara/logs" class="nav-link @yield('logs')">
         Log Activity
        </a>
      </li>
      <li>
        <a href="/logout" class="nav-link @yield('logout')">
          Logout
        </a>
      </li>
    </ul>
    
    
    </div>

<div class="card w-100" style="max-height: 100vh; overflow: scroll; background-color: #F2F2F2">
  {{-- nav disini --}}
  <header class="p-2 mb-3 border-bottom bg-light">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-between ">
        <span class="d-flex align-items-center  mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
         <h1 class="fw-bold">One Finance Planning</h1>
        </span>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" >
            <img src="../pfp.jpg" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu ">
            <li>
              <div class="col-md-12 d-flex">
                <div class="col-md-4 ms-2 me-2">
                  <img src='../pfp.jpg' alt="/" width="50" height="50" class="rounded-circle"/>
                </div>
                <div class="col-md-6 ms-2 me-2">
                  {{ Auth::user()->username }}
                </div>
              </div>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/logout">Log out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>

{{-- nav disini --}}
<div class="container">
        @include('layout.flash-message')
        @yield('content')
  </div>
</div>


</body>
<footer>
  @yield('footer')
</footer>
<html>    