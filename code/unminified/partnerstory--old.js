document.addEventListener("DOMContentLoaded", function () {
  const regionFilter = document.getElementById("regionFilter");
  const areaFilter = document.getElementById("areaFilter");
  const stateFilter = document.getElementById("stateFilter");
  const partnerItems = document.querySelectorAll(".partner--item");

  // Populate filters with unique values from partner items
  async function populateFilters() {
    // Assume we have a function that fetches countries and their continents
    const continentCountryMap = await fetchCountriesGroupedByContinents();

    // Populate regionFilter
    regionFilter.innerHTML = '<option value="">Region/Country</option>';
    for (const continent of Object.keys(continentCountryMap).sort()) {
      // Create an optgroup element for each continent
      const continentGroup = document.createElement("optgroup");
      continentGroup.label = continent;

      // Add countries as option elements to the optgroup
      for (const country of continentCountryMap[continent].sort()) {
        const countryOption = document.createElement("option");
        countryOption.value = country;
        countryOption.textContent = country;
        continentGroup.appendChild(countryOption);
      }

      // Append the optgroup to the select element
      regionFilter.appendChild(continentGroup);
    }

    // Populate areaFilter
    const areas = Array.from(
      new Set(
        [...partnerItems].map((item) =>
          item.querySelector(".partner--area").textContent.trim()
        )
      )
    );
    areaFilter.innerHTML = '<option value="">Area of work</option>';
    areas.forEach((area) => {
      const option = new Option(area, area);
      areaFilter.add(option);
    });

    // Populate stateFilter (assuming states are not too numerous for radio buttons)
    const states = Array.from(
      new Set(
        [...partnerItems].map((item) =>
          item.querySelector(".partner--state").textContent.trim()
        )
      )
    );
    stateFilter.innerHTML = "";
    states.forEach((state) => {
      const label = document.createElement("label");
      label.className = "radio-btn";
      const radio = document.createElement("input");
      radio.type = "radio";
      radio.name = "state";
      radio.value = state;
      label.appendChild(radio);
      const span = document.createElement("span");
      span.className = "radio-check";
      label.appendChild(span);
      label.appendChild(document.createTextNode(state));
      stateFilter.appendChild(label);
    });
  }

  // Fetch countries grouped by their continents
  async function fetchCountriesGroupedByContinents() {
    const apiUrl = "https://restcountries.com/v3.1/all";
    try {
      const response = await fetch(apiUrl);
      const countries = await response.json();
      const continentCountryMap = {};
      countries.forEach((country) => {
        const continent = country.region;
        const countryName = country.name.common;
        if (!continentCountryMap[continent]) {
          continentCountryMap[continent] = [];
        }
        continentCountryMap[continent].push(countryName);
      });
      return continentCountryMap;
    } catch (error) {
      console.error("Error fetching countries: ", error);
      return {};
    }
  }

  // Filter items based on selections
  function filterItems() {
    const selectedRegion = regionFilter.value;
    const selectedArea = areaFilter.value;
    const selectedState = stateFilter.querySelector(
      'input[name="state"]:checked'
    )?.value;

    partnerItems.forEach((item) => {
      const regions = item
        .querySelector(".partner--region")
        .textContent.split(",")
        .map((r) => r.trim());
      const area = item.querySelector(".partner--area").textContent.trim();
      const state = item.querySelector(".partner--state").textContent.trim();

      const regionMatch = !selectedRegion || regions.includes(selectedRegion);
      const areaMatch = !selectedArea || area === selectedArea;
      const stateMatch = !selectedState || state === selectedState;

      item.style.display = regionMatch && areaMatch && stateMatch ? "" : "none";
    });
  }

  // Set up filter change events
  regionFilter.addEventListener("change", filterItems);
  areaFilter.addEventListener("change", filterItems);
  stateFilter.addEventListener("change", filterItems);

  document
    .getElementById("resetFilters")
    .addEventListener("click", function () {
      regionFilter.selectedIndex = 0;
      areaFilter.selectedIndex = 0;
      stateFilter
        .querySelectorAll('input[name="state"]')
        .forEach((radio) => (radio.checked = false));
      filterItems();
    });

  populateFilters();
});
