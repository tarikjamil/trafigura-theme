function pageLoad() {
  let e = gsap.timeline();
  // Do not hide .main-wrapper until JS — that delayed FCP/LCP (blank filmstrip).
  e.from(
      "[animation=loading]",
      {
        y: "20rem",
        opacity: "0",
        stagger: { each: 0.1, from: "start" },
        ease: "smooth",
        duration: 0.6,
      },
      "loadingAnimationsStart"
    );
}
gsap.registerPlugin(ScrollTrigger, CustomEase),
  CustomEase.create("smooth", "M0,0 C0.38,0.005 0.215,1 1,1"),
  pageLoad(),
  gsap.to(".portfolio--row:nth-child(2)", {
    x: "20vw",
    scrollTrigger: {
      trigger: ".section.is--portfolio--rows",
      start: "top bottom",
      end: "bottom top",
      scrub: !0,
    },
  }),
  document.querySelectorAll("[animation=fade]").forEach(function (e) {
    gsap.from(e, {
      scrollTrigger: { trigger: e, start: "top bottom-=50", markers: !1 },
      y: "20rem",
      opacity: 0,
      ease: "smooth",
      duration: 0.6,
    });
  }),
  document.querySelectorAll("[animation=fadefromleft]").forEach(function (e) {
    gsap.from(e, {
      scrollTrigger: { trigger: e, start: "top bottom-=50", markers: !1 },
      x: "-20rem",
      opacity: 0,
      ease: "smooth",
      duration: 0.6,
    });
  }),
  document.querySelectorAll("[animation=fadefromright]").forEach(function (e) {
    gsap.from(e, {
      scrollTrigger: { trigger: e, start: "top bottom-=50", markers: !1 },
      x: "20rem",
      opacity: 0,
      ease: "smooth",
      duration: 0.6,
    });
  }),
  document.querySelectorAll('[animation="parallax-parent"]').forEach((e) => {
    let t = e.querySelector('[animation="parallax-top"]'),
      r = e.querySelector('[animation="parallax-bottom"]');
    gsap.fromTo(
      t,
      { y: "-20%" },
      {
        y: "20%",
        scrollTrigger: {
          trigger: e,
          start: "top bottom",
          end: "bottom top",
          scrub: !0,
        },
      }
    ),
      gsap.fromTo(
        r,
        { y: "20%" },
        {
          y: "-20%",
          scrollTrigger: {
            trigger: e,
            start: "top bottom",
            end: "bottom top",
            scrub: !0,
          },
        }
      );
  }),
  jQuery(document).ready(function (e) {
    function t(t, r) {
      let o = t.siblings(".navbar--dropdown--list");
      if ((console.log("Toggle content:", r ? "Closing" : "Opening", o), r))
        o.animate({ height: "0px" }, 500, function () {
          e(this).css("height", "0px").removeClass("is--active"),
            t.data("animating", !1);
        });
      else {
        let i = o.css("height", "auto").height();
        o.height("0px"),
          o.animate({ height: i + "px" }, 500, function () {
            e(this).css("height", "auto").addClass("is--active"),
              t.data("animating", !1);
          });
      }
    }
    console.log("Dropdown script initialized."),
      e(document).on("click", ".navbar--dropdown-trigger", function () {
        let r = e(this);
        r.data("animating") ||
          (r.data("animating", !0),
          (function r(o) {
            let i = o.hasClass("open");
            console.log("Toggling dropdown:", i ? "Closing" : "Opening"),
              e(".navbar--dropdown-trigger.open")
                .not(o)
                .each(function () {
                  t(e(this), !0), e(this).removeClass("open");
                }),
              t(o, i),
              o.toggleClass("open", !i);
          })(r));
      });
    let r = new MutationObserver(function (t) {
      t.forEach((t) => {
        "childList" === t.type &&
          t.addedNodes.length > 0 &&
          (console.log("MutationObserver: Child added."),
          setTimeout(function () {
            console.log(
              "Refreshing dropdown logic for dynamic content after a slight delay."
            ),
              e(".navbar--dropdown-trigger").each(function () {
                let t = e(this),
                  r = t
                    .siblings(".navbar--dropdown--list")
                    .find(".navlink.w--current").length;
                console.log(
                  "Found " +
                    r +
                    " .navlink.w--current elements within dropdown."
                ),
                  r > 0 &&
                    !t.hasClass("open") &&
                    (console.log(
                      "Automatically opening a dropdown for dynamic content."
                    ),
                    t.click());
              });
          }, 500));
      });
    });
    r.observe(document.body, { childList: !0, subtree: !0 });
  }),
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".team-item").forEach((e) => {
      e.addEventListener("click", function () {
        var e = this.querySelector(".richtext--team");
        if (e) {
          var t = e.cloneNode(!0),
            r = document.querySelector(".is--team-content-toreset");
          if (r) {
            for (; r.firstChild; ) r.removeChild(r.firstChild);
            r.appendChild(t);
          }
        }
      });
    });
  }),
  document.addEventListener("DOMContentLoaded", (e) => {
    function t(e) {
      return isNaN(e.getTime())
        ? (console.error("Invalid Date created from input:", e), "Invalid date")
        : `${("0" + e.getDate()).slice(-2)} ${
            [
              "January",
              "February",
              "March",
              "April",
              "May",
              "June",
              "July",
              "August",
              "September",
              "October",
              "November",
              "December",
            ][e.getMonth()]
          } ${e.getFullYear()}`;
    }
    let r = document.querySelectorAll(".text-date");
    const n = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    r.forEach((e) => {
      let r = e.textContent.trim();
      console.log("Original date text:", r);
      const a = n.some(e => r.includes(e));
      if (a) {
        console.log("Date already formatted, skipping:", r);
        return;
      }
      let o = r.split("/");
      if (3 !== o.length) {
        console.error("Incorrect date format:", r),
          (e.textContent = "Incorrect date format");
        return;
      }
      let i = new Date(o[2], o[0] - 1, o[1]);
      e.textContent = t(i);
    });
  }),
  document.addEventListener("DOMContentLoaded", () => {
    const y = new Date().getFullYear();
    document
      .querySelectorAll(".text-copyright, .nav--contact .text-10")
      .forEach((el) => {
        el.textContent = el.textContent.replace(/\b20\d{2}\b/g, String(y));
      });
  }),
  $(".is--gallery-slider").append(`
    <div class="swiper-arrows">
    <a href="/partners-stories" class="swiper-button-prev is--shadow w-inline-block"><svg class="icon-arrow" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 17.589 13.87"><path id="Trac\xe9_54632" data-name="Trac\xe9 54632" d="M8.769,0V3.97H0V9.9H8.769v3.97l8.819-6.935Z" transform="translate(17.588 13.87) rotate(180)" fill="currentColor"></path></svg></a>

    <a href="/partners-stories" class="swiper-button-next is--shadow w-inline-block"><svg class="icon-arrow" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 17.589 13.87"><path id="Trac\xe9_42314" data-name="Trac\xe9 42314" d="M8.769,0V3.97H0V9.9H8.769v3.97l8.819-6.935Z" transform="translate(0 0)" fill="currentColor"></path></svg></a>
    </div>
`);
if (typeof Swiper !== "undefined") {
  new Swiper(".is--slider-resources", {
    direction: "horizontal",
    slidesPerView: 1,
    slidesPerGroup: 1,
    spaceBetween: "20rem",
    loop: !1,
    centeredSlides: !1,
    breakpoints: { 992: { slidesPerView: 1, spaceBetween: "20rem" } },
  });
  new Swiper(".is--circles-slider", {
    direction: "horizontal",
    slidesPerView: 3,
    slidesPerGroup: 1,
    spaceBetween: "120rem",
    loop: !1,
    centeredSlides: !1,
    breakpoints: { 992: { slidesPerView: 1, spaceBetween: "20rem" } },
  });
  document.querySelectorAll(".is--gallery-slider").forEach(function (el) {
    var captionEl =
      el.parentElement &&
      el.parentElement.querySelector(".gallery-slide-caption");
    if (!captionEl) {
      var section = el.closest("section");
      captionEl = section && section.querySelector(".gallery-slide-caption");
    }
    function syncCaption(swiper) {
      if (!captionEl) return;
      var slide = swiper.slides[swiper.activeIndex];
      var text =
        (slide && slide.getAttribute("data-caption")) ||
        captionEl.getAttribute("data-fallback") ||
        "";
      captionEl.textContent = text;
    }
    new Swiper(el, {
      direction: "horizontal",
      slidesPerView: 1,
      slidesPerGroup: 1,
      spaceBetween: "20rem",
      loop: !1,
      centeredSlides: !1,
      effect: "cards",
      grabCursor: !0,
      cardsEffect: { rotate: !1 },
      breakpoints: { 992: { slidesPerView: 1, spaceBetween: "20rem" } },
      navigation: {
        nextEl: el.querySelector(".swiper-button-next"),
        prevEl: el.querySelector(".swiper-button-prev"),
      },
      on: {
        init: syncCaption,
        slideChange: syncCaption,
      },
    });
  });
}
