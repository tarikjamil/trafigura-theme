# Sitemap changelog

## 2026-09-22 — Mid-month recrawl (vs 2 Sep baseline)

**Tracked sitemaps:** page 8→**9** · areas 3 · news 62→**63** · partners 41 · **total 114→116**

Live `sitemap_index.xml` also added `voices-of-impact-sitemap.xml` (9) and `staff-locations-sitemap.xml` (15). Those URLs 301 to `/staff-engagement/` and should be sitemap-excluded.

### Added (indexable)
- `/puma-energy-fund/` — new hub (21 Sep). Generic 2007 meta.
- `/news/against-the-current/` — new news (21 Sep). Generic 2007 meta.

### Edited
- `/staff-engagement/` — redesign live (voices + map), lastmod 22 Sep
- `/partner-stories/comaco/` — lastmod 3 Sep

### Not added to baseline
Voices of Impact + Staff locations CPT URLs (redirect-only). Puma CPT archive empty/404.

Full notes: `diffs/2026-09.md`.

---

## 2026-09-02 — Baseline established

Snapshot saved as `all-urls.csv` + per-type CSVs. **114 URLs** total.

Compared to **14 Aug 2026** audit (9 pages · 60 news · 39 partners · 3 areas = 114):

| Sitemap | Aug 14 | Sep 2 | Δ |
|---|---:|---:|---|
| page | 9 | 8 | −1 |
| area-of-work | 3 | 3 | — |
| news | 60 | 62 | +2 |
| partner-stories | 39 | 41 | +2 |
| **Total** | **114** | **114** | **0** |

### Removed from sitemap
- `https://trafigurafoundation.org/tales-of-resilience/` — still live, `noindex,nofollow`

### Added — news
- `https://trafigurafoundation.org/news/lasting-access-to-safe-water-india-tanzania/` (2026-08-18)
- `https://trafigurafoundation.org/news/new-partnership-to-expand-women-led-water-services-in-northern-ghana/` (2026-08-18)
- `https://trafigurafoundation.org/news/new-partnership-to-make-conservation-profitable-for-communities-in-the-amazon/` (2026-09-02)

### Added — partner stories
- `https://trafigurafoundation.org/partner-stories/instituto-jurua/`
- `https://trafigurafoundation.org/partner-stories/saha-global/`
- `https://trafigurafoundation.org/partner-stories/water-for-people/`

### Slug cleanups (301s, old slug out of sitemap)
- `plan-vivo-foundation-2` → `plan-vivo-foundation`
- `planet-indonesia-2` → `planet-indonesia-2024`
- Root Capital numbered slugs → regional slugs (Peru / Central America)

---

## Template for future entries

```markdown
## YYYY-MM-DD — Monthly diff (vs previous baseline)

**Counts:** page X · areas 3 · news Y · partners Z · total N

### Added
- URL — type — note

### Removed
- URL — note (noindex / deleted / slug move)

### Edited (lastmod)
- URL — was DATE → now DATE

### SEO actions taken
- …
```
