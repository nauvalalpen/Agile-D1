/**
 * Modern Admin Dashboard JavaScript
 */
(function($) {
  "use strict";
  
  // Initialize tooltips
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
  
  // Initialize popovers
  const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
  const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
  });
  
  // Toggle sidebar
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    e.preventDefault();
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    
    // If sidebar is toggled, collapse any open menu items
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
      
      // Save state to localStorage
      localStorage.setItem('sidebarToggled', 'true');
    } else {
      localStorage.setItem('sidebarToggled', 'false');
    }
  });
  
  // Check for saved sidebar state on page load
  $(document).ready(function() {
    if (localStorage.getItem('sidebarToggled') === 'true') {
      $("body").addClass("sidebar-toggled");
      $(".sidebar").addClass("toggled");
    }
    
    // Responsive behavior
    checkScreenSize();
    
    // Initialize any charts
    initializeCharts();
    
    // Add animation to dashboard cards
    animateDashboardCards();
  });
  
  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    checkScreenSize();
  });
  
  function checkScreenSize() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    }
    
    // Toggle the side navigation when window is resized below 480px
    if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
      $("body").addClass("sidebar-toggled");
      $(".sidebar").addClass("toggled");
      $('.sidebar .collapse').collapse('hide');
    }
  }
  
  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });
  
  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });
  
  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: 0
    }, 800, 'easeInOutExpo');
    e.preventDefault();
  });
  
  // Toggle dropdown menus
  $('.dropdown-toggle').dropdown();
  
  // Add active class to nav items based on current page
  const currentPath = window.location.pathname;
  $('.sidebar .nav-item .nav-link').each(function() {
    const linkPath = $(this).attr('href');
    if (linkPath && currentPath.includes(linkPath) && linkPath !== '/') {
      $(this).addClass('active');
      
      // If this is a submenu item, expand the parent
      const parentCollapse = $(this).closest('.collapse');
      if (parentCollapse.length) {
        parentCollapse.addClass('show');
        parentCollapse.prev('.nav-link').removeClass('collapsed');
      }
    }
  });
  
  // Initialize any charts (if Chart.js is available)
  function initializeCharts() {
    if (typeof Chart !== 'undefined') {
      // Sample line chart for dashboard
      if (document.getElementById('visitorChart')) {
        const ctx = document.getElementById('visitorChart').getContext('2d');
        const myChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
              label: 'Visitors',
              data: [65, 59, 80, 81, 56, 55, 40, 55, 66, 77, 88, 99],
              backgroundColor: 'rgba(67, 97, 238, 0.1)',
              borderColor: 'rgba(67, 97, 238, 1)',
              borderWidth: 2,
              pointBackgroundColor: 'rgba(67, 97, 238, 1)',
              pointBorderColor: '#fff',
              pointBorderWidth: 2,
              pointRadius: 4,
              tension: 0.3
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              y: {
                beginAtZero: true,
                grid: {
                  drawBorder: false,
                  color: 'rgba(0, 0, 0, 0.05)'
                }
              },
              x: {
                grid: {
                  display: false
                }
              }
            },
            plugins: {
              legend: {
                display: false
              }
            }
          }
        });
      }
      
      // Sample doughnut chart for dashboard
      if (document.getElementById('sourceChart')) {
        const ctx = document.getElementById('sourceChart').getContext('2d');
        const myChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: ['Direct', 'Social', 'Referral', 'Organic'],
            datasets: [{
              data: [35, 25, 20, 20],
              backgroundColor: [
                'rgba(67, 97, 238, 1)',
                'rgba(76, 201, 240, 1)',
                'rgba(72, 149, 239, 1)',
                'rgba(247, 37, 133, 1)'
              ],
              borderWidth: 0
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: 'bottom',
                labels: {
                  padding: 20,
                  usePointStyle: true,
                  pointStyle: 'circle'
                }
              }
            },
            cutout: '70%'
          }
        });
      }
    }
  }
  
  // Add animation to dashboard cards
  function animateDashboardCards() {
    $('.dashboard-card').each(function(index) {
      $(this).css({
        'animation-delay': (index * 0.1) + 's'
      }).addClass('animate__animated animate__fadeInUp');
    });
  }
  
  // Handle form validation
  if ($('.needs-validation').length > 0) {
    // Fetch all forms we want to apply custom validation styles to
    const forms = document.querySelectorAll('.needs-validation');
    
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach(function(form) {
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        
        form.classList.add('was-validated');
      }, false);
    });
  }
  
  // Data tables initialization (if DataTables is available)
  if ($.fn.DataTable && $('.datatable').length > 0) {
    $('.datatable').DataTable({
      responsive: true,
      language: {
        search: "",
        searchPlaceholder: "Search...",
        lengthMenu: "_MENU_ items per page"
      }
    });
  }
  
  // Handle dark mode toggle
  $('#darkModeToggle').on('click', function() {
    $('body').toggleClass('dark-mode');
    
    if ($('body').hasClass('dark-mode')) {
      localStorage.setItem('darkMode', 'enabled');
    } else {
      localStorage.setItem('darkMode', 'disabled');
    }
  });
  
  // Check for saved dark mode preference
  if (localStorage.getItem('darkMode') === 'enabled') {
    $('body').addClass('dark-mode');
  }
  
})(jQuery);

