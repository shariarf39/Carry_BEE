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
    <nav id="sidebar" class="bg-yellow-400 w-64 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out z-50">
      <div class="p-5">
        <div class="flex items-center space-x-2">
          <img src="https://placehold.co/40x40/1e3a8a/ffc107?text=CB" alt="CarryBee Logo" class="rounded-full">
          <span class="text-xl font-bold text-gray-800">CarryBee</span>
        </div>
        <ul class="mt-10 space-y-2">
          <li><a href="#home" class="nav-link flex items-center gap-3 p-3 rounded-lg font-semibold text-gray-800 transition-all duration-200"><i class="fas fa-home w-6 text-center"></i>Home</a></li>
          <li><a href="#about" class="nav-link flex items-center gap-3 p-3 rounded-lg font-semibold text-gray-800 transition-all duration-200"><i class="fas fa-info-circle w-6 text-center"></i>About Us</a></li>
          <li><a href="#services" class="nav-link flex items-center gap-3 p-3 rounded-lg font-semibold text-gray-800 transition-all duration-200"><i class="fas fa-concierge-bell w-6 text-center"></i>Services</a></li>
          <li><a href="#contact" class="nav-link flex items-center gap-3 p-3 rounded-lg font-semibold text-gray-800 transition-all duration-200"><i class="fas fa-address-book w-6 text-center"></i>Contact</a></li>
        </ul>
      </div>
    </nav>

    

    <main class="flex-1 p-4 sm:p-6 md:p-10">
            <!-- Sections stay the same -->
    </main>



  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sidebar = document.getElementById('sidebar');
      const toggleBtn = document.getElementById('toggle-button');
      const toggleIcon = document.getElementById('toggle-icon');
      const navLinks = document.querySelectorAll('.nav-link');
      const contentSections = document.querySelectorAll('.content-section');

      let sidebarOpen = false;

      toggleBtn.addEventListener('click', () => {
        sidebarOpen = !sidebarOpen;
        sidebar.classList.toggle('-translate-x-full');
        sidebar.classList.toggle('translate-x-0');

        // Switch icon between bars and times
        if (sidebarOpen) {
          toggleIcon.classList.remove('fa-bars');
          toggleIcon.classList.add('fa-times');
        } else {
          toggleIcon.classList.remove('fa-times');
          toggleIcon.classList.add('fa-bars');
        }
      });

      const updateContent = (hash) => {
        const targetId = hash ? hash.substring(1) : 'home';
        const contentId = `${targetId}-content`;

        contentSections.forEach(section => {
          section.classList.toggle('active', section.id === contentId);
        });

        navLinks.forEach(link => {
          link.classList.toggle('active', link.getAttribute('href') === `#${targetId}`);
        });

        // Close sidebar on mobile nav
        if (window.innerWidth <= 768 && sidebarOpen) {
          toggleBtn.click();
        }
      };

      navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
          e.preventDefault();
          const hash = e.currentTarget.getAttribute('href');
          history.pushState(null, null, hash);
          updateContent(hash);
        });
      });

      window.addEventListener('popstate', () => {
        updateContent(window.location.hash);
      });

      updateContent(window.location.hash || '#home');
    });
  </script>
</body>
</html>