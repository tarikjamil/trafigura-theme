# Lighthouse / PageSpeed — Before vs After

Site: https://trafigurafoundation.org/ (homepage)  
**Before:** 12 Aug 2026 lab (PageSpeed + local Lighthouse) — pre hero/video/font/GTM pass  
**After:** 14 Aug 2026 Chrome DevTools Lighthouse screenshots (this folder)

## Screenshots (after)

| File | Device |
|---|---|
| `after-mobile-2026-08-14.png` | Mobile |
| `after-desktop-2026-08-14.png` | Desktop |

## Category scores

### Mobile

| Category | Before (12 Aug) | After (14 Aug) | Δ |
|---|---:|---:|---:|
| Performance | 60 | **99** | +39 |
| Accessibility | 85 | **96** | +11 |
| Best Practices | 100 | **100** | — |
| SEO | 92 | **100** | +8 |

### Desktop

| Category | Before (mid-pass lab ~12 Aug)* | After (14 Aug) | Δ |
|---|---:|---:|---:|
| Performance | ~67 | **100** | +33 |
| Accessibility | — | **96** | — |
| Best Practices | — | **100** | — |
| SEO | — | **100** | — |

\*Desktop was not captured as a full day-one baseline; ~67 was a mid-optimization lab run after early mobile fixes. Treat mobile as the primary SEO CWV signal.

## Core metrics (mobile)

| Metric | Before | After | Δ |
|---|---:|---:|---:|
| LCP | 8.7 s | **2.0 s** | −6.7 s |
| FCP | 4.0 s | **1.2 s** | −2.8 s |
| Speed Index | — | **1.7 s** | — |
| TBT | 70 ms | **50 ms** | −20 ms |
| CLS | 0 | **0** | — |

## Core metrics (desktop — after)

| Metric | After (14 Aug) |
|---|---:|
| LCP | **0.7 s** |
| FCP | **0.4 s** |
| Speed Index | **0.5 s** |
| TBT | **30 ms** |
| CLS | **0** |

## What drove the gains

1. Poster-first homepage hero; no autoplay video on mobile (~6.7 MB removed from LCP path)
2. Self-hosted Euclid WOFF2 (400/500/600 only); Bebas local; `font-display: optional`
3. Deferred GTM (interaction / idle); no blocking gtag in head
4. Dequeue unused Elementor / block-library / Roboto; jQuery in footer before GSAP
5. Rem-root in `<head>`; card image sizes / OceanImageBank overrides
6. SEO pass: unique metas, hubs, archive redirects, alts, twitter/OG cleanup

## Sources

- Before mobile: [PageSpeed 12 Aug](https://pagespeed.web.dev/analysis/https-trafigurafoundation-org/guu4elec5u?hl=en_GB&form_factor=mobile) + local Lighthouse that day  
- After: Chrome Lighthouse screenshots saved here (14 Aug 2026)
