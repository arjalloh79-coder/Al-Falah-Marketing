/**
 * Al-Falah Marketing — Light / Dark theme toggle
 * Persists in localStorage key: alfalah-theme
 * Default: dark (brand design system)
 */
(function () {
  if (window.__alfalahTheme) return;
  window.__alfalahTheme = true;

  var KEY = 'alfalah-theme';

  function getTheme() {
    try {
      var t = localStorage.getItem(KEY);
      if (t === 'light' || t === 'dark') return t;
    } catch (e) {}
    return 'dark';
  }

  function apply(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    try { localStorage.setItem(KEY, theme); } catch (e) {}
    document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
      var isDark = theme === 'dark';
      btn.setAttribute('aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode');
      btn.setAttribute('title', isDark ? 'Light mode' : 'Dark mode');
      var sun = btn.querySelector('[data-icon="sun"]');
      var moon = btn.querySelector('[data-icon="moon"]');
      if (sun) sun.style.display = isDark ? 'none' : 'block';
      if (moon) moon.style.display = isDark ? 'block' : 'none';
    });
  }

  function toggle() {
    apply(getTheme() === 'dark' ? 'light' : 'dark');
  }

  apply(getTheme());

  function buildButton() {
    var btn = document.createElement('button');
    btn.type = 'button';
    btn.setAttribute('data-theme-toggle', '1');
    btn.className = 'theme-toggle-btn';
    btn.innerHTML =
      '<svg data-icon="sun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none">' +
        '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>' +
      '</svg>' +
      '<svg data-icon="moon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">' +
        '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>' +
      '</svg>';
    btn.addEventListener('click', toggle);
    return btn;
  }

  function inject() {
    var targets = document.querySelectorAll('.lang-switch');
    if (targets.length) {
      targets.forEach(function (el) {
        if (el.parentElement && !el.parentElement.querySelector('[data-theme-toggle]')) {
          el.parentElement.insertBefore(buildButton(), el.nextSibling);
        }
      });
    } else {
      var headerRight = document.querySelector('header .flex.items-center.gap-2, header .flex.items-center.gap-3');
      if (headerRight && !headerRight.querySelector('[data-theme-toggle]')) {
        headerRight.appendChild(buildButton());
      }
    }
    apply(getTheme());
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', inject);
  } else {
    inject();
  }

  window.alfalahSetTheme = apply;
})();
