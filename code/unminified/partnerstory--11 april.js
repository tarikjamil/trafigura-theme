document.addEventListener("DOMContentLoaded", function () {
  const countryToContinent = {
    // North America
    Canada: "North America",
    "United States": "North America",
    Mexico: "North America",

    // Central America
    Belize: "Central America",
    "Costa Rica": "Central America",
    "El Salvador": "Central America",
    Guatemala: "Central America",
    Honduras: "Central America",
    Nicaragua: "Central America",
    Panama: "Central America",

    // Caribbean
    "Antigua and Barbuda": "North America",
    Bahamas: "North America",
    Barbados: "North America",
    Cuba: "North America",
    Dominica: "North America",
    "Dominican Republic": "North America",
    Grenada: "North America",
    Haiti: "North America",
    Jamaica: "North America",
    "Saint Kitts and Nevis": "North America",
    "Saint Lucia": "North America",
    "Saint Vincent and the Grenadines": "North America",
    "Trinidad and Tobago": "North America",

    // South America
    Argentina: "South America",
    Bolivia: "South America",
    Brazil: "South America",
    Chile: "South America",
    Colombia: "South America",
    Ecuador: "South America",
    Guyana: "South America",
    Paraguay: "South America",
    Peru: "South America",
    Suriname: "South America",
    Uruguay: "South America",
    Venezuela: "South America",

    // Europe
    Albania: "Europe",
    Andorra: "Europe",
    Austria: "Europe",
    Belarus: "Europe",
    Belgium: "Europe",
    "Bosnia and Herzegovina": "Europe",
    Bulgaria: "Europe",
    Croatia: "Europe",
    "Czech Republic": "Europe",
    Denmark: "Europe",
    Estonia: "Europe",
    Finland: "Europe",
    France: "Europe",
    Germany: "Europe",
    Greece: "Europe",
    Hungary: "Europe",
    Iceland: "Europe",
    Ireland: "Europe",
    Italy: "Europe",
    Kosovo: "Europe",
    Latvia: "Europe",
    Liechtenstein: "Europe",
    Lithuania: "Europe",
    Luxembourg: "Europe",
    Malta: "Europe",
    Moldova: "Europe",
    Monaco: "Europe",
    Montenegro: "Europe",
    Netherlands: "Europe",
    "North Macedonia": "Europe",
    Norway: "Europe",
    Poland: "Europe",
    Portugal: "Europe",
    Romania: "Europe",
    "San Marino": "Europe",
    Serbia: "Europe",
    Slovakia: "Europe",
    Slovenia: "Europe",
    Spain: "Europe",
    Sweden: "Europe",
    Switzerland: "Europe",
    Ukraine: "Europe",
    "United Kingdom": "Europe",
    "Vatican City": "Europe",
    Cyprus: "Europe",
    Georgia: "Europe",

    // Asia
    Kazakhstan: "Asia",
    Russia: "Europe",
    Turkey: "Asia",
    Afghanistan: "Asia",
    Armenia: "Asia",
    Azerbaijan: "Asia",
    Bahrain: "Asia",
    Bangladesh: "Asia",
    Bhutan: "Asia",
    Brunei: "Asia",
    Cambodia: "Asia",
    China: "Asia",
    India: "Asia",
    Indonesia: "Asia",
    Iran: "Middle East",
    Iraq: "Middle East",
    Israel: "Middle East",
    Japan: "Asia",
    Jordan: "Middle East",
    Kuwait: "Middle East",
    Kyrgyzstan: "Asia",
    Laos: "Asia",
    Lebanon: "Middle East",
    Malaysia: "Asia",
    Maldives: "Asia",
    Mongolia: "Asia",
    Myanmar: "Asia",
    Nepal: "Asia",
    "North Korea": "Asia",
    Oman: "Middle East",
    Pakistan: "Asia",
    Palestine: "Middle East",
    Philippines: "Asia",
    Qatar: "Middle East",
    "Saudi Arabia": "Middle East",
    Singapore: "Asia",
    "South Korea": "Asia",
    "Sri Lanka": "Asia",
    Syria: "Middle East",
    Taiwan: "Asia",
    Tajikistan: "Asia",
    Thailand: "Asia",
    "Timor-Leste": "Asia",
    Turkmenistan: "Asia",
    "United Arab Emirates": "Middle East",
    Uzbekistan: "Asia",
    Vietnam: "Asia",
    Yemen: "Middle East",

    // Africa
    Algeria: "Africa",
    Angola: "Africa",
    Benin: "Africa",
    Botswana: "Africa",
    "Burkina Faso": "Africa",
    Burundi: "Africa",
    "Cabo Verde": "Africa",
    Cameroon: "Africa",
    "Central African Republic": "Africa",
    Chad: "Africa",
    Comoros: "Africa",
    Congo: "Africa",
    Djibouti: "Africa",
    Egypt: "Africa",
    "Equatorial Guinea": "Africa",
    Eritrea: "Africa",
    Eswatini: "Africa",
    Ethiopia: "Africa",
    Gabon: "Africa",
    Gambia: "Africa",
    Ghana: "Africa",
    Guinea: "Africa",
    "Guinea-Bissau": "Africa",
    "Ivory Coast": "Africa",
    Kenya: "Africa",
    Lesotho: "Africa",
    Liberia: "Africa",
    Libya: "Africa",
    Madagascar: "Africa",
    Malawi: "Africa",
    Mali: "Africa",
    Mauritania: "Africa",
    Mauritius: "Africa",
    Morocco: "Africa",
    Mozambique: "Africa",
    Namibia: "Africa",
    Niger: "Africa",
    Nigeria: "Africa",
    Rwanda: "Africa",
    "Sao Tome and Principe": "Africa",
    Senegal: "Africa",
    Seychelles: "Africa",
    "Sierra Leone": "Africa",
    Somalia: "Africa",
    "South Africa": "Africa",
    "South Sudan": "Africa",
    Sudan: "Africa",
    Tanzania: "Africa",
    Togo: "Africa",
    Tunisia: "Africa",
    Uganda: "Africa",
    Zambia: "Africa",
    Zimbabwe: "Africa",

    // Oceania
    Australia: "Oceania",
    Fiji: "Oceania",
    Kiribati: "Oceania",
    "Marshall Islands": "Oceania",
    Micronesia: "Oceania",
    Nauru: "Oceania",
    "New Zealand": "Oceania",
    Palau: "Oceania",
    "Papua New Guinea": "Oceania",
    Samoa: "Oceania",
    "Solomon Islands": "Oceania",
    Tonga: "Oceania",
    Tuvalu: "Oceania",
    Vanuatu: "Oceania",
    Guam: "Oceania",
    "New Caledonia": "Oceania",
    "French Polynesia": "Oceania",
    "American Samoa": "Oceania",
    "Northern Mariana Islands": "Oceania",
    "Cook Islands": "Oceania",
    Niue: "Oceania",
    Tokelau: "Oceania",
    "Pitcairn Islands": "Oceania",
    "Wallis and Futuna": "Oceania",
    Worldwide: "Worldwide",
  };

  setPartnerContinents();
  populateRegionFilter();
  populateFilter("areaFilter", ".partner--area");
  populateFilter("stateFilter", ".partner--state");

  function setPartnerContinents() {
    document.querySelectorAll(".partner--item").forEach((item) => {
      const regions = item
        .querySelector(".partner--region")
        .textContent.split(", ")
        .map((r) => r.trim());
      const continents = regions
        .map((region) => countryToContinent[region])
        .filter(Boolean);
      item.querySelector(".partner--continent").textContent = [
        ...new Set(continents),
      ].join(", ");
    });
  }

  function populateRegionFilter() {
    const continentCountries = {};
    document.querySelectorAll(".partner--item").forEach((item) => {
      const regions = item
        .querySelector(".partner--region")
        .textContent.split(", ")
        .map((r) => r.trim());
      regions.forEach((region) => {
        const continent = countryToContinent[region];
        if (continent) {
          if (!continentCountries[continent]) {
            continentCountries[continent] = new Set();
          }
          continentCountries[continent].add(region);
        }
      });
    });

    const filterContainer = document.getElementById("regionFilter");
    Object.keys(continentCountries)
      .sort()
      .forEach((continent) => {
        filterContainer.appendChild(
          createRadioButton("regionFilter", continent, continent, true)
        );
        [...continentCountries[continent]].sort().forEach((country) => {
          filterContainer.appendChild(
            createRadioButton("regionFilter", country, country)
          );
        });
      });
  }

  function populateFilter(selector, attribute) {
    const filterContainer = document.getElementById(selector);
    const items = document.querySelectorAll(".partner--item");
    const uniqueValues = new Set();
    items.forEach((item) => {
      const values =
        item.querySelector(attribute)?.textContent.split(",") || [];
      values.forEach((value) => uniqueValues.add(value.trim()));
    });
    [...uniqueValues].sort().forEach((value) => {
      filterContainer.appendChild(createRadioButton(selector, value, value));
    });
  }

  function createRadioButton(name, value, labelText, isContinent = false) {
    const wrapper = document.createElement("div");
    const input = document.createElement("input");
    input.type = "radio";
    input.id = `${name}-${value}`;
    input.name = name;
    input.value = value;
    if (isContinent) {
      input.setAttribute("data-is-continent", "true");
    }
    const label = document.createElement("label");
    label.htmlFor = `${name}-${value}`;
    label.textContent = labelText;
    wrapper.appendChild(input);
    wrapper.appendChild(label);
    return wrapper;
  }

  // Reset filters function
  const resetFilters = () => {
    document
      .querySelectorAll('input[name="regionFilter"]')
      .forEach((rb) => (rb.checked = false));
    filterItems(); // Call filterItems to reset the filtering
    document
      .querySelectorAll('input[name="areaFilter"]')
      .forEach((rb) => (rb.checked = false));
    filterItems(); // Call filterItems to reset the filtering
    document
      .querySelectorAll('input[name="stateFilter"]')
      .forEach((rb) => (rb.checked = false));
    filterItems(); // Call filterItems to reset the filtering
  };

  document
    .getElementById("resetFilters")
    .addEventListener("click", resetFilters);

  document
    .getElementById("regionFilter")
    .addEventListener("change", filterItems);
  document.getElementById("areaFilter").addEventListener("change", filterItems);
  document
    .getElementById("stateFilter")
    .addEventListener("change", filterItems);

  function filterItems() {
    const selectedRegion = document.querySelector(
      'input[name="regionFilter"]:checked'
    )?.value;
    const selectedArea = document.querySelector(
      'input[name="areaFilter"]:checked'
    )?.value;
    const selectedState = document.querySelector(
      'input[name="stateFilter"]:checked'
    )?.value;
    document.querySelectorAll(".partner--item").forEach((item) => {
      const regionOrContinentMatch =
        !selectedRegion ||
        item
          .querySelector(".partner--region")
          .textContent.includes(selectedRegion) ||
        item
          .querySelector(".partner--continent")
          .textContent.includes(selectedRegion);
      const areaMatch =
        !selectedArea ||
        item.querySelector(".partner--area").textContent.includes(selectedArea);
      const stateMatch =
        !selectedState ||
        item
          .querySelector(".partner--state")
          .textContent.includes(selectedState);
      item.style.display =
        regionOrContinentMatch && areaMatch && stateMatch ? "" : "none";
    });
  }
});

// ------------------- select animation ------------------- //
document.addEventListener("DOMContentLoaded", function () {
  const selectWrappers = document.querySelectorAll(".filter--select-wrapper");

  // Initially hide all .filter--options elements
  document.querySelectorAll(".filter--options").forEach((options) => {
    options.style.display = "none";
  });

  // Store initial texts in an array
  const initialTexts = Array.from(selectWrappers).map(
    (wrapper) => wrapper.querySelector(".filter--select-text").textContent
  );

  selectWrappers.forEach((wrapper, index) => {
    const select = wrapper.querySelector(".filter-select");
    const options = wrapper.querySelector(".filter--options");
    const selectText = wrapper.querySelector(".filter--select-text");

    select.addEventListener("click", function () {
      options.style.display =
        options.style.display === "block" ? "none" : "block";
    });

    options.addEventListener("change", function (e) {
      if (e.target && e.target.matches('input[type="radio"]')) {
        selectText.textContent = e.target.nextElementSibling.textContent;
        options.style.display = "none";
      }
    });

    // Close dropdown when clicking outside
    document.addEventListener(
      "click",
      function (event) {
        if (!select.contains(event.target)) {
          options.style.display = "none";
        }
      },
      true
    ); // Using capture phase
  });

  // Reset functionality
  const resetButton = document.querySelector(".btn--reset");
  if (resetButton) {
    resetButton.addEventListener("click", function () {
      selectWrappers.forEach((wrapper, index) => {
        const selectText = wrapper.querySelector(".filter--select-text");
        const radios = wrapper.querySelectorAll('input[type="radio"]');

        // Reset text to its initial value
        selectText.textContent = initialTexts[index];

        // Uncheck all radios
        radios.forEach((radio) => (radio.checked = false));
      });
    });
  }
});
