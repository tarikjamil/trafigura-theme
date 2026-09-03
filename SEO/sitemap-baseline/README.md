# Sitemap baseline & monthly diff

**Purpose:** track client-side content edits (new / removed / slug-changed URLs) by comparing the live Yoast sitemap to the last saved snapshot.

**Baseline date:** 2 Sep 2026  
**Source:** https://trafigurafoundation.org/sitemap_index.xml

## Current counts (baseline)

| Sitemap | URLs |
|---|---:|
| page | 8 |
| area-of-work | 3 |
| news | 62 |
| partner-stories | 41 |
| **Total** | **114** |

## Files

| File | Purpose |
|---|---|
| `summary.json` | Counts + baseline date |
| `all-urls.csv` | Full URL list (`url,type,lastmod`) |
| `page.csv` | Page sitemap only |
| `news.csv` | News sitemap only |
| `partner-stories.csv` | Partner sitemap only |
| `area-of-work.csv` | Areas sitemap only |
| `CHANGELOG.md` | Human-readable history of diffs |
| `compare.sh` | Fetch live sitemap + diff vs baseline |

## Monthly workflow (end of month)

1. You say: *“Recheck the sitemap for September”* (or send Looker PDF + sitemap ask together).
2. Agent runs `compare.sh` (or equivalent crawl).
3. Output goes into:
   - `SEO/sitemap-baseline/diffs/YYYY-MM.md` — added / removed / lastmod-changed
   - Monthly client report appendix (`SEO/monthly-reports/YYYY-MM.md` § Sitemap changes)
4. If the month had changes, agent updates `all-urls.csv` + child CSVs and bumps `summary.json` **after you confirm** (or automatically if only additions).

## What we flag

| Change type | Meaning |
|---|---|
| **Added** | New URL in sitemap (new page/post/partner) |
| **Removed** | Was in baseline, gone from sitemap (unpublish, noindex, delete) |
| **Lastmod changed** | Same URL, `lastmod` moved since baseline (likely edit) |
| **Slug change** | Removed + added pair — check live 301 |

## SEO follow-ups on every diff

For each **added** URL, check:
- Unique Yoast title + meta description (not default “Established in 2007…”)
- Facebook OG description blank or aligned
- Indexed as intended (`index, follow` vs noindex)
- Internal links from hub / related content where relevant

For each **removed** URL:
- Still live? → intentional noindex vs accidental
- 301 in place if slug moved

## Historical note (Aug → Sep baseline)

See `CHANGELOG.md` for the diff that produced this baseline vs the 14 Aug 2026 audit (9 pages · 60 news · 39 partners).
