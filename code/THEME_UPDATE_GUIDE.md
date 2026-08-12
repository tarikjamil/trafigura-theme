# Trafigura Theme Update Guide

This guide documents all the standard updates that need to be applied when uploading or updating a Trafigura WordPress theme.

## 1. Related Partners Script Updates

### Files to update:
- `/related-partner.js` (minified version)
- `/unminified/related-partner.js` (readable version)

### Changes needed:
1. **Add dash normalization** - Fixes matching issues between different dash types (-, –, —)
2. **Hide section when no matches** - Hides the entire "Other partnerships" section if no related partners are found

### Updated code (unminified version):

```javascript
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
```

### Minified version:

```javascript
document.addEventListener("DOMContentLoaded",function(){function e(e){return e.replace(/[-–—]/g,"-")}var t=Array.from(document.querySelectorAll(".partner-related-text")).map(function(t){return e(t.textContent.trim())}),n=Array.from(document.querySelectorAll(".partner--item")),r=n.filter(function(n){var r=e(n.querySelector(".heading-32").textContent.trim());return t.includes(r)}).slice(0,3);if(0===r.length){var i=document.querySelector(".section.is--other-partners");return void(i&&(i.style.display="none"))}n.forEach(function(e){e.style.display="none"}),r.forEach(function(e){e.style.display="block"})});
```

---

## 2. Collection Order Updates

### Requirement:
All collections should display from **newest to oldest** (DESC order)

### Files to update:
All query files in `/template-parts/query/` that contain `"order" => "ASC"`

### Change to make:
Replace: `"order" => "ASC",`  
With: `"order" => "DESC",`

### Affected files (typical):

#### Partner Stories:
- `partner-stories-sorted-by-post_date.php`
- `partner-stories-max-6-sorted-by-post_date.php`
- `partner-stories-where-id-ne-current-sorted-by-post_date.php`
- `partner-stories-sorted-by-post_date-v0.php`

#### News:
- `news-first-sorted-by-date.php`
- `news-max-2-sorted-by-date.php`
- `news-max-3-sorted-by-date.php`
- `news-skip-2-sorted-by-date.php`
- `news-max-3-where-id-ne-current-sorted-by-date.php`
- `news-first-where-featured-eq-true-where-news-type-eq-publication-sorted-by-date.php`
- `news-max-3-skip-1-where-featured-eq-true-where-news-type-eq-publication-sorted-by-date.php`

#### Teams:
- `teams-where-category-eq-management-team-sorted-by-post_date.php`
- `teams-where-category-eq-board-members-sorted-by-post_date.php`

#### Areas of Work:
- `areas-of-works-sorted-by-post_date.php`

---

## 3. Quick Update Checklist

When a new theme is uploaded:

- [ ] Update `/related-partner.js` (minified)
- [ ] Update `/unminified/related-partner.js` (readable)
- [ ] Search all files in `/template-parts/query/` for `"order" => "ASC"`
- [ ] Replace all instances with `"order" => "DESC"`
- [ ] Verify no ASC orders remain (except where specifically needed for custom sorting)

---

## 4. Verification Commands

### To find all ASC orders:
```bash
grep -r '"order" => "ASC"' template-parts/query/
```

### To verify all DESC orders:
```bash
grep -r '"order" => "DESC"' template-parts/query/
```

---

## Notes

- These changes ensure consistent user experience across all theme versions
- The related partners script handles various dash types used in partner names
- All collections display newest content first for better user engagement
- Always test the related partners functionality after updates

---

**Last Updated:** February 11, 2026  
**Version:** 1.0
