/* =============================================================
   Melbourne Madinah — SHARED HELPERS
   - Mobile nav toggle (accessible)
   - prefers-reduced-motion helper exposed as window.MM.reduceMotion
   Keep this tiny: it loads on every page.
   ============================================================= */
(function () {
  "use strict";

  /* ---- Reduced-motion helper (used by each hero's animation) ---- */
  var mq = window.matchMedia("(prefers-reduced-motion: reduce)");
  window.MM = window.MM || {};
  window.MM.reduceMotion = function () { return mq.matches; };

  /* ---- Mobile nav ---- */
  function initNav() {
    var toggle = document.querySelector(".nav-toggle");
    var nav = document.getElementById("primary-nav");
    if (!toggle || !nav) return;

    function close() {
      nav.classList.remove("open");
      toggle.setAttribute("aria-expanded", "false");
    }
    function open() {
      nav.classList.add("open");
      toggle.setAttribute("aria-expanded", "true");
    }

    toggle.addEventListener("click", function () {
      var expanded = toggle.getAttribute("aria-expanded") === "true";
      expanded ? close() : open();
    });

    /* Close after choosing a link (mobile) */
    nav.addEventListener("click", function (e) {
      if (e.target.closest("a")) close();
    });

    /* Close on Escape + return focus to toggle */
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && nav.classList.contains("open")) {
        close();
        toggle.focus();
      }
    });

    /* Reset menu state if resized back to desktop */
    window.matchMedia("(min-width: 861px)").addEventListener("change", function (ev) {
      if (ev.matches) close();
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initNav);
  } else {
    initNav();
  }
})();
