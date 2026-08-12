document.addEventListener("DOMContentLoaded", function () {
  // Helper function to normalize dashes for consistent matching
  function normalizeDashes(str) {
    return str.replace(/[-–—]/g, '-'); // Replace all dash types with regular hyphen
  }

  // Collect all partner-related-text values into an array
  var relatedTexts = Array.from(
    document.querySelectorAll(".partner-related-text")
  ).map(function (elem) {
    return normalizeDashes(elem.textContent.trim());
  });

  // Get all partner--item elements
  var partnerItems = Array.from(document.querySelectorAll(".partner--item"));

  // Filter partner--items to find those where heading-32 matches any relatedText
  var matchedItems = partnerItems
    .filter(function (item) {
      var headingText = normalizeDashes(item.querySelector(".heading-32").textContent.trim());
      return relatedTexts.includes(headingText);
    })
    .slice(0, 3); // Get only the first 3 matching elements

  // If no matches found, hide the entire section
  if (matchedItems.length === 0) {
    var section = document.querySelector(".section.is--other-partners");
    if (section) {
      section.style.display = "none";
    }
    return;
  }

  // Hide all partner--items initially
  partnerItems.forEach(function (item) {
    item.style.display = "none";
  });

  // Show only the matched items
  matchedItems.forEach(function (item) {
    item.style.display = "block";
  });
});
