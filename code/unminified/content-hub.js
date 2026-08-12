document.addEventListener("DOMContentLoaded", function () {
  // Get filter elements - use more specific selector for search input
  const searchInput = document.querySelector('.filter--search-input, input[type="text"][placeholder*="Search"], input[type="text"][aria-label*="Search"]');
  const categoryFilter = document.querySelector(".filter--options");
  const resetButton = document.querySelector(".btn--reset");
  
  console.log("Content Hub Filter initialized");
  console.log("Search input found:", searchInput);
  console.log("Category filter found:", categoryFilter);
  console.log("Reset button found:", resetButton);
  
  // Initialize filters
  filterItems();
  setupDropdown();

  // Add event listeners
  if (searchInput) {
    searchInput.addEventListener("input", filterItems);
    console.log("Search input event listener attached");
  } else {
    console.warn("Search input not found - searching will not work");
  }

  if (categoryFilter) {
    categoryFilter.addEventListener("change", function (e) {
      if (e.target && e.target.matches('input[type="radio"]')) {
        // Manually uncheck all other radio buttons (handles inconsistent name attributes)
        const allRadios = document.querySelectorAll('.filter--options input[type="radio"]');
        allRadios.forEach((radio) => {
          if (radio !== e.target) {
            radio.checked = false;
          }
        });
        filterItems();
      }
    });
  }

  if (resetButton) {
    resetButton.addEventListener("click", resetFilters);
  }

  // Filter function
  function filterItems() {
    const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : "";
    const selectedCategory = document.querySelector(
      '.filter--options input[type="radio"]:checked'
    )?.value;

    console.log("Filtering with:", { searchTerm, selectedCategory });

    // Get all content items - try multiple possible selectors
    const items = document.querySelectorAll(".hub-grid .w-dyn-item, .hub-grid > div, .hub-grid > a, .hub-grid .collection-item");

    console.log("Found items:", items.length);

    let isFirstVisible = true;

    items.forEach((item) => {
      // Get the heading text
      const headingElement = item.querySelector(".heading-28");
      const headingText = headingElement
        ? headingElement.textContent.toLowerCase()
        : "";

      // Get the category tag
      const categoryElement = item.querySelector(".tag-category");
      const categoryText = categoryElement
        ? categoryElement.textContent.trim()
        : "";

      // Check search match
      const searchMatch = !searchTerm || headingText.includes(searchTerm);

      // Check category match (case-insensitive)
      const categoryMatch =
        !selectedCategory || 
        categoryText.toLowerCase() === selectedCategory.toLowerCase();

      // Determine if item should be displayed
      const shouldDisplay = searchMatch && categoryMatch;

      // Show/hide item
      item.style.display = shouldDisplay ? "" : "none";

      // Remove first-visible class from all items
      item.classList.remove("first-visible");

      // Add first-visible class to first visible item
      if (shouldDisplay && isFirstVisible) {
        item.classList.add("first-visible");
        isFirstVisible = false;
      }
    });
  }

  // Reset filters function
  function resetFilters() {
    // Clear search input
    if (searchInput) {
      searchInput.value = "";
    }

    // Uncheck all radio buttons
    document
      .querySelectorAll('.filter--options input[type="radio"]')
      .forEach((rb) => (rb.checked = false));

    // Update dropdown text back to default
    const selectText = document.querySelector(".filter--select-text");
    if (selectText) {
      selectText.textContent = "Category";
    }

    // Re-filter items (show all)
    filterItems();
  }

  // Setup dropdown functionality
  function setupDropdown() {
    const selectWrapper = document.querySelector(".filter--select-wrapper");
    if (!selectWrapper) return;

    const select = selectWrapper.querySelector(".filter-select");
    const options = selectWrapper.querySelector(".filter--options");
    const selectText = selectWrapper.querySelector(".filter--select-text");

    if (!select || !options || !selectText) return;

    // Hide options initially
    options.style.display = "none";

    // Toggle dropdown on click
    select.addEventListener("click", function (e) {
      e.stopPropagation();
      options.style.display =
        options.style.display === "block" ? "none" : "block";
    });

    // Update text when option is selected
    options.addEventListener("change", function (e) {
      if (e.target && e.target.matches('input[type="radio"]')) {
        // Manually uncheck all other radio buttons (handles inconsistent name attributes)
        const allRadios = document.querySelectorAll('.filter--options input[type="radio"]');
        allRadios.forEach((radio) => {
          if (radio !== e.target) {
            radio.checked = false;
          }
        });
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
    );
  }
});
