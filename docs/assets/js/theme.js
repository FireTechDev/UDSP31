document.addEventListener("DOMContentLoaded", () => {
  const navToggle = document.querySelector(".nav-toggle");
  const navigation = document.querySelector(".site-navigation");
  const siteHeader = document.querySelector(".site-header");
  const heroCarousel = document.querySelector("[data-hero-carousel]");
  const counters = document.querySelectorAll("[data-counter]");

  if (navToggle && navigation) {
    const desktopMedia = window.matchMedia("(min-width: 981px)");
    const updateMobileNavOffset = () => {
      if (!siteHeader) {
        return;
      }

      const headerBottom = Math.max(0, Math.round(siteHeader.getBoundingClientRect().bottom));
      document.documentElement.style.setProperty("--udsp-mobile-nav-offset", `${headerBottom + 8}px`);
    };

    const closeNavigation = () => {
      navigation.classList.remove("is-open");
      navToggle.setAttribute("aria-expanded", "false");
      document.body.classList.remove("has-open-menu");
    };

    navToggle.addEventListener("click", () => {
      updateMobileNavOffset();
      const isOpen = navigation.classList.toggle("is-open");
      navToggle.setAttribute("aria-expanded", String(isOpen));
      document.body.classList.toggle("has-open-menu", isOpen);
      if (isOpen) {
        navigation.scrollTop = 0;
      }
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

    const syncNavigationState = (event) => {
      if (event.matches) {
        closeNavigation();
      }
    };

    updateMobileNavOffset();
    syncNavigationState(desktopMedia);
    window.addEventListener("resize", updateMobileNavOffset, { passive: true });

    if ("addEventListener" in desktopMedia) {
      desktopMedia.addEventListener("change", syncNavigationState);
    } else if ("addListener" in desktopMedia) {
      desktopMedia.addListener(syncNavigationState);
    }
  }

  if (heroCarousel) {
    const slides = Array.from(heroCarousel.querySelectorAll("[data-hero-slide]"));
    const dots = Array.from(heroCarousel.querySelectorAll("[data-hero-dot]"));
    const prevButton = heroCarousel.querySelector("[data-hero-prev]");
    const nextButton = heroCarousel.querySelector("[data-hero-next]");
    const reducedMotionMedia = window.matchMedia("(prefers-reduced-motion: reduce)");
    const interval = Number(heroCarousel.dataset.heroInterval || 6500);
    const slideFadeDuration = 1200;
    const slideExitTimers = new WeakMap();
    let activeIndex = Math.max(
      0,
      slides.findIndex((slide) => slide.classList.contains("is-active"))
    );
    let autoplayId = 0;

    const setActiveSlide = (nextIndex) => {
      activeIndex = (nextIndex + slides.length) % slides.length;

      slides.forEach((slide, index) => {
        const isActive = index === activeIndex;
        const wasActive = slide.classList.contains("is-active");
        const exitTimer = slideExitTimers.get(slide);

        if (exitTimer) {
          window.clearTimeout(exitTimer);
          slideExitTimers.delete(slide);
        }

        if (isActive) {
          slide.classList.add("is-active");
          slide.classList.remove("is-leaving");
          return;
        }

        slide.classList.remove("is-active");

        if (wasActive && !reducedMotionMedia.matches) {
          slide.classList.add("is-leaving");

          const timerId = window.setTimeout(() => {
            slide.classList.remove("is-leaving");
            slideExitTimers.delete(slide);
          }, slideFadeDuration);

          slideExitTimers.set(slide, timerId);
          return;
        }

        slide.classList.remove("is-leaving");
      });

      dots.forEach((dot, index) => {
        const isActive = index === activeIndex;
        dot.classList.toggle("is-active", isActive);
        dot.setAttribute("aria-pressed", String(isActive));
      });
    };

    const stopAutoplay = () => {
      if (autoplayId) {
        window.clearInterval(autoplayId);
        autoplayId = 0;
      }
    };

    const startAutoplay = () => {
      stopAutoplay();

      if (slides.length < 2 || reducedMotionMedia.matches) {
        return;
      }

      autoplayId = window.setInterval(() => {
        setActiveSlide(activeIndex + 1);
      }, interval);
    };

    dots.forEach((dot, index) => {
      dot.addEventListener("click", () => {
        setActiveSlide(index);
        startAutoplay();
      });
    });

    if (prevButton) {
      prevButton.addEventListener("click", () => {
        setActiveSlide(activeIndex - 1);
        startAutoplay();
      });
    }

    if (nextButton) {
      nextButton.addEventListener("click", () => {
        setActiveSlide(activeIndex + 1);
        startAutoplay();
      });
    }

    heroCarousel.addEventListener("pointerenter", stopAutoplay);
    heroCarousel.addEventListener("pointerleave", startAutoplay);
    heroCarousel.addEventListener("focusin", stopAutoplay);
    heroCarousel.addEventListener("focusout", (event) => {
      if (!heroCarousel.contains(event.relatedTarget)) {
        startAutoplay();
      }
    });

    const syncAutoplay = () => {
      startAutoplay();
    };

    setActiveSlide(activeIndex);
    syncAutoplay();

    if ("addEventListener" in reducedMotionMedia) {
      reducedMotionMedia.addEventListener("change", syncAutoplay);
    } else if ("addListener" in reducedMotionMedia) {
      reducedMotionMedia.addListener(syncAutoplay);
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
