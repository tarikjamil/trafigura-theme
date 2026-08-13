# Trafigura Foundation — SEO Big Wins Checklist

Audit date: 10 Aug 2026  
Last updated: **12 Aug 2026** (post Yoast + IA + internal-linking pass)  
Site: https://trafigurafoundation.org/  
Source: Yoast sitemap index (`page`, `area-of-work`, `news`, `partner-stories`) — **114 URLs**

Use this checklist in WordPress + Yoast. Tick items as you ship them.  
Full meta copy: `yoast-meta-all-pages.csv`  
News → partner link tracker: `news-to-partner-links.csv`

**Public hubs (index):** `/content-hub/` (news) · `/partners-stories/` (partners) · `/areas-of-work/` (areas)  
**Hidden CPT archives:** `/news/` · `/partner-stories/` · `/area-of-work/` → noindex and/or 301 to hubs

---

## P0 — Fix this week (highest ROI)

### 1. Kill indexable junk & utility pages
- [x] `/do-not-delete/` → Yoast **noindex, nofollow** + exclude from sitemap
- [x] `/do-not-delete-4/` → deleted (404) / noindex
- [x] `/news/elementor-35238/` → 301 to `/news/new-grant-to-the-nature-conservancy/` (proper slug + indexed)
- [x] Re-check sitemap_index after purge/cache clear (W3 Total Cache) — junk gone

**Why:** These URLs are publicly indexable with titles like “do not delete” / Elementor leftovers. They waste crawl budget and look unprofessional in Search/AI results.

### 2. Replace placeholder & duplicated meta (site-wide pattern)
- [x] Homepage meta replaced (CSV row for `/`)
- [x] `/partners-stories/` meta updated
- [x] `/partner-stories/` CPT archive → 301 to `/partners-stories/` (no longer competing)
- [x] `/news/` CPT archive → noindex + 301 to `/content-hub/`
- [x] Bulk-update **news + partner stories** unique metas (live audit 12 Aug: **114/114 OK**)

**Why:** Google + AI answer engines treat unique title/description as the first relevance signal. Dozens of pages currently look identical.

### 3. Resolve duplicate / competing URLs
- [x] `/areas-of-work/` (page) = public hub; `/area-of-work/` CPT archive → **301** to `/areas-of-work/`
- [x] `/partners-stories/` (page) = public partners archive; `/partner-stories/` CPT archive → **301** to `/partners-stories/`
- [x] `/content-hub/` (page) = public news archive; `/news/` CPT archive → **noindex** + **301** to `/content-hub/`
- [ ] Review numbered partner duplicates *(deferred — user skip for now)*:
  - `planet-indonesia` vs `planet-indonesia-2` (canonical already → nicer slug)
  - `plan-vivo` vs `plan-vivo-foundation-2`
  - `root-capital` / `root-capital-3` / `root-capital-4` (regional variants — keep)
  - `the-international-rescue-committee-irc` vs `…-irc-2` (different programmes — keep)
  - `the-nature-conservancy-2` vs other TNC variants (different programmes — keep)

**Why:** Split equity + confusing snippets; AI systems often cite the cleaner canonical entity page.

### 4. Ship Yoast fields for all core pages (CSV filter `priority=P0` + `content_type` Page/Area)
For each URL in CSV: Focus keyphrase → SEO title → Meta description
- [x] `/`
- [x] `/who-we-are/`
- [x] `/our-approach/`
- [x] `/areas-of-work/`
- [x] `/area-of-work/sustainable-livelihoods/`
- [x] `/area-of-work/thriving-nature/`
- [x] `/area-of-work/prepared-communities/`
- [x] `/content-hub/`
- [x] `/partners-stories/`
- [x] `/partner-stories/` *(archive hidden via 301)*
- [x] `/news/` *(archive noindex + 301 to content-hub)*
- [x] `/staff-engagement/`

### 5. Template / H1 fixes (theme or Elementor)
- [x] CPT archives no longer public hubs (redirected / noindex) — archive H1 issue moot for SEO
- [x] Content Hub H1 → `Content Hub` (theme: `page-content-hub.php`)
- [ ] Normalize remaining H1 casing if needed (`who we are`, `contact us`)
- [ ] Ensure one clear H1 per page; keep brand voice consistent

### 6. robots.txt & crawl hygiene
- [x] Added `Sitemap: https://trafigurafoundation.org/sitemap_index.xml` (Yoast block) + kept `Crawl-delay: 10`
- [x] Confirm junk URLs are excluded after noindex
- [ ] Reconsider crawl-delay if Search Console shows crawl issues (often unnecessary on modern hosting)

---

## P1 — Next sprint (strong wins)

### 7. Complete Yoast for all News + Partner Stories
- [x] Apply remaining CSV rows (`priority=P1`) — covered in 12 Aug live audit
- [ ] In Yoast: spot-check focus keyphrase in intro + H1 where natural (optional polish)
- [ ] Add unique OG title/description where social previews still look generic (optional)

### 8. Slug & spelling clean-up (with 301s)
- [x] `/tales-of-resistence/` → `/tales-of-resilience/` + 301
- [x] `/news/field-visit-in-columbia-…` → Colombia spelling + 301
- [ ] Review `/news/trafigura-foundation-2025-annual-report-2/` slug (`-2` looks accidental)

### 9. Internal linking
- [x] From homepage + Areas of Work, link to the 3 pillars with exact-match anchors
- [x] From each partner story: link to related Area of Work (+ related partner cards already exist)
- [ ] From news → partner story pages *(in progress — see `news-to-partner-links.csv`)*
  - ~13 already linked (incl. Tanzania / Blue Alliance + most single-partner announcements)
  - Remaining: filter CSV `status=needs_link` (start with `priority=P0`)
- [x] Add a clear path: Content Hub → Partners; homepage → Content Hub / Partners

### 10. Structured data (beyond basic Yoast WebPage)
- [ ] `Organization` / `NGO` or `FundingScheme` accuracy (name, logo, sameAs LinkedIn, address Geneva)
- [ ] `NewsArticle` / `Article` on news posts (author, datePublished, image)
- [ ] `BreadcrumbList` on all nested URLs
- [ ] PDF publications: consider `DigitalDocument` or dedicated publication pages with metadata

### 11. Performance & Core Web Vitals (W3TC + theme)
- [x] Homepage hero: poster-first LCP image; **no autoplay video on mobile**; desktop loads video after idle
- [x] Preload local hero poster (`assets/images/home-hero-poster.jpg`)
- [x] Hero poster excluded from W3TC lazy-load (`no-lazy` / `data-no-lazy` / `loading="eager"`)
- [x] Defer GTM on **all** templates via `template-parts/head/partials/gtm-deferred.php` (interaction/idle; gtag comes from GTM — keep GTM)
- [x] Convert Euclid fonts to WOFF2; keep weights **400/500/600** only (~65 KiB less than 5 weights)
- [x] Bebas Neue self-hosted (local woff2 in bundle; no Google Fonts); Netlify extras from theme `code/`
- [x] GSAP / Swiper / SplitType self-hosted under `assets/js/vendor/` (no cdnjs / jsDelivr / unpkg)
- [x] Homepage: local GSAP/Swiper sync in `footer/front-page`; dequeue honeypot / Udesly editor JS for public visitors (keep jquery-migrate)
- [x] Rem root (`rem-root.php`) in `<head>` before CSS to prevent rem snap; Euclid regular/semibold use `font-display: optional`
- [x] Dequeue unused block-library / Elementor Roboto + Elementor frontend/kit CSS when page has no Elementor content
- [x] jQuery printed in footer **just before** GSAP/Swiper/theme scripts
- [x] Listing cards: `trafigura_card_image()` + OceanImageBank ~400w default (~23 KiB)
- [x] Defer non-critical CSS (`code/style.css`, honeypot, udesly common); inline `.main-wrapper{opacity:0}`
- [x] A11y/SEO: descriptive areas CTA; footer brand `aria-label`; Swiper wrappers without conflicting `role="list"`
- [ ] Re-run PageSpeed after deploy; purge W3TC
### 12. Search Console hygiene
- [x] Sitemap already in GSC; `robots.txt` now declares sitemap
- [x] Requested indexing for hubs (`/content-hub/`, `/partners-stories/`, `/areas-of-work/`)
- [ ] Inspect “do not delete” / old Elementor URL → Removals **only if still indexed**
- [ ] Monitor duplicate title/description reports after Yoast bulk update

---

## P2 — Ongoing content SEO

- [ ] Refresh outdated job posts (Investment Manager / Programme Manager) — noindex if closed, or add “Closed” clearly
- [ ] Standardise partner story intro: problem → geography → approach → Trafigura Foundation role → outcomes
- [ ] Add FAQ blocks on pillar pages (also feeds AEO — see `AEO-recommendations.md`)
- [ ] Build topic clusters: Climate adaptation · Blue economy · Anticipatory action · Informal settlements · Nature-based solutions
- [ ] Ensure every annual report / strategy PDF has an HTML landing page with summary + download (indexable text > PDF-only)
- [ ] Optional: publish `llms.txt` (see `AEO-recommendations.md`)

---

## Quick verification (after each batch)

- [x] Live meta audit vs CSV — **114/114 OK** (12 Aug 2026)
- [x] Sitemap no longer lists noindexed junk
- [x] Internal linking spot-check (home / areas / content-hub / partners / news CTA)
- [ ] Rich Results / schema validator on 1 home + 1 news + 1 partner
- [ ] Spot-check Google: `site:trafigurafoundation.org "do not delete"` → should go to zero

---

## Evidence snapshot (original audit → current)

| Issue | Original | Status (12 Aug) |
|---|---|---|
| Placeholder meta | `/`, `/partners-stories/` | Fixed |
| Generic org meta reused | Most news + many partners | Fixed (unique Yoast metas) |
| Indexable junk | `do-not-delete`, Elementor slug | Fixed (noindex / 404 / 301) |
| Archive H1 wrong | `/news/`, `/partner-stories/` | Mitigated (archives redirected / noindex) |
| Competing URLs | areas / partners / news pairs | Fixed (hubs + 301s) |
| Typos in slugs | `resistence`, `columbia` | Fixed (+ 301s) |
| Weak robots.txt | No sitemap declaration | Fixed |
| News → partner inline links | Missing | In progress (`news-to-partner-links.csv`) |

CSV columns to use in Yoast: `focus_keyphrase`, `seo_title`, `meta_description`, `recommended_robots`.
