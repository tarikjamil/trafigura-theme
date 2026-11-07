# Lighthouse audit — 7 Nov 2026

Local Lighthouse 12, Chrome headless, `--throttling-method=devtools`.  
16 URLs = all indexable hub pages + 3 area pillars + 2 news + 2 partner samples (CPT templates).  
Raw CSV: `lighthouse-full-2026-11-07.csv`.

## Mobile (lab)

| Page | Perf | A11y | BP | SEO | LCP | FCP | TBT | CLS |
|---|---:|---:|---:|---:|---:|---:|---:|---:|
| Who We Are | **95** | 96 | 100 | 100 | 2.3s | 2.3s | 77 | 0 |
| Home | **94** | 96 | 100 | 100 | 2.5s | 2.5s | 81 | 0 |
| Our Approach | **88** | 96 | 100 | 100 | 3.1s | 3.0s | 95 | 0 |
| Sustainable Livelihoods | **87** | 91 | 100 | 100 | 3.3s | 2.8s | 97 | 0.01 |
| News — Invisible Barrier | **85** | 92 | 100 | 92 | 3.3s | 3.3s | 93 | 0 |
| Prepared Communities | **84** | 91 | 100 | 100 | 3.6s | 3.0s | 85 | 0 |
| Puma Energy Fund | **83** | 94 | 100 | 100 | 4.0s | 2.1s | 61 | 0 |
| Thriving Nature | **81** | 91 | 100 | 100 | 3.8s | 3.2s | 90 | 0.02 |
| Partners Stories (hub) | **80** | 96 | 100 | 100 | 4.4s | 2.3s | 64 | 0 |
| Areas of Work (hub) | **76** | 96 | 100 | 100 | 5.2s | 2.0s | 62 | 0 |
| News — Wetlands | **75** | 90 | 100 | 100 | 4.9s | 3.2s | 83 | 0 |
| Staff Engagement | **73** | 90 | 100 | 100 | 4.9s | 3.1s | 65 | 0 |
| Partner — COMACO | **73** | 93 | 96 | 100 | 5.0s | 3.3s | 81 | 0 |
| Partner — Catalyst Fund | **73** | 93 | 96 | 100 | 5.0s | 3.2s | 87 | 0 |
| Contact | **73** | 93 | 100 | 92 | 6.5s | 1.7s | 64 | 0 |
| Content Hub | **72** | 96 | 100 | 100 | 6.3s | 2.4s | 62 | 0 |

**Median mobile Perf ≈ 80. Median LCP ≈ 4.0s.**  
TBT is fine everywhere (<100 ms). CLS is fine. Bottleneck = **LCP** (hero / featured image + TTFB ~0.7–1.0s).

## Desktop (lab)

All pages **90–100** Perf. LCP ≤ 0.9s. Home 90 (CLS-free). Puma CLS 0.10 on desktop only.

## Priority fixes (mobile)

1. **Contact + Content Hub heroes** — LCP 6.3–6.5s. Same pattern as Who We Are / Our Approach: hardcode smaller WebP srcset (800 / 1080 / 1440) + mobile preload. Today they still use large theme assets with `sizes=…2260px`.
2. **Areas of Work hub hero** — LCP 5.2s; same WebP treatment.
3. **Staff Engagement hero** — still uploads JPEG (`Compressed-Imag…`); convert + sized WebP like Who We Are.
4. **Partner / news featured images** — LCP ~5s; next-gen formats + responsive sizes (uploads still heavy JPEG/PNG).
5. **TTFB** — Lighthouse “Reduce initial server response time” ~0.7–1.0s on most URLs (hosting/CDN/W3TC, not theme CSS).

## Non-perf notes

- **SEO 92** on Contact + Invisible Barrier: “Links do not have descriptive text” (likely “Learn more” / bare CTA).
- **A11y ~90–96**: colour-contrast (brand greens on light), occasional form labels (Contact), ARIA children on Staff Engagement Swiper, redundant alt on staff cards.
- Partner BP 96: minor HTTPS / console / third-party noise.

## Not audited

Full sitemap (~123 URLs). Remaining news/partner singles share the same templates as the four samples above. Tales CPT / staff-locations are noindex redirects — skipped.

## Post-deploy recheck (7 Nov 2026, same lab settings)

| Page | Perf before → after | LCP before → after |
|---|---|---|
| Contact | 73 → **93** | 6.5s → **2.6s** |
| Content Hub | 72 → **94** | 6.3s → **2.5s** |
| Areas of Work | 76 → **95** | 5.2s → **2.4s** |
| Partners Stories | 80 → **96** | 4.4s → **2.3s** |
| Puma Energy Fund | 83 → **94** | 4.0s → **2.5s** |
| Staff Engagement | 73 → **83** | 4.9s → **3.6s** |

View-source confirmed real WebP `src` + 800 preload on all six (no W3TC SVG). Staff still heavier (voices/map JS + larger hero photo).
