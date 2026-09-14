# Client HTML skeleton

Start from last month’s `YYYY-MM-client.md`. Preserve classes; `pdf-style.css` depends on them.

Cover + thanks images (relative to `SEO/monthly-reports/`):

- `assets/cover-hero.jpg`
- `assets/logo-trafigura-foundation-white.png`
- `assets/logo-une-white.png`

## Delta spans

```html
<span class="positive">+1.2%</span>
<span class="negative">−5.1%</span>
<span class="neutral">Stable</span>
<span class="positive">Improved</span>
```

## Blocks

**Section**

```html
<div class="report-section">
<div class="section-header">
<span class="section-num">03</span>
<p class="section-title">How people find Trafigura Foundation</p>
<p class="section-source">Google Search Console · Month Year vs Prior</p>
</div>
<!-- body -->
</div>
```

**Insight**

```html
<div class="insight keep-together">
<p class="insight-title">What this means</p>
<p>…</p>
</div>
```

**Win callout** (only when there is a real highlight)

```html
<div class="win keep-together">
<p class="win-title">Month highlight</p>
<p>…</p>
</div>
```

**Bullet group**

```html
<div class="bullet-block">
<p>Heading</p>
<ul>
<li>…</li>
</ul>
</div>
```

**Table wrapper** (keeps header + rows together)

```html
<div class="keep-together table-block">
| Measure | Month | Prior | Δ MoM |
|---|---:|---:|---|
</div>
```

**Subsection**

```html
<div class="subsection keep-together">
<h3>Compared to Month Year (same month last year)</h3>
…
</div>
```

**Summary KPIs** (four cells)

```html
<div class="kpi-row keep-together">
<div class="kpi">
<div class="kpi-value highlight">99</div>
<div class="kpi-label">Mobile performance</div>
<div class="kpi-delta positive">was 60 · +39 pts</div>
</div>
</div>
```

Use `highlight` on the 1–2 numbers that are the month’s story. `kpi-delta` may be `positive` or `negative`.

## Cover / thanks (replace period + next-month name only)

Cover: `.cover-period`, reporting period, report date. Title stays **Digital Performance Report**. Org stays **Trafigura Foundation**.

Thanks: `We look forward to continuing the work in [NextMonth].` Meta line: `Trafigura Foundation · Digital Performance Report · [Month Year]`.

## Goal section (00)

Keep the four-question list, retune the last bullet’s month name, and write one framing sentence for *this* month (e.g. foundation-building vs content-growth vs polish).

## Content published (02)

Simple one-column tables (Story / Partner), then one sitemap census line:

`Sitemap: N pages in total (X core pages · 3 area pillars · Y news · Z partner stories).`

Note Tales of Resilience only if status changed (still noindex vs newly indexable).
