document.addEventListener("DOMContentLoaded", function () {
  // Get the value from the <h1> element
  var h1Element = document.querySelector("h1");
  
  if (!h1Element) {
    console.warn("area-filtre.js: No h1 element found on the page");
    return;
  }
  
  var h1Value = h1Element.textContent.trim();
  console.log("area-filtre.js: Looking for partners with area:", h1Value);

  // Get all elements with the class 'partner--item'
  var items = Array.from(document.querySelectorAll(".partner--item"));
  console.log("area-filtre.js: Total partner items found:", items.length);

  if (items.length === 0) {
    console.warn("area-filtre.js: No partner items found");
    return;
  }

  // Filter items where the 'partner--area' text includes the 'h1Value'
  // Items are already ordered by date DESC from WordPress
  var matchedItems = items.filter(function (item) {
    var areaElement = item.querySelector(".partner--area");
    
    if (!areaElement) {
      console.warn("area-filtre.js: Partner item missing .partner--area element", item);
      return false;
    }
    
    var areaValue = areaElement.textContent.trim();
    
    // Case-insensitive matching for better reliability
    var matches = areaValue.toLowerCase().includes(h1Value.toLowerCase());
    
    if (matches) {
      console.log("area-filtre.js: Matched partner -", item.querySelector(".heading-32")?.textContent.trim(), "| Area:", areaValue);
    }
    
    return matches;
  }).slice(0, 3); // Take only the first 3 (most recent due to WordPress ordering)

  console.log("area-filtre.js: Matched items (first 3):", matchedItems.length);

  // Hide all items initially
  items.forEach(function (item) {
    item.style.display = "none";
  });

  // Show only the first 3 matched items (most recent)
  matchedItems.forEach(function (item) {
    item.style.display = "block";
  });
  
  if (matchedItems.length === 0) {
    console.warn("area-filtre.js: No matching partners found for area:", h1Value);
  } else {
    console.log("area-filtre.js: Successfully showing", matchedItems.length, "most recent partner(s)");
  }
});
