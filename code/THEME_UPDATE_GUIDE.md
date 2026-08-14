# Trafigura Theme Update Guide

This guide documents all the standard updates that need to be applied when uploading or updating a Trafigura WordPress theme.

**Maintenance rule:** Whenever we ship a theme customization that must be re-applied after an Udesly/Webflow theme drop, add it here **in the same PR/change** (new section + checklist item + verify command when useful). Also update `.cursor/rules/theme-updates.mdc`.

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

## 3. Partner / news gallery — hide empty state + show captions

Udesly exports leave a Webflow-style empty state and do not wire per-image captions. Re-apply after every theme drop.

### 3a. Hide “No items found.” when the gallery has slides

**Problem:** Templates add `udesly-hidden` on `.w-dyn-empty`, but that class is **not defined** in CSS (Webflow uses `.w-dyn-hide`). The gray “No items found.” box stays visible.

**Files:**
- `assets/css/components.css` (rebuild `trafigura-bundle.css` after)
- `template-parts/content/single-partner-stories.php`
- `template-parts/content/single-news.php`
- `template-parts/query/related-partners-of-current-partner-stories.php`

**CSS (next to `.w-dyn-hide`):**

```css
.udesly-hidden {
  display: none !important;
}
```

**Gallery markup:** only output the empty block when there are no items:

```php
<?php if ( count( $setItems ) === 0 ) : ?><div class="w-dyn-empty">
  <div>No items found.</div>
</div><?php endif; ?>
```

**Related-partners taxonomy query:** do **not** render the empty “No items found.” else branch (unused taxonomy clutters the page). Keep the list when `$count > 0` only.

### 3b. Gallery image captions under the swiper

**Helper in `functions.php`:** keep `trafigura_gallery_image_caption( $set_item )` — prefers set `caption`, then `$image->caption`, then alt.

**Templates** (`single-partner-stories.php`, `single-news.php`):
- Each slide: `data-caption="<?php echo esc_attr( trafigura_gallery_image_caption( $set_item ) ); ?>"`
- Under-slider element: `.gallery-slide-caption` with `data-fallback` = `slider-text-3` (partners) or `gallery---text` (news)
- Initial text = first slide caption, else fallback

**JS** (`code/script.js` + `code/unminified/script.js`): gallery Swiper `init` / `slideChange` syncs active `data-caption` into `.gallery-slide-caption`.

**CSS** (`trafigura-staging.css` → rebuild bundle):

```css
.gallery-slide-caption:empty {
  display: none;
}
```

**Content note:** captions come from the WP Media Library **Caption** field (or alt). Images without captions will show nothing until editors fill them in.

**After CSS/JS edits:** bump `ver=` on `trafigura-bundle` in head templates and `code/script.js?v=` in footers; purge W3TC.

---

## 4. Quick Update Checklist

When a new theme is uploaded:

- [ ] Update `/related-partner.js` (minified)
- [ ] Update `/unminified/related-partner.js` (readable)
- [ ] Search all files in `/template-parts/query/` for `"order" => "ASC"`
- [ ] Replace all instances with `"order" => "DESC"`
- [ ] Verify no ASC orders remain (except where specifically needed for custom sorting)
- [ ] Re-apply gallery empty-state hide (`.udesly-hidden` + no empty markup when slides exist)
- [ ] Re-apply gallery captions helper + slide `data-caption` + `.gallery-slide-caption` sync in `script.js`
- [ ] Drop empty “No items found” from `related-partners-of-current-partner-stories.php`
- [ ] Also follow the fuller checklist in `.cursor/rules/theme-updates.mdc` (fonts, hero, GTM, internal links, etc.)

---

## 5. Verification Commands

### To find all ASC orders:
```bash
grep -r '"order" => "ASC"' template-parts/query/
```

### To verify all DESC orders:
```bash
grep -r '"order" => "DESC"' template-parts/query/
```

### Gallery / empty-state checks:
```bash
grep -n 'udesly-hidden' assets/css/components.css assets/css/trafigura-bundle.css
grep -n 'trafigura_gallery_image_caption\|gallery-slide-caption\|data-caption' template-parts/content/single-partner-stories.php template-parts/content/single-news.php functions.php code/script.js
grep -n 'No items found' template-parts/query/related-partners-of-current-partner-stories.php
```

### Technical SEO guards:
```bash
# Must be empty (Yoast owns Twitter titles)
grep -r 'twitter:title' template-parts/head/ || true

# Archives must redirect, not render front-page
grep -n 'wp_safe_redirect\|front-page' archive.php archive-tales.php archive-partner-stories.php

# Resilience slug template present
test -f page-tales-of-resilience.php && echo OK

# No duplicate lang=
grep -n 'language_attributes\|lang=' header.php

# Partner share uses get_permalink
grep -n 'get_permalink\|%2Fpartner-stories' template-parts/content/single-partner-stories.php

# Alt + Yoast OG helpers
grep -n 'trafigura_image_alt\|trafigura_yoast_prefer' functions.php
```

---

## 6. Technical SEO customizations (Aug 2026)

Re-apply after Udesly sync:

1. **No** hardcoded `twitter:title` in `template-parts/head/*.php`
2. `page-tales-of-resilience.php` loads Tales partials (slug rename)
3. `archive.php` / CPT archive / taxonomy templates **redirect** to hubs (never homepage HTML)
4. `header.php`: `language_attributes()` only
5. Hardcoded Title Case H1s: Content Hub, Who We Are, Contact Us, Areas of Work
6. Partner share URLs via `get_permalink()`; `trafigura_image_alt()` + Yoast OG/Twitter prefer SEO fields
7. Home hero poster non-empty alt; single-tales title is `<h1>`

See also `.cursor/rules/theme-updates.mdc` §2 / §2b.

---

## Notes

- These changes ensure consistent user experience across all theme versions
- The related partners script handles various dash types used in partner names
- All collections display newest content first for better user engagement
- Always test the related partners functionality after updates
- For performance, fonts, hero, GTM, and SEO re-wires after a full Udesly drop, use `.cursor/rules/theme-updates.mdc`

---

**Last Updated:** August 14, 2026  
**Version:** 1.2
