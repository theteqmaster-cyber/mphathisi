(function () {
  'use strict';

  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (prefersReducedMotion) {
    document.body.classList.add('reduce-motion');
    return;
  }

  var cursorGlow = document.getElementById('hydraCursorGlow');
  if (!cursorGlow) return;

  var mouse = { x: 0, y: 0 };
  var glow = { x: 0, y: 0 };

  function lerp(a, b, t) {
    return a + (b - a) * t;
  }

  function updateGlow() {
    glow.x = lerp(glow.x, mouse.x, 0.08);
    glow.y = lerp(glow.y, mouse.y, 0.08);
    cursorGlow.style.left = glow.x + 'px';
    cursorGlow.style.top = glow.y + 'px';
    requestAnimationFrame(updateGlow);
  }
  requestAnimationFrame(updateGlow);

  document.addEventListener('mousemove', function (e) {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
  });

  cursorGlow.classList.add('ready');
  document.addEventListener('mouseleave', function () {
    cursorGlow.style.opacity = '0';
  });
  document.addEventListener('mouseenter', function () {
    cursorGlow.style.opacity = '1';
  });

  // Card border glow that follows mouse (different from main site tilt)
  var cards = document.querySelectorAll('[data-hydra-card]');
  cards.forEach(function (card) {
    card.addEventListener('mousemove', function (e) {
      var rect = card.getBoundingClientRect();
      var x = ((e.clientX - rect.left) / rect.width) * 100;
      var y = ((e.clientY - rect.top) / rect.height) * 100;
      card.style.setProperty('--mouse-x', x + '%');
      card.style.setProperty('--mouse-y', y + '%');
    });
    card.addEventListener('mouseleave', function () {
      card.style.removeProperty('--mouse-x');
      card.style.removeProperty('--mouse-y');
    });
  });
})();
