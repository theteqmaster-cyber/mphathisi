/**
 * Mphathisi Ndlovu — Lightweight Interactive CV Controller
 * Zero idle CPU loops: handles sidebar toggle, scroll spy,
 * lazy media player, theme toggle, and clean contact submission.
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Sidebar Drawer Toggle (Mobile & Desktop)
  const hamburgerBtn = document.getElementById('hamburgerBtn');
  const sidebarDrawer = document.getElementById('sidebarDrawer');
  const body = document.body;
  const navLinks = document.querySelectorAll('.nav-link');

  const toggleSidebar = () => {
    if (window.innerWidth >= 1024) {
      sidebarDrawer.classList.toggle('collapsed');
      body.classList.toggle('body-collapsed');
    } else {
      sidebarDrawer.classList.toggle('drawer-open');
    }
  };

  if (hamburgerBtn && sidebarDrawer) {
    hamburgerBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      toggleSidebar();
    });

    document.addEventListener('click', (e) => {
      if (window.innerWidth < 1024) {
        if (!sidebarDrawer.contains(e.target) && !hamburgerBtn.contains(e.target)) {
          sidebarDrawer.classList.remove('drawer-open');
        }
      }
    });

    navLinks.forEach((link) => {
      link.addEventListener('click', () => {
        if (window.innerWidth < 1024) {
          sidebarDrawer.classList.remove('drawer-open');
        }
      });
    });
  }

  // 2. Scroll-Spy Highlight (Passive listener for smooth scrolling)
  const sections = document.querySelectorAll('section[id]');
  let ticking = false;

  const updateScrollSpy = () => {
    const scrollPos = window.scrollY + 120;
    sections.forEach((section) => {
      const top = section.offsetTop;
      const height = section.offsetHeight;
      const id = section.getAttribute('id');

      if (scrollPos >= top && scrollPos < top + height) {
        navLinks.forEach((link) => {
          link.classList.toggle('active', link.getAttribute('href') === `#${id}`);
        });
      }
    });
    ticking = false;
  };

  window.addEventListener('scroll', () => {
    if (!ticking) {
      window.requestAnimationFrame(updateScrollSpy);
      ticking = true;
    }
  }, { passive: true });

  // 3. Lazy Video Clip Player
  const mediaItems = document.querySelectorAll('.media-playlist-item');
  const videoFrame = document.getElementById('videoPlayerFrame');
  const videoTag = document.getElementById('videoPlayerTag');
  const placeholder = document.getElementById('mediaPlaceholder');

  mediaItems.forEach((item) => {
    item.addEventListener('click', () => {
      const url = item.getAttribute('data-video-url');
      const isLocal = item.getAttribute('data-is-local') === 'true';

      mediaItems.forEach((el) => el.classList.remove('active'));
      item.classList.add('active');

      if (placeholder) placeholder.style.display = 'none';

      if (isLocal) {
        if (videoFrame) videoFrame.style.display = 'none';
        if (videoTag) {
          videoTag.style.display = 'block';
          videoTag.src = url;
          videoTag.play().catch(() => {});
        }
      } else {
        if (videoTag) {
          videoTag.pause();
          videoTag.style.display = 'none';
        }
        if (videoFrame) {
          videoFrame.style.display = 'block';
          videoFrame.src = url;
        }
      }
    });
  });

  // 4. Clean Instant Contact Form Handler
  const contactForm = document.getElementById('corpContactForm');
  const statusEl = document.getElementById('formStatusMsg');

  if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const name = document.getElementById('c_name').value.trim();
      const email = document.getElementById('c_email').value.trim();
      const message = document.getElementById('c_message').value.trim();

      if (!name || !email || !message) {
        if (statusEl) {
          statusEl.textContent = 'Please fill in all fields.';
          statusEl.className = 'form-status-msg error';
        }
        return;
      }

      if (statusEl) {
        statusEl.textContent = 'Sending...';
        statusEl.className = 'form-status-msg';
      }

      const formData = new FormData();
      formData.append('action', 'contact');
      formData.append('name', name);
      formData.append('email', email);
      formData.append('message', message);

      try {
        const res = await fetch('/api/index.php', {
          method: 'POST',
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
          body: formData,
        });
        const data = await res.json();
        if (data.status === 'success') {
          if (statusEl) {
            statusEl.textContent = data.message || 'Message received. Thank you!';
            statusEl.className = 'form-status-msg';
          }
          contactForm.reset();
        } else {
          if (statusEl) {
            statusEl.textContent = data.message || 'Could not send message.';
            statusEl.className = 'form-status-msg error';
          }
        }
      } catch {
        if (statusEl) {
          statusEl.textContent = 'Could not reach server. Please email dev@mphathisi.com directly.';
          statusEl.className = 'form-status-msg error';
        }
      }
    });
  }

  // 5. Light / Dark Theme Toggle
  const themeToggleBtn = document.getElementById('themeToggleBtn');
  const themeIcon = themeToggleBtn ? themeToggleBtn.querySelector('i') : null;

  const applyTheme = (mode) => {
    const isDark = mode === 'dark';
    document.body.classList.toggle('dark-theme', isDark);
    if (themeIcon) {
      themeIcon.className = isDark ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
    }
  };

  const savedTheme = localStorage.getItem('site-theme');
  if (savedTheme === 'dark' || savedTheme === 'light') {
    applyTheme(savedTheme);
  } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    applyTheme('dark');
  } else {
    applyTheme('light');
  }

  if (themeToggleBtn) {
    themeToggleBtn.addEventListener('click', () => {
      const next = document.body.classList.contains('dark-theme') ? 'light' : 'dark';
      localStorage.setItem('site-theme', next);
      applyTheme(next);
    });
  }
});
