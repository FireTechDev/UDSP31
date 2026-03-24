document.addEventListener("DOMContentLoaded", () => {
  const navToggle = document.querySelector(".nav-toggle");
  const navigation = document.querySelector(".site-navigation");
  const counters = document.querySelectorAll("[data-counter]");

  if (navToggle && navigation) {
    const closeNavigation = () => {
      navigation.classList.remove("is-open");
      navToggle.setAttribute("aria-expanded", "false");
      document.body.classList.remove("has-open-menu");
    };

    navToggle.addEventListener("click", () => {
      const isOpen = navigation.classList.toggle("is-open");
      navToggle.setAttribute("aria-expanded", String(isOpen));
      document.body.classList.toggle("has-open-menu", isOpen);
    });

    navigation.querySelectorAll("a").forEach((link) => {
      link.addEventListener("click", () => {
        closeNavigation();
      });
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") {
        closeNavigation();
      }
    });

    const desktopMedia = window.matchMedia("(min-width: 981px)");
    const syncNavigationState = (event) => {
      if (event.matches) {
        closeNavigation();
      }
    };

    syncNavigationState(desktopMedia);

    if ("addEventListener" in desktopMedia) {
      desktopMedia.addEventListener("change", syncNavigationState);
    } else if ("addListener" in desktopMedia) {
      desktopMedia.addListener(syncNavigationState);
    }
  }

  const animateCounter = (node) => {
    const target = Number(node.dataset.counter || 0);
    const suffix = node.dataset.suffix || "";
    const duration = 1200;
    const start = performance.now();

    const tick = (now) => {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const value = Math.round(target * eased);
      node.textContent = `${value.toLocaleString("fr-FR")}${suffix}`;

      if (progress < 1) {
        window.requestAnimationFrame(tick);
      }
    };

    window.requestAnimationFrame(tick);
  };

  if (!counters.length) {
    return;
  }

  if (!("IntersectionObserver" in window)) {
    counters.forEach((counter) => animateCounter(counter));
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) {
          return;
        }

        animateCounter(entry.target);
        observer.unobserve(entry.target);
      });
    },
    { threshold: 0.45 }
  );

  counters.forEach((counter) => observer.observe(counter));
});
