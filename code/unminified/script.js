// ------------------ gsap ------------------ //

gsap.registerPlugin(ScrollTrigger, CustomEase);

// ------------------ smooth ease ------------------ //

CustomEase.create("smooth", "M0,0 C0.38,0.005 0.215,1 1,1");

// ------------------ loading ------------------ //
function pageLoad() {
  let tl = gsap.timeline();

  // Content stays visible for FCP — only animate [animation=loading] elements.
  tl.from(
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

pageLoad();

// ------------------ animations on page ------------------ //
gsap.to(".portfolio--row:nth-child(2)", {
  x: "20vw", // Target scale
  scrollTrigger: {
    trigger: ".section.is--portfolio--rows",
    start: "top bottom",
    end: "bottom top",
    scrub: true,
  },
});

document.querySelectorAll("[animation=fade]").forEach(function (fadeSplitElem) {
  gsap.from(fadeSplitElem, {
    scrollTrigger: {
      trigger: fadeSplitElem,
      start: "top bottom-=50",
      markers: false,
    },
    y: "20rem",
    opacity: 0,
    ease: "smooth",
    duration: 0.6,
  });
});

document
  .querySelectorAll(
    ".tale--impact-content *, .padding-tale-challenge *, .richtext--core-pillars *"
  )
  .forEach(function (fadeSplitElem) {
    gsap.from(fadeSplitElem, {
      scrollTrigger: {
        trigger: fadeSplitElem,
        start: "top bottom-=50",
        markers: false,
      },
      y: "20rem",
      opacity: 0,
      ease: "smooth",
      duration: 0.6,
    });
  });

document
  .querySelectorAll("[animation=fadefromleft]")
  .forEach(function (fadeSplitElem) {
    gsap.from(fadeSplitElem, {
      scrollTrigger: {
        trigger: fadeSplitElem,
        start: "top bottom-=50",
        markers: false,
      },
      x: "-20rem",
      opacity: 0,
      ease: "smooth",
      duration: 0.6,
    });
  });

document
  .querySelectorAll("[animation=fadefromright]")
  .forEach(function (fadeSplitElem) {
    gsap.from(fadeSplitElem, {
      scrollTrigger: {
        trigger: fadeSplitElem,
        start: "top bottom-=50",
        markers: false,
      },
      x: "20rem",
      opacity: 0,
      ease: "smooth",
      duration: 0.6,
    });
  });

document.querySelectorAll('[animation="parallax-parent"]').forEach((parent) => {
  const top = parent.querySelector('[animation="parallax-top"]');
  const bottom = parent.querySelector('[animation="parallax-bottom"]');

  gsap.fromTo(
    top,
    {
      y: "-20%",
    },
    {
      y: "20%",
      scrollTrigger: {
        trigger: parent,
        start: "top bottom", // when the top of the parent hits the bottom of the viewport
        end: "bottom top", // when the bottom of the parent leaves the top of the viewport
        scrub: true,
      },
    }
  );

  gsap.fromTo(
    bottom,
    {
      y: "20%",
    },
    {
      y: "-20%",
      scrollTrigger: {
        trigger: parent,
        start: "top bottom",
        end: "bottom top",
        scrub: true,
      },
    }
  );
});
// ------------------ navbar - accordion ------------------ //

jQuery(document).ready(function ($) {
  console.log("Dropdown script initialized.");

  function toggleDropdown($trigger) {
    const isOpen = $trigger.hasClass("open");
    console.log("Toggling dropdown:", isOpen ? "Closing" : "Opening");

    $(".navbar--dropdown-trigger.open")
      .not($trigger)
      .each(function () {
        toggleContent($(this), true);
        $(this).removeClass("open");
      });

    toggleContent($trigger, isOpen);
    $trigger.toggleClass("open", !isOpen);
  }

  function toggleContent($trigger, isOpen) {
    const $sibling = $trigger.siblings(".navbar--dropdown--list");
    console.log("Toggle content:", isOpen ? "Closing" : "Opening", $sibling);

    if (isOpen) {
      $sibling.animate({ height: "0px" }, 500, function () {
        $(this).css("height", "0px").removeClass("is--active");
        $trigger.data("animating", false);
      });
    } else {
      const autoHeight = $sibling.css("height", "auto").height();
      $sibling.height("0px");
      $sibling.animate({ height: autoHeight + "px" }, 500, function () {
        $(this).css("height", "auto").addClass("is--active");
        $trigger.data("animating", false);
      });
    }
  }

  $(document).on("click", ".navbar--dropdown-trigger", function () {
    const $trigger = $(this);
    if (!$trigger.data("animating")) {
      $trigger.data("animating", true);
      toggleDropdown($trigger);
    }
  });

  function initializeOrRefreshDropdownLogic() {
    // Introduce a slight delay to allow for external processes to complete
    setTimeout(function () {
      console.log(
        "Refreshing dropdown logic for dynamic content after a slight delay."
      );
      $(".navbar--dropdown-trigger").each(function () {
        const $trigger = $(this);
        const currentLinks = $trigger
          .siblings(".navbar--dropdown--list")
          .find(".navlink.w--current").length;
        console.log(
          "Found " +
            currentLinks +
            " .navlink.w--current elements within dropdown."
        );

        // Only trigger a click on dropdown triggers that contain a .navlink.w--current
        if (currentLinks > 0 && !$trigger.hasClass("open")) {
          console.log("Automatically opening a dropdown for dynamic content.");
          $trigger.click();
        }
      });
    }, 500); // Adjust this delay as needed
  }

  const observer = new MutationObserver(function (mutations) {
    mutations.forEach((mutation) => {
      if (mutation.type === "childList" && mutation.addedNodes.length > 0) {
        console.log("MutationObserver: Child added.");
        initializeOrRefreshDropdownLogic();
      }
    });
  });

  observer.observe(document.body, { childList: true, subtree: true });
});

// ------------------ team item click ------------------ //
document.addEventListener("DOMContentLoaded", function () {
  // Listen for clicks on elements with the class 'team-item'
  document.querySelectorAll(".team-item").forEach((item) => {
    item.addEventListener("click", function () {
      // Find the child element with class 'richtext--team'
      var richtextTeam = this.querySelector(".richtext--team");

      // Ensure richtextTeam exists
      if (richtextTeam) {
        // Clone the 'richtext--team' element
        var clone = richtextTeam.cloneNode(true);

        // Find the element with class 'is--team-content-toreset'
        var contentToReset = document.querySelector(
          ".is--team-content-toreset"
        );

        if (contentToReset) {
          // Remove all children from 'is--team-content-toreset'
          while (contentToReset.firstChild) {
            contentToReset.removeChild(contentToReset.firstChild);
          }

          // Append the cloned 'richtext--team' element
          contentToReset.appendChild(clone);
        }
      }
    });
  });
});

// ------------------ date format ------------------ //

document.addEventListener("DOMContentLoaded", (event) => {
  // Function to format the date into "DD Month YYYY"
  function formatDate(d) {
    if (isNaN(d.getTime())) {
      // Check if the date object is valid
      console.error("Invalid Date created from input:", d);
      return "Invalid date"; // Handle invalid dates
    }

    const months = [
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
    ];
    return `${("0" + d.getDate()).slice(-2)} ${
      months[d.getMonth()]
    } ${d.getFullYear()}`;
  }

  // Find all elements with the class 'text-date'
  const dateElements = document.querySelectorAll(".text-date");

  dateElements.forEach((element) => {
    const rawDate = element.textContent.trim();
    console.log("Original date text:", rawDate); // Debugging output
    
    // Check if date is already in formatted format (e.g., "February 10, 2026")
    // If it contains a month name, skip formatting
    const monthNames = ["January", "February", "March", "April", "May", "June", 
                       "July", "August", "September", "October", "November", "December"];
    const isAlreadyFormatted = monthNames.some(month => rawDate.includes(month));
    
    if (isAlreadyFormatted) {
      console.log("Date already formatted, skipping:", rawDate);
      return; // Skip formatting, date is already in correct format
    }
    
    // Parse the date assuming the format "M/DD/YYYY"
    const dateParts = rawDate.split("/");
    if (dateParts.length !== 3) {
      console.error("Incorrect date format:", rawDate);
      element.textContent = "Incorrect date format"; // Error handling
      return;
    }
    // Create a new Date object from the parsed components
    const dateObject = new Date(dateParts[2], dateParts[0] - 1, dateParts[1]);
    element.textContent = formatDate(dateObject);
  });
});

// ------------------ copyright year update ------------------ //

document.addEventListener("DOMContentLoaded", () => {
  const currentYear = new Date().getFullYear();
  const copyrightSelector = ".text-copyright, .nav--contact .text-10";

  document.querySelectorAll(copyrightSelector).forEach((element) => {
    element.textContent = element.textContent.replace(/\b20\d{2}\b/g, String(currentYear));
  });
});

// ------------------ tags color change ------------------ //
//
// $(document).ready(function () {
//   $(".tag-category > div").each(function () {
//     var text = $(this).text().trim();
//     if (text === "News") {
//       $(this).parent().css("background-color", "#7563AD");
//     } else if (text === "Insight") {
//       $(this).parent().css("background-color", "#00ACD7");
//     }
//   });
// });

// ------------------ Swiper ------------------ //

$(".is--gallery-slider").append(`
    <div class="swiper-arrows">
    <a href="/partners-stories" class="swiper-button-prev is--shadow w-inline-block"><svg class="icon-arrow" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 17.589 13.87"><path id="Tracé_54632" data-name="Tracé 54632" d="M8.769,0V3.97H0V9.9H8.769v3.97l8.819-6.935Z" transform="translate(17.588 13.87) rotate(180)" fill="currentColor"></path></svg></a>

    <a href="/partners-stories" class="swiper-button-next is--shadow w-inline-block"><svg class="icon-arrow" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 17.589 13.87"><path id="Tracé_42314" data-name="Tracé 42314" d="M8.769,0V3.97H0V9.9H8.769v3.97l8.819-6.935Z" transform="translate(0 0)" fill="currentColor"></path></svg></a>
    </div>
`);

const swiper = new Swiper(".is--slider-resources", {
  direction: "horizontal",
  slidesPerView: 1, // Default to 1 slide per view for mobile and smaller viewports
  slidesPerGroup: 1,
  spaceBetween: "20rem",
  loop: false,
  centeredSlides: false,
  // If we need pagination
  // Define breakpoints
  breakpoints: {
    // When window width is >= 992px
    992: {
      slidesPerView: 1,
      spaceBetween: "20rem",
    },
  },
});

const swiper2 = new Swiper(".is--circles-slider", {
  direction: "horizontal",
  slidesPerView: 3, // Default to 1 slide per view for mobile and smaller viewports
  slidesPerGroup: 1,
  spaceBetween: "120rem",
  loop: false,
  centeredSlides: false,
  // Define breakpoints
  breakpoints: {
    // When window width is >= 992px
    992: {
      slidesPerView: 1,
      spaceBetween: "20rem",
    },
  },
  // Navigation arrows
});

const swiper3Instances = document.querySelectorAll(".is--gallery-slider");
swiper3Instances.forEach(function (el) {
  var captionEl =
    (el.parentElement &&
      el.parentElement.querySelector(".gallery-slide-caption")) ||
    (el.closest("section") &&
      el.closest("section").querySelector(".gallery-slide-caption"));

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
    slidesPerView: 1, // Default to 1 slide per view for mobile and smaller viewports
    slidesPerGroup: 1,
    spaceBetween: "20rem",
    loop: false,
    centeredSlides: false,
    effect: "cards",
    grabCursor: true,
    cardsEffect: {
      rotate: false,
    },

    // If we need pagination
    // Define breakpoints
    breakpoints: {
      // When window width is >= 992px
      992: {
        slidesPerView: 1,
        spaceBetween: "20rem",
      },
    },
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
