# Lighthouse / PageSpeed — Before vs After

Site: https://trafigurafoundation.org/ (homepage)

| Lab | When | Notes |
|---|---|---|
| **Before** | 12 Aug 2026 | Pre hero/video/font/GTM pass |
| **After (Aug)** | 14 Aug 2026 | Poster-first + fonts + deferred GTM |
| **Retest (Sep)** | 22 Sep 2026 | After `decoding="sync"` + critical hero CSS in head |

## Screenshots

| File | Device | When |
|---|---|---|
| `after-mobile-2026-08-14.png` | Mobile | 14 Aug |
| `after-desktop-2026-08-14.png` | Desktop | 14 Aug |
| `after-mobile-2026-09-22.png` | Mobile | 22 Sep ~14:04 |
| `after-desktop-2026-09-22.png` | Desktop | 22 Sep ~14:04 |

Sep runs: Chrome Lighthouse 13.5.0, Moto G Power / Desktop, Slow 4G (mobile) / custom (desktop).

---

## Category scores

### Mobile

| Category | 12 Aug | 14 Aug | 22 Sep early* | 22 Sep final |
|---|---:|---:|---:|---:|
| Performance | 60 | **99** | 72 → 88 | **98** |
| Accessibility | 85 | **96** | 96 | **96** |
| Best Practices | 100 | **100** | 100 | **100** |
| SEO | 92 | **100** | 100 | **100** |

\*Same-day lab before / right after `decoding="sync"` + critical hero CSS; variance until cache/W3TC settled. **Final = 98**.

### Desktop

| Category | 14 Aug | 22 Sep |
|---|---:|---:|
| Performance | **100** | **100** |
| Accessibility | **96** | **96** |
| Best Practices | **100** | **100** |
| SEO | **100** | **100** |

---

## Core metrics

### Mobile

| Metric | 12 Aug | 14 Aug | 22 Sep early | 22 Sep final |
|---|---:|---:|---:|---:|
| LCP | 8.7 s | **2.0 s** | 5.7 s → 3.4 s | **2.0 s** |
| FCP | 4.0 s | **1.2 s** | 2.6 s → 1.7 s | **1.4 s** |
| Speed Index | — | **1.7 s** | 5.2 s → 3.4 s | **2.4 s** |
| TBT | 70 ms | **50 ms** | 60 → 160 ms | **120 ms** |
| CLS | 0 | **0** | 0 | **0** |

### Desktop (22 Sep)

| Metric | Value |
|---|---:|
| LCP | **0.5 s** |
| FCP | **0.3 s** |
| Speed Index | **0.9 s** |
| TBT | **60 ms** |
| CLS | **0** |

### LCP breakdown (22 Sep — early same-day)

| Phase | Pre-fix | Notes |
|---|---:|---|
| Resource load duration | ~60 ms | Poster WebP already fast |
| Element render delay | ~2.1 s | Fixed with `decoding="sync"` + critical hero CSS → final LCP **2.0 s** |

---

## What drove the gains

### August 2026
1. Poster-first homepage hero; no autoplay video on mobile (~6.7 MB removed from LCP path)
2. Self-hosted Euclid WOFF2 (400/500/600 only); Bebas local; `font-display: optional`
3. Deferred GTM (interaction / idle); no blocking gtag in head
4. Dequeue unused Elementor / block-library / Roboto; jQuery in footer before GSAP
5. Rem-root in `<head>`; card image sizes / OceanImageBank overrides
6. SEO pass: unique metas, hubs, archive redirects, alts, twitter/OG cleanup

### September 2026 (LCP render delay)
1. Hero poster `decoding="sync"` (was `async` — inflated element render delay)
2. Critical inline CSS in `template-parts/head/front-page.php`: `.section.is--home-hero`, `.hero-image-wrapper` (aspect-ratio), `.img--absolute` so the poster paints before full `trafigura-bundle.css`

---

## Sources

- Before mobile: [PageSpeed 12 Aug](https://pagespeed.web.dev/analysis/https-trafigurafoundation-org/guu4elec5u?hl=en_GB&form_factor=mobile) + local Lighthouse that day  
- After Aug: Chrome Lighthouse screenshots saved here (14 Aug 2026)  
- Retest Sep: Chrome Lighthouse 13.5.0 (22 Sep 2026 — early ~13:30/13:53, final ~14:04)
