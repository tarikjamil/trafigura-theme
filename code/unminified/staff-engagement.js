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
      threshold: 0.5,
    }
  );

  document.querySelectorAll("video:not(.voice--popup-video)").forEach(function (video) {
    observer.observe(video);
  });

  buildStaffContinents();
  initVoiceVideoPopup();
});

var STAFF_SKIP_ATTRS = {
  src: 1,
  srcset: 1,
  alt: 1,
  loading: 1,
  sizes: 1,
  class: 1,
  id: 1,
  style: 1,
  width: 1,
  height: 1,
  decoding: 1,
  fetchpriority: 1,
  role: 1,
  draggable: 1,
  tabindex: 1,
  hidden: 1,
};

function buildStaffContinents() {
  var grid = document.querySelector(".div-block-13");
  var list = document.querySelector(".collection-list-wrapper-3");
  if (!grid || !list) return;

  var items = Array.from(list.querySelectorAll(".w-dyn-item"));
  var groups = [];
  var groupByContinent = {};

  items.forEach(function (item) {
    var entry = readStaffEntry(item);
    if (!entry || !entry.city) return;

    var key = entry.continent.toLowerCase();
    if (!groupByContinent[key]) {
      groupByContinent[key] = {
        continent: entry.continent || "Other",
        cities: [],
      };
      groups.push(groupByContinent[key]);
    }
    groupByContinent[key].cities.push(entry);
  });

  if (!groups.length) return;

  groups.forEach(function (group) {
    group.cities.sort(function (a, b) {
      return a.city.localeCompare(b.city, undefined, { sensitivity: "base" });
    });
  });
  groups.sort(function (a, b) {
    return a.continent.localeCompare(b.continent, undefined, { sensitivity: "base" });
  });

  var image = grid.querySelector(".img--staff");
  var imageId = image ? image.id : "";

  grid.textContent = "";
  ensureStaffMapStyles();

  groups.forEach(function (group) {
    var continentWrap = document.createElement("div");
    continentWrap.className = "staff-continent-wrapper";

    var continentLabel = document.createElement("div");
    continentLabel.className = "heading-18 is--staff-continent";
    continentLabel.textContent = group.continent;
    continentWrap.appendChild(continentLabel);

    var citiesWrap = document.createElement("div");
    citiesWrap.className = "staff-cities-wrapper";

    group.cities.forEach(function (city) {
      var cityEl = document.createElement("div");
      cityEl.className = "heading-28 is--orange-city";
      cityEl.textContent = city.city;
      cityEl.setAttribute("role", "button");
      cityEl.setAttribute("tabindex", "0");
      cityEl.setAttribute("data-src", city.src || "");
      cityEl.setAttribute("data-srcset", city.srcset || "");
      cityEl.setAttribute("data-sizes", city.sizes || "");
      cityEl.setAttribute("data-alt", city.alt || city.city);
      citiesWrap.appendChild(cityEl);
    });

    grid.appendChild(continentWrap);
    grid.appendChild(citiesWrap);
  });

  var staffImage = document.createElement("img");
  staffImage.className = "img--staff skip-lazy no-lazy";
  staffImage.alt = "";
  staffImage.loading = "eager";
  staffImage.setAttribute("data-no-lazy", "1");
  if (imageId) staffImage.id = imageId;
  staffImage.style.gridArea = "1 / 3 / " + (groups.length + 1) + " / 4";
  staffImage.style.width = "100%";
  staffImage.style.height = "auto";
  staffImage.style.objectFit = "cover";
  staffImage.style.aspectRatio = "836 / 472";
  grid.appendChild(staffImage);

  grid.addEventListener("click", function (event) {
    var cityEl = event.target.closest(".is--orange-city");
    if (!cityEl || !grid.contains(cityEl)) return;
    selectStaffCity(grid, cityEl);
  });

  grid.addEventListener("keydown", function (event) {
    if (event.key !== "Enter" && event.key !== " ") return;
    var cityEl = event.target.closest(".is--orange-city");
    if (!cityEl || !grid.contains(cityEl)) return;
    event.preventDefault();
    selectStaffCity(grid, cityEl);
  });

  var firstCity = grid.querySelector(".is--orange-city");
  if (firstCity) selectStaffCity(grid, firstCity);
}

function selectStaffCity(grid, cityEl) {
  grid.querySelectorAll(".is--orange-city.is--active").forEach(function (el) {
    el.classList.remove("is--active");
    el.setAttribute("aria-pressed", "false");
  });

  cityEl.classList.add("is--active");
  cityEl.setAttribute("aria-pressed", "true");

  var image = grid.querySelector(".img--staff");
  if (!image) return;

  var src = cityEl.getAttribute("data-src") || "";
  var srcset = cityEl.getAttribute("data-srcset") || "";
  var sizes = cityEl.getAttribute("data-sizes") || "";
  var alt = cityEl.getAttribute("data-alt") || cityEl.textContent;

  if (srcset) image.setAttribute("srcset", srcset);
  else image.removeAttribute("srcset");

  if (sizes) image.setAttribute("sizes", sizes);
  else image.removeAttribute("sizes");

  image.alt = alt;
  image.setAttribute("data-no-lazy", "1");
  image.classList.add("skip-lazy", "no-lazy");
  if (src) image.src = src;
}

function readStaffEntry(item) {
  var img = item.querySelector("img");
  var src = staffImageAttr(img, "src", "data-src");
  var srcset = staffImageAttr(img, "srcset", "data-srcset");
  var sizes = staffImageAttr(img, "sizes", "data-sizes");
  var alt = img ? img.getAttribute("alt") || "" : "";

  var dataCity = item.getAttribute("data-city") || (img && img.getAttribute("data-city"));
  var dataContinent =
    item.getAttribute("data-continent") || (img && img.getAttribute("data-continent"));

  if (dataCity) {
    return {
      city: dataCity.trim(),
      continent: (dataContinent || "Other").trim(),
      src: src,
      srcset: srcset,
      sizes: sizes,
      alt: alt || dataCity.trim(),
    };
  }

  var named = findCityAttribute(item) || (img && findCityAttribute(img));
  if (!named) return null;

  var city = formatStaffLabel(named.name);
  var continent = named.value.trim() || "Other";

  return {
    city: city,
    continent: continent,
    src: src,
    srcset: srcset,
    sizes: sizes,
    alt: alt || city,
  };
}

function staffImageAttr(img, attr, dataAttr) {
  if (!img) return "";
  var direct = img.getAttribute(attr) || "";
  var lazy = img.getAttribute(dataAttr) || "";
  if (lazy && isLazyPlaceholder(direct)) return lazy;
  return direct || lazy;
}

function isLazyPlaceholder(url) {
  if (!url) return true;
  return url.indexOf("data:image") === 0;
}

function findCityAttribute(el) {
  var attrs = Array.from(el.attributes);
  for (var i = 0; i < attrs.length; i++) {
    var name = attrs[i].name;
    var lower = name.toLowerCase();
    if (STAFF_SKIP_ATTRS[lower]) continue;
    if (lower.indexOf("data-") === 0 || lower.indexOf("aria-") === 0) continue;
    if (lower === "city" || lower === "continent" || lower === "bind" || lower === "sym-bind") continue;
    if (!attrs[i].value) continue;
    return { name: name, value: attrs[i].value };
  }
  return null;
}

function formatStaffLabel(name) {
  if (!name) return "";
  if (name !== name.toLowerCase()) return name;
  return name.replace(/(^|[\s_-])([a-zà-ÿ])/g, function (_, sep, ch) {
    return (sep === "_" || sep === "-" ? " " : sep) + ch.toUpperCase();
  });
}

function ensureStaffMapStyles() {
  if (document.getElementById("staff-engagement-map-style")) return;

  var style = document.createElement("style");
  style.id = "staff-engagement-map-style";
  style.textContent =
    ".div-block-13 > .staff-continent-wrapper," +
    ".div-block-13 > .staff-cities-wrapper{align-self:start;}" +
    ".staff-cities-wrapper{display:flex;flex-direction:column;justify-content:center;gap:4rem;}" +
    ".staff-cities-wrapper .heading-28.is--orange-city{cursor:pointer;color:#bebebe;transition:color .2s ease;}" +
    ".staff-cities-wrapper .heading-28.is--orange-city.is--active{color:var(--color--orange);}";
  document.head.appendChild(style);
}

function initVoiceVideoPopup() {
  var popup = document.getElementById("voice-popup");
  if (!popup) return;

  var media = popup.querySelector(".voice--popup-media");
  if (!media) return;

  var lastFocus = null;

  function youtubeEmbed(url) {
    var id = "";
    var m = url.match(/[?&]v=([^&]+)/);
    if (m) id = m[1];
    if (!id) {
      m = url.match(/youtu\.be\/([^?&]+)/);
      if (m) id = m[1];
    }
    if (!id) {
      m = url.match(/youtube\.com\/embed\/([^?&]+)/);
      if (m) id = m[1];
    }
    if (!id) {
      m = url.match(/youtube\.com\/shorts\/([^?&]+)/);
      if (m) id = m[1];
    }
    return id
      ? "https://www.youtube.com/embed/" + id + "?autoplay=1&rel=0"
      : "";
  }

  function vimeoEmbed(url) {
    var m = url.match(/vimeo\.com\/(?:video\/)?(\d+)/);
    return m ? "https://player.vimeo.com/video/" + m[1] + "?autoplay=1" : "";
  }

  function isFileVideo(url) {
    return /\.(mp4|webm|ogg|mov)(\?|$)/i.test(url);
  }

  function closePopup() {
    var video = media.querySelector("video");
    if (video) {
      try {
        video.pause();
      } catch (e) {}
    }
    media.innerHTML = "";
    popup.hidden = true;
    popup.classList.remove("is--open");
    document.documentElement.classList.remove("voice-popup-open");
    if (lastFocus && typeof lastFocus.focus === "function") {
      lastFocus.focus();
    }
    lastFocus = null;
  }

  function openPopup(url, trigger) {
    if (!url) return;
    lastFocus = trigger || document.activeElement;
    media.innerHTML = "";

    var embed = youtubeEmbed(url) || vimeoEmbed(url);
    if (embed) {
      var iframe = document.createElement("iframe");
      iframe.className = "voice--popup-iframe";
      iframe.src = embed;
      iframe.title = "Video";
      iframe.setAttribute("allow", "autoplay; fullscreen; picture-in-picture");
      iframe.setAttribute("allowfullscreen", "");
      iframe.setAttribute("frameborder", "0");
      media.appendChild(iframe);
    } else {
      var video = document.createElement("video");
      video.className = "voice--popup-video";
      video.controls = true;
      video.playsInline = true;
      video.autoplay = true;
      video.src = url;
      if (!isFileVideo(url)) {
        // Still try as HTML5 source (ACF file URLs without extension in query).
        video.src = url;
      }
      media.appendChild(video);
      video.play().catch(function () {});
    }

    popup.hidden = false;
    popup.classList.add("is--open");
    document.documentElement.classList.add("voice-popup-open");
    var closeBtn = popup.querySelector(".voice--popup-close");
    if (closeBtn) closeBtn.focus();
  }

  document.addEventListener("click", function (e) {
    var closeEl = e.target.closest("[data-voice-close]");
    if (closeEl && popup.contains(closeEl)) {
      e.preventDefault();
      closePopup();
      return;
    }

    var item = e.target.closest(".partner-item.is--voice");
    if (!item || !item.closest(".is--voicesofimpact")) return;
    e.preventDefault();
    openPopup(item.getAttribute("data-video") || "", item);
    if (typeof item.blur === "function") item.blur();
  });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && !popup.hidden) {
      closePopup();
      return;
    }
    if (e.key !== "Enter" && e.key !== " ") return;
    var item = e.target.closest && e.target.closest(".partner-item.is--voice");
    if (!item || !item.closest(".is--voicesofimpact")) return;
    e.preventDefault();
    openPopup(item.getAttribute("data-video") || "", item);
  });
}
