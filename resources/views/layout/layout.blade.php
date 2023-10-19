<html>
<head>
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <title>@yield('title')</title>
    @yield('header')

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      .nav-link{color: #ffffff }
      .nav-link:hover{color: #221d1d}
     
      .nav-pills .nav-link.active{
        color: #221d1d ;
        background-color: #ffffff;
        font-weight: 700
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

</head>

<body>
  <div class="d-flex" >
  <div class="d-flex flex-column flex-shrink-0 p-3 " style="width: 250px;height:100vh;background-color:#588157">
     <div><a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <img src="assets/LOGO (2).png" class="mx-auto d-flex " width="130" height="130" alt="Responsive image">
    </a></div>
    <span class="border-bottom mb-3"></span>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/akun" class="nav-link @yield('akun')" aria-current="page">
          Kelola Akun 
        </a>
      </li>
     
      <li>
        <a href="/" class="nav-link @yield('dashboard')">
          Orders
        </a>
      </li>
  
    </ul>
    
    
  </div>
  {{-- nav disini --}}
  <div class="container">
          {{-- @include('layout.flash-message') --}}
          @yield('content')
    </div>
</div>

</body>
<footer>
    @yield('footer')
</footer>
<html>   