# Trafigura Foundation — SEO Big Wins Checklist

Audit date: 10 Aug 2026  
Site: https://trafigurafoundation.org/  
Source: Yoast sitemap index (`page`, `area-of-work`, `news`, `partner-stories`) — **114 URLs**

Use this checklist in WordPress + Yoast. Tick items as you ship them.  
Full meta copy lives in `yoast-meta-all-pages.csv`.

---

## P0 — Fix this week (highest ROI)

### 1. Kill indexable junk & utility pages
- [ ] `/do-not-delete/` → Yoast **noindex, nofollow** + exclude from sitemap
- [ ] `/do-not-delete-4/` → same
- [ ] `/news/elementor-35238/` → delete **or** noindex + remove from sitemap
- [ ] Re-check sitemap_index after purge/cache clear (W3 Total Cache)

**Why:** These URLs are publicly indexable with titles like “do not delete” / Elementor leftovers. They waste crawl budget and look unprofessional in Search/AI results.

### 2. Replace placeholder & duplicated meta (site-wide pattern)
- [ ] Homepage meta is literally about *“Crafting effective meta descriptions…”* — replace immediately (CSV row for `/`)
- [ ] `/partners-stories/` meta is also a placeholder about optimizing meta descriptions
- [ ] `/partner-stories/` archive reuses homepage title + placeholder meta + homepage H1
- [ ] `/news/` archive reuses homepage H1 + generic org blurb
- [ ] Bulk-update **news + partner stories** that share the same org-wide description: *“Established in 2007, The Trafigura Foundation invest…”*

**Why:** Google + AI answer engines treat unique title/description as the first relevance signal. Dozens of pages currently look identical.

### 3. Resolve duplicate / competing URLs
- [ ] `/areas-of-work/` (page) vs `/area-of-work/` (CPT archive) — pick **one** public hub; noindex or 301 the other
- [ ] `/partners-stories/` (page) vs `/partner-stories/` (CPT archive) — clarify IA (listing vs archive); avoid two competing “partners” entry points without differentiation
- [ ] Review numbered partner duplicates and set **canonical** to the primary page:
  - `planet-indonesia` vs `planet-indonesia-2`
  - `plan-vivo` vs `plan-vivo-foundation-2`
  - `root-capital` / `root-capital-3` / `root-capital-4` (keep regional variants if intentional, else consolidate)
  - `the-international-rescue-committee-irc` vs `…-irc-2`
  - `the-nature-conservancy-2` vs other TNC variants

**Why:** Split equity + confusing snippets; AI systems often cite the cleaner canonical entity page.

### 4. Ship Yoast fields for all core pages (CSV filter `priority=P0` + `content_type` Page/Area)
For each URL in CSV: Focus keyphrase → SEO title → Meta description
- [ ] `/`
- [ ] `/who-we-are/`
- [ ] `/our-approach/`
- [ ] `/areas-of-work/`
- [ ] `/area-of-work/sustainable-livelihoods/`
- [ ] `/area-of-work/thriving-nature/`
- [ ] `/area-of-work/prepared-communities/`
- [ ] `/content-hub/`
- [ ] `/partners-stories/`
- [ ] `/partner-stories/`
- [ ] `/news/`
- [ ] `/staff-engagement/` (meta currently reads like HR engagement, not philanthropy matching)

### 5. Template / H1 fixes (theme or Elementor)
- [ ] Fix CPT archives so H1 matches page purpose (News / Partner Stories), not homepage hero
- [ ] Normalize H1 casing on key pages (`who we are`, `content hub`, `contact us`)
- [ ] Ensure one clear H1 per page; keep brand voice consistent

### 6. robots.txt & crawl hygiene
- [ ] Current `robots.txt` is only `User-agent: *` + `Crawl-delay: 10` — **add Sitemap:** lines for Yoast sitemaps
- [ ] Confirm junk URLs are excluded after noindex
- [ ] Reconsider crawl-delay if Search Console shows crawl issues (often unnecessary on modern hosting)

---

## P1 — Next sprint (strong wins)

### 7. Complete Yoast for all News + Partner Stories
- [ ] Apply remaining CSV rows (`priority=P1`)
- [ ] In Yoast: set focus keyphrase, check keyphrase in intro + H1 where natural
- [ ] Add unique OG title/description (don’t leave social sharing on placeholders)

### 8. Slug & spelling clean-up (with 301s)
- [ ] `/tales-of-resistence/` → rename to `/tales-of-resilience/` + 301 (typo hurts SEO/AEO)
- [ ] `/news/field-visit-in-columbia-…` → Colombia spelling + 301
- [ ] Review `/news/trafigura-foundation-2025-annual-report-2/` slug (`-2` looks accidental)

### 9. Internal linking
- [ ] From homepage + Areas of Work, link to the 3 pillars with exact-match anchors
- [ ] From each partner story: link to related Area of Work + 1–2 related news pieces
- [ ] From news “new partnership” posts: link to the live partner story page
- [ ] Add a clear path: Content Hub → News / Partner Stories / Publications

### 10. Structured data (beyond basic Yoast WebPage)
- [ ] `Organization` / `NGO` or `FundingScheme` accuracy (name, logo, sameAs LinkedIn, address Geneva)
- [ ] `NewsArticle` / `Article` on news posts (author, datePublished, image)
- [ ] `BreadcrumbList` on all nested URLs
- [ ] PDF publications: consider `DigitalDocument` or dedicated publication pages with metadata

### 11. Performance & Core Web Vitals (W3TC + theme)
- [ ] Audit LCP on homepage / partner stories (hero images, fonts)
- [ ] Lazy-load below-fold media; compress large report thumbnails
- [ ] Reduce unused Elementor/JS on archive pages if heavy

### 12. Search Console hygiene
- [ ] Submit updated sitemaps
- [ ] Inspect “do not delete” / Elementor URLs → Request removal if indexed
- [ ] Monitor duplicate title/description reports after Yoast bulk update

---

## P2 — Ongoing content SEO

- [ ] Refresh outdated job posts (Investment Manager / Programme Manager) — noindex if closed, or add “Closed” clearly
- [ ] Standardise partner story intro: problem → geography → approach → Trafigura Foundation role → outcomes
- [ ] Add FAQ blocks on pillar pages (also feeds AEO — see `AEO-recommendations.md`)
- [ ] Build topic clusters: Climate adaptation · Blue economy · Anticipatory action · Informal settlements · Nature-based solutions
- [ ] Ensure every annual report / strategy PDF has an HTML landing page with summary + download (indexable text > PDF-only)

---

## Quick verification (after each batch)

- [ ] View-source: `<title>`, `meta name="description"`, canonical, robots
- [ ] Rich Results / schema validator on 1 home + 1 news + 1 partner
- [ ] Sitemap no longer lists noindexed junk
- [ ] Spot-check Google: `site:trafigurafoundation.org "do not delete"` → should go to zero

---

## Evidence snapshot from audit

| Issue | Examples |
|---|---|
| Placeholder meta | `/`, `/partners-stories/`, `/partner-stories/` |
| Generic org meta reused | Most news + many partner stories |
| Indexable junk | `/do-not-delete/`, `/do-not-delete-4/`, `/news/elementor-35238/` |
| Archive H1 wrong | `/news/`, `/partner-stories/` use homepage H1 |
| Competing URLs | `areas-of-work` vs `area-of-work`; `partners-stories` vs `partner-stories` |
| Typos in slugs | `resistence`, `columbia` |
| Weak robots.txt | No sitemap declaration |

CSV columns to use in Yoast: `focus_keyphrase`, `seo_title`, `meta_description`, `recommended_robots`.
