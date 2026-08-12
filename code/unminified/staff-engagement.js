document.addEventListener("DOMContentLoaded", function () {
  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.play();
        } else {
          entry.target.pause();
        }
      });
    },
    {
      threshold: 0.5, // Triggers when 50% of the video is visible
    }
  );

  var videos = document.querySelectorAll("video");
  videos.forEach(function (video) {
    observer.observe(video);
  });
});
