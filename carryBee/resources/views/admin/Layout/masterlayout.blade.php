<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CarryBee | Professional Services</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome for Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- Optional: Google Fonts (Roboto for clean UI) -->
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f3f4f6;
      color: #111827;
    }
    .nav-link.active {
      background-color: #1e3a8a;
      color: white !important;
      transform: translateX(4px);
    }
    .nav-link:hover:not(.active) {
      background-color: rgba(255, 255, 255, 0.2);
    }
    .content-section {
      display: none;
    }
    .content-section.active {
      display: block;
    }
    .scrollable-sidebar {
      overflow-y: auto;
      height: 100vh;
    }
    .scrollable-main {
      overflow-y: auto;
      height: calc(100vh - 4rem);
    }
  </style>
</head>
<body>
  <div class="relative min-h-screen md:flex">
    <!-- Mobile Navbar -->
    <div class="bg-white text-gray-800 flex justify-between md:hidden sticky top-0 z-20 shadow-md">
      <a href="#" class="block p-4 text-yellow-500 font-bold text-lg">CarryBee</a>
      <button id="toggle-button" class="p-4 focus:outline-none">
        <i id="toggle-icon" class="fas fa-bars text-xl"></i>
      </button>
    </div>

    <!-- Sidebar -->
    <nav id="sidebar" class="scrollable-sidebar bg-yellow-400 w-64 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out z-50">
      <div class="p-5">
        <div class="flex items-center space-x-2">
          <img src="https://placehold.co/40x40/1e3a8a/ffc107?text=CB" alt="CarryBee Logo" class="rounded-full">
          <span class="text-xl font-bold text-gray-800">CarryBee</span>
        </div>
        <ul class="mt-10 space-y-2">
          <li><a href="{{ route('AdminDashboard') }}" class="nav-link flex items-center gap-3 p-3 rounded-lg font-semibold text-gray-800 transition-all duration-200"><i class="fas fa-home w-6 text-center"></i>Home</a></li>
            <li><a href="{{ route('DiscountData') }}" class="nav-link flex items-center gap-3 p-3 rounded-lg font-semibold text-gray-800 transition-all duration-200"><i class="fas fa-users w-6 text-center"></i>Merchant Data</a></li>
            <li><a href="{{ route('AdminServices') }}" class="nav-link flex items-center gap-3 p-3 rounded-lg font-semibold text-gray-800 transition-all duration-200"><i class="fas fa-concierge-bell w-6 text-center"></i>Admin</a></li>
            <li><a href="{{ route('User') }}" class="nav-link flex items-center gap-3 p-3 rounded-lg font-semibold text-gray-800 transition-all duration-200">
            <i class="fas fa-user w-6 text-center"></i>Merchant </a>
            </li>
          <li>
            <a href="{{ route('admin.logout') }}" class="nav-link flex items-center gap-3 p-3 rounded-lg font-semibold text-gray-800 transition-all duration-200">
              <i class="fas fa-sign-out-alt w-6 text-center"></i>Logout
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1">
      @hasSection('content')
        <div class="scrollable-main p-4 sm:p-6 md:p-10">
          @yield('content')
          
        </div>
      @else
        <div class="scrollable-main p-4 sm:p-6 md:p-10 flex items-center justify-center h-full">
          <h2 class="text-xl text-gray-500">No content found</h2>
        </div>
      @endif
    </main>
  </div>

  <script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <!-- The reason your navigation doesn't redirect is because you're using anchor <a> with "href" as route names in Blade, but also using JavaScript to intercept clicks. To fix this: -->

<!-- Option 1 (Recommended): Remove the JS interception for Laravel route links -->
<!-- Modify the script to only intercept anchor tags with hash links (like #services) -->

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggle-button');
    const toggleIcon = document.getElementById('toggle-icon');

    let sidebarOpen = false;

    toggleBtn?.addEventListener('click', () => {
      sidebarOpen = !sidebarOpen;
      sidebar.classList.toggle('-translate-x-full');
      sidebar.classList.toggle('translate-x-0');

      toggleIcon.classList.toggle('fa-bars', !sidebarOpen);
      toggleIcon.classList.toggle('fa-times', sidebarOpen);
    });

    const navLinks = document.querySelectorAll('.nav-link');
    const contentSections = document.querySelectorAll('.content-section');

    navLinks.forEach(link => {
      const href = link.getAttribute('href');

      // Only intercept client-side hash navigation like #services
      if (href.startsWith('#')) {
        link.addEventListener('click', (e) => {
          e.preventDefault();
          const hash = e.currentTarget.getAttribute('href');
          history.pushState(null, null, hash);
          updateContent(hash);

          if (window.innerWidth <= 768 && sidebarOpen) {
            toggleBtn.click();
          }
        });
      }
    });

    const updateContent = (hash) => {
      const targetId = hash ? hash.substring(1) : 'home';
      const contentId = `${targetId}-content`;

      contentSections.forEach(section => {
        section.classList.toggle('active', section.id === contentId);
      });

      navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href.startsWith('#')) {
          link.classList.toggle('active', href === `#${targetId}`);
        }
      });
    };

    updateContent(window.location.hash || '#home');
  });
</script>

<!-- RESULT: Your Blade route links like route('AdminDashboard') or route('DiscountData') will work via full page navigation. Only # links will be handled by JS SPA style navigation. -->

  </script>
  
  @stack('scripts')
</body>
</html>