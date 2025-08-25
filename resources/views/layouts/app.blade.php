<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'voice Line System')</title>

  <!-- Bootstrap + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">

  

  @stack('styles') <!-- Optional page-specific styles -->

  
</head>

<body>

  <!-- Logo -->
  <picture>
    <source srcset="{{ asset('assets/logowithname.svg') }}" type="image/svg+xml">
    <img src="{{ asset('assets/logowithname.svg') }}" class="logo" alt="logo" draggable="false">
  </picture>

  <!-- Decorative Images -->
  <img src="{{ asset('assets/bottomleft.svg') }}" class="bottom-left" alt="bottomleft" draggable="false">
  <img src="{{ asset('assets/topright.svg') }}" class="top-right" alt="topright" draggable="false">

  <!-- User Profile Dropdown -->
  <div class="profile">
    <div class="dropdown">
      <button class="dropbtn">
        <i class="fa-solid fa-circle-user" style="color: white; font-size: 38px;"></i>
      </button>
      <div class="dropdown-content">
        <a href="{{ url('/profile') }}">Profile</a>
         <a href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>
      </div>
    </div>
  </div>


  
  <!-- Main Navigation Choices -->
  
  <!-- Main Content Area -->
  <main>
    @yield('content')
  </main>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  @stack('scripts') <!-- Optional page-specific scripts -->
</body>

</html>
