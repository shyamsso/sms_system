@php
  $currentRouteName = Route::currentRouteName();
  $activeRoutes = ['front-pages-pricing', 'front-pages-payment', 'front-pages-checkout', 'front-pages-help-center'];
  $activeClass = in_array($currentRouteName, $activeRoutes) ? 'active' : '';
@endphp
<!-- Navbar: Start -->
<nav class="layout-navbar shadow-none py-0">
  <div class="container">
    <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4 ">
      <!-- Menu logo wrapper: Start -->
      <div class="navbar-brand app-brand demo d-flex py-0 me-4">
        <!-- Mobile menu toggle: Start-->
        <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="tf-icons bx bx-menu bx-sm align-middle"></i>
        </button>
        <!-- Mobile menu toggle: End-->
        <a href="{{ url('/') }}" class="app-brand-link">
          <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
          <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">{{config('variables.templateName')}}</span>
        </a>
      </div>
      <!-- Menu logo wrapper: End -->
      <!-- Menu wrapper: Start -->
      <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
        <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="tf-icons bx bx-x bx-sm"></i>
        </button>
      </div>
      <div class="landing-menu-overlay d-lg-none"></div>
      <!-- Menu wrapper: End -->
      <!-- Toolbar: Start -->
      @if(Auth::check())
      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- navbar button: Start -->
        <li class="ms-1">
          <a href="{{ route('dashboard') }}" class="btn btn-primary"><span class="tf-icons bx bx-user me-md-1"></span><span class="d-none d-md-block">{{auth()->user()->name}}</span></a>
        </li>
        <!-- navbar button: End -->
      </ul>
      @else
      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- navbar button: Start -->
        <li class="ms-1">
          <a href="{{ route('login') }}" class="btn btn-primary"><span class="tf-icons bx bx-user me-md-1"></span><span class="d-none d-md-block">Login</span></a>
        </li>

        <li class="ms-1">
          <a href="{{ route('register') }}" class="btn btn-primary"><span class="tf-icons bx bx-user me-md-1"></span><span class="d-none d-md-block">Register</span></a>
        </li>
        <!-- navbar button: End -->
      </ul>
      @endif
      <!-- Toolbar: End -->
    </div>
  </div>
</nav>
<!-- Navbar: End -->
