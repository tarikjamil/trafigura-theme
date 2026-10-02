# Shipped in October 2026 — include in the October client report

Logged so the October draft (`2026-10-client.md`) picks this up. Not for the September PDF.

## Who We Are — mobile speed (2 Oct 2026)

Page: `https://trafigurafoundation.org/who-we-are/`

The **90 / 3.4 s** run is not the baseline. That was after the first round of edits. Use the table below as the starting point.

### Initial lab test (before those edits)

PageSpeed Insights, report from 2 Oct 2026, 14:10.

| | Mobile | Desktop |
|---|---:|---:|
| Performance | 76 | 99 |
| Accessibility | 96 | 96 |
| Best practices | 100 | 100 |
| SEO | 100 | 100 |
| Largest Contentful Paint | 3.8 s | 0.8 s |
| First Contentful Paint | 2.6 s | 0.5 s |
| Speed Index | 4.8 s | 0.7 s |
| Total Blocking Time | 260 ms | 30 ms |
| Cumulative Layout Shift | 0 | 0 |

**What the initial audit showed**

- The hero was the LCP image, and the cache plugin was hiding it: `class="lazy"`, `data-src` / `data-srcset` instead of a real `src`, no `fetchpriority="high"`, and “request is discoverable in initial document” failed. The browser could not start the image until JavaScript ran.
- That hidden file was still the ~112 KB banner (`01.WHO-WE-ARE_101.WHO-WE-ARE.webp`), not the 17 KB mobile file.
- The “3.9 billion” graphic (`TF-3.9.jpg`) was a 768px JPEG at ~61 KB for a slot about 368px wide. The media-library original is ~842 KB.
- Mobile render-blocking scripts were estimated at about 2,070 ms (theme staging JS, GSAP, ScrollTrigger, jQuery). Desktop render-blocking was about 290 ms. Critical-path latency on the slow run was 443 ms, mostly the CSS file then the Euclid font.

### After the edits already on the site (still before the smaller-file change)

Same day, later run. This is the 90 result — do not describe it as the starting point.

| | Mobile | Desktop |
|---|---:|---:|
| Performance | 90 | 99 |
| Largest Contentful Paint | 3.4 s | 0.7 s |
| First Contentful Paint | 1.4 s | 0.4 s |
| Speed Index | 2.2 s | 0.6 s |
| Total Blocking Time | 140 ms | 90 ms |
| Cumulative Layout Shift | 0 | 0 |

That pass stopped the cache plugin lazy-loading the hero (`no-lazy`, `fetchpriority="high"`, `decoding="sync"`, mobile preload of the 17 KB file, critical hero CSS in the head). The phone was still downloading the 112 KB file, because the editor `srcset` pointed every width at it.

### After the smaller hero file went live (2 Oct 2026, 15:15)

PageSpeed Insights, mobile, Slow 4G, Moto G Power. The hero request is now `01.WHO-WE-ARE-800.webp` at **16.7 KB**, with `fetchpriority="high"`, `no-lazy`, and `decoding="sync"`. The “3.9 billion” image is `TF-3.9-800.webp` at 43 KB.

| | Mobile |
|---|---:|
| Performance | 87 |
| Accessibility | 96 |
| Best practices | 100 |
| SEO | 100 |
| Largest Contentful Paint | 2.8 s |
| First Contentful Paint | 2.3 s |
| Speed Index | 4.8 s |
| Total Blocking Time | 190 ms |
| Cumulative Layout Shift | 0 |

No desktop re-test in this run. Last desktop figure remains 99 / 0.8 s, then 99 / 0.7 s.

**How to tell it in the report.** LCP is the number that moved for the right reason: 3.8 s → 3.4 s → **2.8 s**, and the phone now loads a 17 KB banner instead of 112 KB. The performance score (76 → 90 → 87) bounced because first paint and Speed Index vary between lab runs (2.3 s and 4.8 s on this one). Do not describe 87 as a step backwards from 90, and do not quote 90 as the final score.

**Still flagged, leave out of the client PDF unless we do more work.** Render-blocking CSS (~330 ms, estimated 950 ms). Critical path 528 ms, mostly the stylesheet then three Euclid font files. Unused JavaScript is mostly Google Tag Manager (~131 KB). PSI still wants the 43 KB “3.9 billion” WebP smaller for a ~368px-wide slot, and another ~10 KB off the 17 KB hero. Neither is what set LCP.

### Client wording (draft — October §01 / §06)

Who We Are started the month slow on a phone: performance 76, about 3.8 seconds to the main image, against under a second on desktop. The banner was held back until scripts ran, and the phone then downloaded a large file we already had in a much smaller size. We made the image available immediately, then pointed the page at the smaller file (about 17 KB). On the latest phone test the wait is **2.8 seconds**. The headline score on that run was 87. Desktop stays at 99.
