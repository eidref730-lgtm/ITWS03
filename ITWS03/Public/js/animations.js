/**
 * Prosple - Animations and Interactions
 * Adds smooth animations and interactive effects
 */

document.addEventListener('DOMContentLoaded', function() {
  
  // =========================================================================
  // SCROLL-TRIGGERED ANIMATIONS
  // =========================================================================
  
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-in');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Observe elements for scroll animations
  const animateElements = document.querySelectorAll(
    '.job-card, .hero-stat, .cta-banner, .form-section, .error-card'
  );
  
  animateElements.forEach(function(el) {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
    observer.observe(el);
  });

  // Add animate-in class styles
  const style = document.createElement('style');
  style.textContent = `
    .animate-in {
      opacity: 1 !important;
      transform: translateY(0) !important;
    }
  `;
  document.head.appendChild(style);

  // =========================================================================
  // COUNTER ANIMATION FOR STATS
  // =========================================================================

  function animateCounter(element, target, duration) {
    let start = 0;
    const increment = target / (duration / 16);
    const timer = setInterval(function() {
      start += increment;
      if (start >= target) {
        element.textContent = target + (target >= 1000 ? '+' : '');
        clearInterval(timer);
      } else {
        element.textContent = Math.floor(start) + (target >= 1000 ? '+' : '');
      }
    }, 16);
  }

  const statElements = document.querySelectorAll('.hero-stat strong');
  const statsObserver = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        const text = entry.target.textContent.trim();
        const match = text.match(/(\d+)/);
        if (match) {
          const target = parseInt(match[1]);
          animateCounter(entry.target, target, 1000);
        }
        statsObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  statElements.forEach(function(el) {
    statsObserver.observe(el);
  });

  // =========================================================================
  // SMOOTH SCROLLING FOR ANCHOR LINKS
  // =========================================================================

  document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  // =========================================================================
  // JOB CARD HOVER EFFECTS
  // =========================================================================

  document.querySelectorAll('.job-card').forEach(function(card) {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-6px) scale(1.01)';
    });
    
    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0) scale(1)';
    });
  });

  // =========================================================================
  // FORM INPUT FOCUS EFFECTS
  // =========================================================================

  document.querySelectorAll('.form-input').forEach(function(input) {
    input.addEventListener('focus', function() {
      this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
      this.parentElement.classList.remove('focused');
    });
  });

  // =========================================================================
  // BUTTON RIPPLE EFFECT
  // =========================================================================

  document.querySelectorAll('.btn, .job-details-btn').forEach(function(button) {
    button.addEventListener('click', function(e) {
      const ripple = document.createElement('span');
      const rect = this.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height);
      const x = e.clientX - rect.left - size / 2;
      const y = e.clientY - rect.top - size / 2;
      
      ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        left: ${x}px;
        top: ${y}px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
      `;
      
      this.style.position = 'relative';
      this.style.overflow = 'hidden';
      this.appendChild(ripple);
      
      setTimeout(function() {
        ripple.remove();
      }, 600);
    });
  });

  // Add ripple animation keyframes
  const rippleStyle = document.createElement('style');
  rippleStyle.textContent = `
    @keyframes ripple-animation {
      to {
        transform: scale(4);
        opacity: 0;
      }
    }
  `;
  document.head.appendChild(rippleStyle);

  // =========================================================================
  // PARALLAX EFFECT FOR HERO SECTION
  // =========================================================================

  const heroSection = document.querySelector('.hero-section');
  if (heroSection) {
    window.addEventListener('scroll', function() {
      const scrolled = window.pageYOffset;
      const rate = scrolled * 0.5;
      heroSection.style.backgroundPosition = `center ${rate}px`;
    });
  }

  // =========================================================================
  // TYPING EFFECT FOR HERO TITLE (OPTIONAL)
  // =========================================================================

  const heroTitle = document.querySelector('.hero-content h2');
  if (heroTitle && !heroTitle.dataset.animated) {
    heroTitle.dataset.animated = 'true';
  }

  // =========================================================================
  // TOOLTIP FOR JOB TAGS
  // =========================================================================

  document.querySelectorAll('.job-tag').forEach(function(tag) {
    tag.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-2px)';
      this.style.boxShadow = '0 4px 12px rgba(15, 118, 110, 0.2)';
    });
    
    tag.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
      this.style.boxShadow = 'none';
    });
  });

  // =========================================================================
  // SEARCH FORM ENHANCEMENT
  // =========================================================================

  const searchForm = document.querySelector('.hero-search-form');
  if (searchForm) {
    searchForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const keyword = this.querySelector('input[name="keywords"]').value;
      const location = this.querySelector('input[name="location"]').value;
      
      // Add your search logic here
      console.log('Searching for:', keyword, 'in', location);
      
      // Visual feedback
      const btn = this.querySelector('.search-btn');
      btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Searching...';
      setTimeout(function() {
        btn.innerHTML = '<i class="fa fa-search"></i> Search Jobs';
      }, 1500);
    });
  }

  // =========================================================================
  // NAVBAR SCROLL EFFECT
  // =========================================================================

  const header = document.querySelector('.site-header');
  if (header) {
    let lastScroll = 0;
    
    window.addEventListener('scroll', function() {
      const currentScroll = window.pageYOffset;
      
      if (currentScroll > 100) {
        header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
        header.style.background = 'rgba(31, 41, 55, 0.95)';
        header.style.backdropFilter = 'blur(10px)';
      } else {
        header.style.boxShadow = 'none';
        header.style.background = '#1f2937';
        header.style.backdropFilter = 'none';
      }
      
      lastScroll = currentScroll;
    });
  }

  // =========================================================================
  // LAZY LOADING FOR IMAGES
  // =========================================================================

  const images = document.querySelectorAll('img[data-src]');
  const imageObserver = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
        imageObserver.unobserve(img);
      }
    });
  }, { rootMargin: '100px' });

  images.forEach(function(img) {
    imageObserver.observe(img);
  });

  console.log('Prosple animations loaded successfully!');
});
