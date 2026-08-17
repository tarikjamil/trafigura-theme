# SEO / AEO pack — Trafigura Foundation

Last updated: **14 Aug 2026** (Lighthouse before/after + technical SEO pass).  
Scope: full Yoast sitemap — **114 URLs**.

## Files

| File | Purpose |
|---|---|
| `yoast-meta-all-pages.csv` | Focus keyphrase + SEO title + meta description for every sitemap URL (content-based), plus current live values and notes |
| `CHECKLIST-big-wins.md` | Prioritised implementation checklist after technical/content audit |
| `AEO-recommendations.md` | Answer Engine Optimization roadmap (AI Overviews, ChatGPT, Perplexity, etc.) |
| `lighthouse/BEFORE-AFTER.md` | Homepage Lighthouse before (12 Aug) vs after (14 Aug) scores + metrics |
| `lighthouse/after-mobile-2026-08-14.png` | After screenshot — mobile |
| `lighthouse/after-desktop-2026-08-14.png` | After screenshot — desktop |

## How the CSV was generated (v2)

1. Re-crawled every sitemap URL.
2. Extracted H1, H2s and body paragraphs (nav/footer filtered out).
3. Wrote **SEO title + meta description + focus keyphrase from page content** (partners, places, mechanisms, stats only when present on-page).
4. Tuned for SEO + AEO: answer-first metas (~140–155 chars), unique titles (~≤65 chars), no generic “Established in 2007…” boilerplate.

Column `content_source` shows which extract facts grounded each draft.

## How to use the CSV in Yoast

1. Open `yoast-meta-all-pages.csv` in Excel / Google Sheets.
2. Filter `priority` = **P0** first.
3. For each URL, in WP admin → Yoast:
   - Focus keyphrase
   - SEO title
   - Meta description
   - If `recommended_robots` = `noindex, follow` → Yoast advanced → noindex
4. Then process **P1** (remaining news + partners).

Columns:
- `focus_keyphrase`, `seo_title`, `meta_description` → paste into Yoast  
- `content_source` → grounding note from the crawl  
- `current_*` → what is live today (for QA)  
- `issues_notes` → structural / slug / QA flags  

## Biggest findings (summary)

1. Homepage (and partners page) still have **placeholder meta about writing meta descriptions**.  
2. Many news/partner pages reuse the same **generic 2007 org blurb**.  
3. Utility pages (`do-not-delete`, Elementor leftover) are **indexable in the sitemap**.  
4. Competing URL pairs: `areas-of-work` vs `area-of-work`, `partners-stories` vs `partner-stories`.  
5. Archives reuse the **homepage H1**.  
6. No `llms.txt`; robots.txt has no Sitemap declaration.  
7. Slug mismatches remain (e.g. `/news/trafigura-foundation-2022-annual-report/` is actually the **2020** report).
