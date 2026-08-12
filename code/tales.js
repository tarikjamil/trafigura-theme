document.addEventListener("DOMContentLoaded", function () {
  const video = document.getElementById("hero-video");
  const videoSource = video.querySelector("source");
  const playBtn = document.querySelector(".tales--play");
  const arrows = document.querySelectorAll(".tales--arrow");
  let isVideoPlaying = true;
  let swiper;

  // Background motif updater
  function updateActiveMotif(index) {
    const motifs = document.querySelectorAll(".bg--motif");
    const realSlidesCount = motifs.length;
    const realIndex = index % realSlidesCount;
    motifs.forEach((motif, i) => {
      motif.classList.toggle("is--active", i === realIndex);
    });
  }

  // Observer to wait until CMS content is fully loaded
  const observer = new MutationObserver(() => {
    const slides = document.querySelectorAll(".swiper-slide");
    if (slides.length >= 3 && !swiper) {
      observer.disconnect();

      swiper = new Swiper(".swiper", {
        slidesPerView: "auto",
        spaceBetween: 20,
        loop: true,
        lazyPreloadPrevNext: 3,
        centeredSlides: false,
        watchSlidesProgress: true,

        on: {
          init: function () {
            updateHeroVideo(this.slides[this.activeIndex]);
            updateActiveMotif(this.realIndex);
          },
          slideChange: function () {
            updateActiveMotif(this.realIndex);
          },
          slideChangeTransitionStart: function () {
            fadeOutVideo();
          },
          slideChangeTransitionEnd: function () {
            updateHeroVideo(this.slides[this.activeIndex]);
          },
        },
      });
    }
  });

  observer.observe(document.body, { childList: true, subtree: true });

  // Arrows
  arrows.forEach((arrow) => {
    arrow.addEventListener("click", () => {
      if (!swiper) return;
      const dir = arrow.getAttribute("data-dir");
      if (dir === "next") swiper.slideNext();
      else swiper.slidePrev();
    });
  });

  // Video autoplay fix
  document.addEventListener(
    "click",
    () => {
      if (video.paused) {
        video
          .play()
          .catch((err) =>
            console.warn("Autoplay failed after user click:", err)
          );
      }
    },
    { once: true }
  );

  video.play().catch((err) => console.warn("Initial autoplay failed:", err));

  playBtn?.addEventListener("click", () => {
    if (video.paused) {
      video.play();
      isVideoPlaying = true;
    } else {
      video.pause();
      isVideoPlaying = false;
    }
  });

  function fadeOutVideo() {
    video.style.opacity = 0;
    video.muted = true;
  }

  function updateHeroVideo(activeSlide) {
    const videoDiv = activeSlide.querySelector(".tales--video-swiper");
    if (!videoDiv) return;
    const videoUrl = videoDiv.textContent.trim();
    if (!videoUrl) return;

    videoSource.src = videoUrl;
    video.load();

    video.oncanplay = () => {
      video.style.opacity = 1;
      video.muted = false;
      if (isVideoPlaying) video.play();
    };
  }
});
