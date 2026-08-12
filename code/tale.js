document.addEventListener("DOMContentLoaded", function () {
  const heroVideo = document.getElementById("hero-video");
  const videoSource = heroVideo.querySelector("source");
  const videoWrapper = document.querySelector(".tales--video-swiper");
  const playButton = document.querySelector(".tales--play");
  const playIcon = document.querySelector(".tales--play-play");
  const pauseIcon = document.querySelector(".tales--play-pause");

  // 1. Set the video source from the .tales--video-swiper div
  if (videoWrapper && videoSource) {
    const videoURL = videoWrapper.textContent.trim();
    videoSource.src = videoURL;
    heroVideo.load();

    // 2. Once the video is ready, fade it in and play it
    heroVideo.addEventListener("loadeddata", function () {
      heroVideo.style.opacity = "1";
      heroVideo.play();
    });
  }

  // 3. Toggle icons based on video state
  function updateIcons() {
    if (heroVideo.paused) {
      playIcon.style.display = "block";
      pauseIcon.style.display = "none";
    } else {
      playIcon.style.display = "none";
      pauseIcon.style.display = "block";
    }
  }

  // 4. Add play/pause toggle functionality
  playButton?.addEventListener("click", function () {
    if (heroVideo.paused) {
      heroVideo.play();
    } else {
      heroVideo.pause();
    }
    updateIcons();
  });

  // 5. Update icons when play/pause happens via other methods
  heroVideo.addEventListener("play", updateIcons);
  heroVideo.addEventListener("pause", updateIcons);
});

// -------------- impact -------------- //

document.addEventListener("DOMContentLoaded", function () {
  const groups = [
    { selector: ".tale--impact-content", rowClass: "tale--impact-row" },
    { selector: ".richtext--core-pillars", rowClass: "tale--pillar-row" },
  ];

  groups.forEach(({ selector, rowClass }) => {
    const sections = document.querySelectorAll(selector);

    sections.forEach((section) => {
      const children = Array.from(section.children);
      const newContent = [];

      let i = 0;
      while (i < children.length) {
        const current = children[i];

        if (current.tagName === "H3") {
          const wrapper = document.createElement("div");
          wrapper.classList.add(rowClass);

          // Move <h3> into wrapper
          wrapper.appendChild(current);
          i++;

          // Move following <p> elements
          while (i < children.length && children[i].tagName === "P") {
            wrapper.appendChild(children[i]);
            i++;
          }

          newContent.push(wrapper);
        } else {
          i++;
        }
      }

      // Clear section and append rebuilt content
      section.innerHTML = "";
      newContent.forEach((row) => section.appendChild(row));
    });
  });
});
