# Week 1 SEO — Step-by-step checklist

Site: https://trafigurafoundation.org/  
Stack: Yoast SEO (Premium installed, license inactive → use free features) · W3 Total Cache  
Full copy for all 52 P0 URLs: `yoast-meta-all-pages.csv` (filter `priority=P0`)

Tick boxes as you go. Purge W3TC cache after each major section.

---

## Before you start

- [ ] Open WP admin
- [ ] Open `SEO/yoast-meta-all-pages.csv` in Sheets/Excel; filter `priority` = **P0**
- [ ] Confirm Yoast menu appears in the sidebar (license nag is OK to ignore)

---

## Step 1 — Noindex junk (15–20 min)

### 1A. Utility pages

#### `/do-not-delete/`
- [ ] WP admin → **Pages** → find **do not delete**
- [ ] Edit → scroll to **Yoast SEO** → tab **Advanced**
- [ ] **Allow search engines to show this post in search results?** → **No**
- [ ] (Optional) **Should search engines follow links?** → **No**
- [ ] Update

#### `/do-not-delete-4/`
- [ ] Same as above for **do not delete 4**
- [ ] Update

### 1B. Elementor leftover news post

#### `/news/elementor-35238/`
- [ ] **News** → find the Elementor / `elementor-35238` item
- [ ] Edit → Yoast → **Advanced** → show in search results → **No**
- [ ] Update  
  *(Later: republish under a proper slug if the TNC content should stay public.)*

### 1C. Verify + cache
- [ ] Open `https://trafigurafoundation.org/sitemap_index.xml`
- [ ] Open the relevant child sitemaps — junk URLs should be gone
- [ ] **Performance** (W3 Total Cache) → **Purge all caches**
- [ ] If still in Google: Search Console → **Removals** → temporary remove

---

## Step 2 — Pick public hubs (5 min — decisions)

Do this before editing archive settings.

| Competing pair | Keep (index) | Hide (noindex / redirect) |
|---|---|---|
| Areas | **`/areas-of-work/`** (Page) | **`/area-of-work/`** (CPT archive) |
| Partners | **`/partners-stories/`** (Page) | **`/partner-stories/`** (CPT archive) |
| News | **`/content-hub/`** (Page) | **`/news/`** (CPT archive) |

- [ ] Decision locked: Areas hub = `/areas-of-work/`
- [ ] Decision locked: Partners hub = `/partners-stories/`
- [ ] Decision locked: News hub = `/content-hub/`  
  *(Noindex CPT archives is enough for Week 1. Optional 301s later.)*

---

## Step 3 — CPT archives in Yoast Search Appearance (15 min)

Path: **Yoast SEO → Settings** (or **Search Appearance**) → **Content types**

Yoast UI labels may say **Areas of works**, **News**, **Partner Stories** (matches your sidebar).

### 3A. Areas of works archive → NOINDEX
- [ ] Open **Areas of works** (or equivalent CPT)
- [ ] **Show this type in search results?** / archive visibility → **No**  
  (This noindexes `https://trafigurafoundation.org/area-of-work/`)
- [ ] Save

### 3B. News archive → NOINDEX
- [ ] Open **News** content type
- [ ] **Show this type in search results?** / archive visibility → **No**  
  (Public news listing is `/content-hub/`, not `/news/`)
- [ ] Save

### 3C. Partner Stories archive → NOINDEX
- [ ] Open **Partner Stories** content type
- [ ] **Show this type in search results?** / archive visibility → **No**  
  (Public partners listing is `/partners-stories/`, not `/partner-stories/`)
- [ ] Save

### 3D. Cache
- [ ] Purge W3 Total Cache
- [ ] Spot-check View Source on `/news/`, `/partner-stories/`, and `/area-of-work/` for `noindex`

---

## Step 4 — Paste Yoast on core pages & pillars (30–45 min)

For each URL: open in WP → Yoast sidebar/metabox → paste **Focus keyphrase**, **SEO title**, **Meta description** → Update.

### 4A. Homepage `/`
- [ ] Focus keyphrase: `climate adaptation funding`
- [ ] SEO title: `Trafigura Foundation | Climate Adaptation Funding`
- [ ] Meta description: `We invest in solutions for communities and ecosystems most vulnerable to climate change, funding partners that help people and nature adapt.`

### 4B. `/who-we-are/`
- [ ] Focus keyphrase: `Trafigura Foundation climate adaptation`
- [ ] SEO title: `Trafigura Foundation | Who We Are`
- [ ] Meta description: `We invest in catalytic solutions for resilient communities and ecosystems, closing the adaptation finance gap as needs near USD 340 billion a year by 2030.`

### 4C. `/our-approach/`
- [ ] Focus keyphrase: `climate adaptation funding approach`
- [ ] SEO title: `Our Approach to Climate Adaptation | Trafigura Foundation`
- [ ] Meta description: `We organise multi-year collective action and catalytic funding so climate adaptation solutions scale for vulnerable communities and ecosystems.`

### 4D. `/areas-of-work/` (public hub)
- [ ] Focus keyphrase: `climate adaptation areas of work`
- [ ] SEO title: `Areas of Work | Trafigura Foundation`
- [ ] Meta description: `Our climate adaptation work spans three linked areas: sustainable livelihoods, thriving nature, and prepared communities facing climate risk.`

### 4E. Pillars (Areas of works CPT)
#### Sustainable Livelihoods
- [ ] Focus: `climate resilient MSMEs`
- [ ] Title: `Sustainable Livelihoods | Trafigura Foundation`
- [ ] Meta: `We support MSMEs and jobs for climate-resilient livelihoods; micro, small and medium enterprises generate up to 33% of GDP in developing countries.`

#### Thriving Nature
- [ ] Focus: `ecosystem-based adaptation`
- [ ] Title: `Thriving Nature | Trafigura Foundation`
- [ ] Meta: `We fund ecosystem management and restoration so local communities can steward nature and adapt to climate change through nature-based solutions.`

#### Prepared Communities
- [ ] Focus: `disaster risk reduction`
- [ ] Title: `Prepared Communities | Trafigura Foundation`
- [ ] Meta: `We fund disaster risk reduction so communities can prepare for climate shocks via early warning systems, resilience-building and nature-based solutions.`

### 4F. `/content-hub/`
- [ ] Focus: `Trafigura Foundation content hub`
- [ ] Title: `Content Hub | Trafigura Foundation`
- [ ] Meta: `News, insights and publications on Foundation partnerships—from blue economy investments to climate-resilient businesses and coastal blue carbon.`

### 4G. `/partners-stories/` (public hub)
- [ ] Focus: `Trafigura Foundation partners`
- [ ] Title: `Our Partners | Trafigura Foundation`
- [ ] Meta: `Browse partners advancing climate resilience—from Sumatoria and COMACO to The HALO Trust, Blue Catalyst Fund and The Nature Conservancy.`

### 4H. Verify one page
- [ ] View Source on homepage: correct `<title>` + `meta name="description"`
- [ ] Purge W3TC

---

## Step 5 — robots.txt Sitemap line (5–10 min)

- [ ] Open live: `https://trafigurafoundation.org/robots.txt` (note current contents)
- [ ] WP → **Yoast SEO → Tools → File editor**
- [ ] If no robots.txt yet → **Create robots.txt file**
- [ ] Set contents to (adjust only if you have other intentional rules):

```txt
User-agent: *
Crawl-delay: 10

Sitemap: https://trafigurafoundation.org/sitemap_index.xml
```

- [ ] Save
- [ ] Reload `/robots.txt` — confirm `Sitemap:` line is visible
- [ ] Purge W3TC if the old file is cached
- [ ] Google Search Console → **Sitemaps** → submit `sitemap_index.xml` if not already added

If **File editor** is missing: edit `robots.txt` on the server (FTP/cPanel) in the site root.

---

## Step 6 — Remaining P0 URLs from the CSV (60–90 min)

Filter CSV: `priority=P0` and work top to bottom.

### 6A. P0 News (~32 posts)
- [ ] For each News URL in CSV: paste focus keyphrase + SEO title + meta description
- [ ] Skip `/news/elementor-35238/` (already noindexed in Step 1)

### 6B. P0 numbered Partner Stories (canonicals)
These may be duplicates. For each:

| URL | Action |
|---|---|
| `/partner-stories/plan-vivo-foundation-2/` | Paste Yoast from CSV **or** set Canonical to primary Plan Vivo URL |
| `/partner-stories/planet-indonesia-2/` | Same vs primary Planet Indonesia |
| `/partner-stories/root-capital-3/` | Paste if distinct programme; else canonical to primary |
| `/partner-stories/root-capital-4/` | Same |
| `/partner-stories/the-international-rescue-committee-irc-2/` | Same vs primary IRC |
| `/partner-stories/the-nature-conservancy-2/` | Same vs primary TNC |

Canonical path in Yoast: **Advanced → Canonical URL** → paste the primary public URL.

- [ ] All 6 reviewed (meta updated and/or canonical set)

### 6C. Cache + spot-check
- [ ] Purge W3TC
- [ ] Spot-check 3 random P0 news posts in View Source

---

## Step 7 — Week 1 done gate

- [ ] Junk URLs noindexed and absent from sitemap
- [ ] `/area-of-work/` archive noindexed; `/areas-of-work/` is the public hub
- [ ] `/partners-stories/` has unique Yoast fields
- [ ] Homepage + who-we-are + approach + content-hub + 3 pillars updated
- [ ] `/robots.txt` includes `Sitemap: https://trafigurafoundation.org/sitemap_index.xml`
- [ ] W3TC purged
- [ ] Search Console sitemap submitted / refreshed

### Not in Week 1 (normal)
- [ ] Theme H1 fix for `/news/` archive (`archive.php`) — **Week 2**
- [ ] 301 redirects between hub pairs — needs Redirection plugin or server rules
- [ ] P1 CSV rows (remaining news/partners)
- [ ] `llms.txt` / FAQ schema — **Week 3 / AEO**

---

## Quick reference — Yoast click paths

| Task | Path |
|---|---|
| Noindex one page/post | Edit item → Yoast → **Advanced** → show in search → **No** |
| Archive title/noindex | Yoast → **Settings / Search Appearance** → **Content types** |
| robots.txt | Yoast → **Tools** → **File editor** |
| Canonical | Edit item → Yoast → **Advanced** → Canonical URL |
| Purge cache | W3 Total Cache → Purge all caches |

When stuck, use the matching row in `yoast-meta-all-pages.csv` (`focus_keyphrase`, `seo_title`, `meta_description`, `recommended_robots`).
