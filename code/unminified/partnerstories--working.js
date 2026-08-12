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
  };

  // Enhancements for sorting and organizing filter options
  const organizeAndSortOptions = (countryToContinentMap) => {
    const continentCountriesMap = {};
    // Organize countries by continent
    for (const [country, continent] of Object.entries(countryToContinentMap)) {
      if (!continentCountriesMap[continent]) {
        continentCountriesMap[continent] = [];
      }
      continentCountriesMap[continent].push(country);
    }
    // Sort countries within each continent
    for (const continent of Object.keys(continentCountriesMap)) {
      continentCountriesMap[continent].sort();
    }
    return continentCountriesMap;
  };

  function populateRegionFilter() {
    const regionSelect = document.getElementById("regionFilter");

    // Step 1: Organize countries by continent
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

    // Step 2: Sort continents and countries
    const sortedContinents = Object.keys(continentCountries).sort();
    sortedContinents.forEach((continent) => {
      // Add continent option
      const continentOption = document.createElement("option");
      continentOption.value = continent;
      continentOption.textContent = continent;
      regionSelect.appendChild(continentOption);

      // Sort and add countries for this continent
      Array.from(continentCountries[continent])
        .sort()
        .forEach((country) => {
          const countryOption = document.createElement("option");
          countryOption.value = country;
          countryOption.textContent = `--- ${country}`;
          regionSelect.appendChild(countryOption);
        });
    });
  }

  // Function to map countries to continents
  const setPartnerContinents = () => {
    document.querySelectorAll(".partner--item").forEach((item) => {
      const regionDiv = item.querySelector(".partner--region");
      const continentDiv = item.querySelector(".partner--continent");
      const regions = regionDiv.textContent.split(", ");
      const continents = regions
        .map((region) => countryToContinent[region])
        .filter(Boolean);
      continentDiv.textContent = [...new Set(continents)].join(", ");
    });
  };

  const populateFilter = (selector, attribute) => {
    const filterSelect = document.getElementById(selector);
    const items = document.querySelectorAll(".partner--item");
    const uniqueValues = new Set();

    items.forEach((item) => {
      const values =
        item.querySelector(attribute)?.textContent.split(",") || [];
      values.forEach((value) => {
        if (value.trim()) uniqueValues.add(value.trim());
      });
    });

    [...uniqueValues].sort().forEach((value) => {
      if (selector === "stateFilter" && attribute === ".partner--state") {
        // For stateFilter, create radio buttons instead of dropdown options
        const input = document.createElement("input");
        input.type = "radio";
        input.id = value;
        input.name = "state";
        input.value = value;

        const label = document.createElement("label");
        label.htmlFor = value;
        label.textContent = value;

        filterSelect.appendChild(input);
        filterSelect.appendChild(label);
      } else {
        // For other filters, use dropdown options
        const option = document.createElement("option");
        option.value = value;
        option.textContent = value;
        filterSelect.appendChild(option);
      }
    });
  };

  // You'll call these functions after defining them within the DOMContentLoaded listener
  populateFilter("areaFilter", ".partner--area");
  populateFilter("stateFilter", ".partner--state");

  // Reset filters function
  const resetFilters = () => {
    document.getElementById("regionFilter").selectedIndex = 0;
    document.getElementById("areaFilter").selectedIndex = 0;
    document
      .querySelectorAll('input[name="state"]')
      .forEach((rb) => (rb.checked = false));
    filterItems(); // Call filterItems to reset the filtering
  };

  document
    .getElementById("resetFilters")
    .addEventListener("click", resetFilters);

  // Initial population of continents and filters
  setPartnerContinents();
  populateRegionFilter();

  // Filter functionality based on selection
  // Example for regionFilter, adapt for areaFilter and add event listeners for stateFilter radio buttons
  document
    .getElementById("regionFilter")
    .addEventListener("change", function () {
      const selectedValue = this.value;
      filterItems();
    });

  function filterItems() {
    const selectedRegionOrContinent =
      document.getElementById("regionFilter").value;
    const selectedArea = document.getElementById("areaFilter").value;
    const selectedState = document.querySelector(
      'input[name="state"]:checked'
    )?.value;

    document.querySelectorAll(".partner--item").forEach((item) => {
      const regions = item
        .querySelector(".partner--region")
        .textContent.split(", ")
        .map((r) => r.trim());
      const continents = item
        .querySelector(".partner--continent")
        .textContent.split(", ")
        .map((c) => c.trim());
      const areas = item
        .querySelector(".partner--area")
        .textContent.split(", ")
        .map((a) => a.trim());
      const state = item.querySelector(".partner--state")?.textContent.trim();

      const regionOrContinentMatch =
        !selectedRegionOrContinent ||
        regions.includes(selectedRegionOrContinent) ||
        continents.includes(selectedRegionOrContinent);
      const areaMatch = !selectedArea || areas.includes(selectedArea);
      const stateMatch = !selectedState || state === selectedState;

      item.style.display =
        regionOrContinentMatch && areaMatch && stateMatch ? "" : "none";
    });
  }

  document.getElementById("areaFilter").addEventListener("change", filterItems);

  // Since state radio buttons are dynamically added, use event delegation on their parent container
  document.getElementById("stateFilter").addEventListener("change", (event) => {
    if (event.target.name === "state") {
      filterItems();
    }
  });

  function toggleCustomSelect() {
    document.querySelector(".custom-options").classList.toggle("open");
  }
});
