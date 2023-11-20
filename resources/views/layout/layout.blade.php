<html>

<head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>@yield('title')</title>
    @yield('header')
    <script src="https://kit.fontawesome.com/4be914391d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            font-weight: bold
        }

        .bdr {
            border-radius: 6px;
        }

        .table-striped>tbody>tr:nth-child(odd)>td,
        .table-striped>tbody>tr:nth-child(odd)>th {
            background-color: #f8f9fa;
        }

        @media (min-width: 900px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

</head>

<body>
    <div class="d-flex">
        {{-- sidebar --}}
        <div class="d-flex flex-column flex-shrink-0 p-3 " style="width: 210px;height:100vh;background-color:#588157">
            <div class="d-flex align-items-center justify-content-center mb-2">
                <img src="/foto/ofp_logo.png" width="200" height="100" alt="Responsive image">
            </div>
            <span class="border-bottom mb-3"></span>
            <ul class="nav nav-pills flex-column mb-auto">
                @if (auth()->user()->role == 'superadmin')
                    <li>
                        <a href="/dashboard-superadmin" class="nav-link  @yield('dashboard')">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/kelola-akun" class="nav-link @yield('akun')">
                            Kelola Akun
                        </a>
                    </li>
                @elseif(auth()->user()->role == 'admin')
                    <li>
                        <a href="/dashboard-admin" class="nav-link  @yield('dashboard')">
                            Dashboard
                        </a>
                    </li>
                @endif
            </ul>


        </div>

        <div class="" style="width: 1100;background-color: #F2F2F2; max-height:100vh;overflow-y:auto">
            {{-- nav disini --}}
            <header class="p-2 mb-3 border-bottom bg-light">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-between ">
                        <span class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                            <h1 class="fw-bold">One Finance Planning</h1>
                        </span>

                        <div class="dropdown text-end">
                            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <img src='{{ $profile->foto_profil ? url('foto') . '/' . $profile->foto_profil : url('foto') . '/pfp.jpg' }}' alt="mdo" width="32" height="32"
                                    class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu ">
                                <li>
                                    <div class="col-md-12 d-flex">
                                        <div class="col-md-3 ms-2 me-2">
                                            <img src='{{ $profile->foto_profil ? url('foto') . '/' . $profile->foto_profil : url('foto') . '/pfp.jpg' }}' alt="/" width="50" height="50"
                                                class="rounded-circle" />
                                        </div>
                                        <div class="col-md-7 ms-2 me-2 ">
                                            {{ $profile->nama }}
                                            {{ $profile->email }}
                                            {{-- {{ auth()->user()->role }} --}}
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="dashboard-superadmin/riwayat">Riwayat Aktivitas </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/logout">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            {{-- content  --}}
            <div class=" ms-3 me-3 ">
                @include('layout.flash-message')
                @yield('content')
            </div>
        </div>
    </div>


</body>
<footer>
    @yield('footer')
</footer>
<html>
