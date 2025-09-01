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

  <style>
    /* زر التمرير إلى الأعلى */
    .scroll-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: #3498db;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      cursor: pointer;
      z-index: 1000;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    
    .scroll-to-top.show {
      opacity: 1;
    }
    
    .scroll-to-top:hover {
      background-color: #2980b9;
      transform: translateY(-3px);
    }
    
    /* زر التمرير إلى الأسفل */
    .scroll-to-bottom {
      position: fixed;
      bottom: 90px;
      right: 30px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: #3498db;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      cursor: pointer;
      z-index: 1000;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    
    .scroll-to-bottom.show {
      opacity: 1;
    }
  

</style>
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

  <!-- أزرار التمرير -->
  <button class="scroll-to-top" id="scrollToTop" title="انتقل إلى الأعلى">
    <i class="fas fa-arrow-up"></i>
  </button>
  
  <button class="scroll-to-bottom" id="scrollToBottom" title="انتقل إلى الأسفل">
    <i class="fas fa-arrow-down"></i>
  </button>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // عناصر أزرار التمرير
      const scrollToTopBtn = document.getElementById('scrollToTop');
      const scrollToBottomBtn = document.getElementById('scrollToBottom');
      
      // عرض/إخفاء أزرار التمرير بناء على موضع التمرير
      window.addEventListener('scroll', function() {
        // التمرير إلى الأعلى
        if (window.pageYOffset > 300) {
          scrollToTopBtn.classList.add('show');
        } else {
          scrollToTopBtn.classList.remove('show');
        }
        
        // التمرير إلى الأسفل - إظهار الزر إذا لم نكن في الأسفل
        const isAtBottom = window.innerHeight + window.pageYOffset >= document.body.offsetHeight - 100;
        if (!isAtBottom) {
          scrollToBottomBtn.classList.add('show');
        } else {
          scrollToBottomBtn.classList.remove('show');
        }
      });
      
      // التمرير إلى الأعلى عند النقر
      scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
      
      // التمرير إلى الأسفل عند النقر
      scrollToBottomBtn.addEventListener('click', function() {
        window.scrollTo({
          top: document.body.scrollHeight,
          behavior: 'smooth'
        });
      });
    });
  </script>
  
  @stack('scripts') <!-- Optional page-specific scripts -->
</body>

</html>