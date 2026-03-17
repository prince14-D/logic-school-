document.addEventListener("DOMContentLoaded", function () {
  initActiveNav();
  initRevealAnimation();
  initAdmissionCountdown();
  initContactToggle();
  initGalleryFilter();
  initGalleryLightbox();
  initBackToTop();
});

function initActiveNav() {
  const path = window.location.pathname.split("/").pop() || "index.php";
  document.querySelectorAll(".navbar .nav-link").forEach((link) => {
    const href = link.getAttribute("href");
    if (href === path) {
      link.classList.add("active");
    }
  });
}

function initRevealAnimation() {
  const animated = document.querySelectorAll("[data-animate]");
  if (!animated.length) return;

  const observer = new IntersectionObserver(
    (entries, revealObserver) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-visible");
        revealObserver.unobserve(entry.target);
      });
    },
    { threshold: 0.12 }
  );

  animated.forEach((element) => observer.observe(element));
}

function initAdmissionCountdown() {
  const wrap = document.getElementById("countdown");
  const daysEl = document.getElementById("days");
  const hoursEl = document.getElementById("hours");
  const minutesEl = document.getElementById("minutes");
  const secondsEl = document.getElementById("seconds");

  if (!wrap || !daysEl || !hoursEl || !minutesEl || !secondsEl) return;

  const deadlineText = wrap.dataset.deadline || "2026-09-30T23:59:59";
  const deadline = new Date(deadlineText).getTime();
  if (Number.isNaN(deadline)) return;

  const tick = () => {
    const now = Date.now();
    const distance = deadline - now;

    if (distance <= 0) {
      wrap.innerHTML = "<h5 class=\"mb-0\">Admissions Closed</h5>";
      return;
    }

    daysEl.textContent = String(Math.floor(distance / (1000 * 60 * 60 * 24)));
    hoursEl.textContent = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, "0");
    minutesEl.textContent = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, "0");
    secondsEl.textContent = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, "0");
  };

  tick();
  setInterval(tick, 1000);
}

function initContactToggle() {
  const toggles = document.querySelectorAll(".contact-toggle");
  if (!toggles.length) return;

  toggles.forEach((toggle) => {
    toggle.addEventListener("click", function (event) {
      event.stopPropagation();
      const host = toggle.closest(".contact-float");
      if (!host) return;
      const options = host.querySelector(".contact-options");
      if (options) options.classList.toggle("show");
    });
  });

  document.addEventListener("click", function (event) {
    document.querySelectorAll(".contact-float .contact-options.show").forEach((options) => {
      const host = options.closest(".contact-float");
      if (host && !host.contains(event.target)) {
        options.classList.remove("show");
      }
    });
  });
}

function initGalleryFilter() {
  const buttons = document.querySelectorAll(".filter-btn");
  const items = document.querySelectorAll(".gallery-item");
  if (!buttons.length || !items.length) return;

  buttons.forEach((button) => {
    button.addEventListener("click", function () {
      const filter = button.dataset.filter || "all";

      buttons.forEach((entry) => entry.classList.remove("active"));
      button.classList.add("active");

      items.forEach((item) => {
        const show = filter === "all" || item.classList.contains(filter);
        item.style.display = show ? "block" : "none";
      });
    });
  });
}

function initGalleryLightbox() {
  const modalElement = document.getElementById("lightboxModal");
  const output = document.getElementById("lightboxImage");
  const images = document.querySelectorAll(".gallery-img");

  if (!modalElement || !output || !images.length || typeof bootstrap === "undefined") return;

  const modal = new bootstrap.Modal(modalElement);

  images.forEach((image) => {
    image.addEventListener("click", function () {
      output.src = image.src;
      output.alt = image.alt || "Gallery Image";
      modal.show();
    });
  });
}

function initBackToTop() {
  const button = document.getElementById("backToTop");
  if (!button) return;

  const onScroll = () => {
    const shouldShow = window.scrollY > 260;
    button.classList.toggle("is-visible", shouldShow);
  };

  button.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  onScroll();
  window.addEventListener("scroll", onScroll);
}