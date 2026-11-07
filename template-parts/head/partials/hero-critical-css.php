<style id="hero-critical">
  /* Critical hero layout — paint LCP image before trafigura-bundle.css */
  .section.is--hero {
    position: relative;
  }
  .hero-image-wrapper {
    aspect-ratio: 1440 / 634;
    width: 100%;
    position: absolute;
    inset: 0 auto auto 0;
  }
  .img--absolute {
    object-fit: cover;
    width: 100%;
    height: 100%;
    position: absolute;
    inset: auto auto 0% 0%;
  }
  @media screen and (max-width: 991px) {
    .hero-image-wrapper {
      aspect-ratio: 390 / 510;
    }
  }
</style>
