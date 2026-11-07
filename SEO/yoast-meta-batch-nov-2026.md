# Yoast batch — November 2026

Paste into each URL: **Yoast → SEO title** + **Meta description**.  
British English. Copied from the page’s own wording — no new claims.  
Aim: title ≤ ~60 characters before the brand pipe; description 145–155 characters, **no trailing ellipsis**.

Brand suffix in Yoast template is usually `%%title%% %%page%% %%sep%% %%sitename%%` — if the site already appends `— Trafigura Foundation` / `| Trafigura Foundation`, paste **only the left part** in the SEO title field.

---

## A. Incomplete / weak descriptions (fix first)

### 1. `/news/breaking-the-invisible-barrier/`

| Field | Current | Proposed |
|---|---|---|
| SEO title | Breaking the Invisible Barrier — Trafigura Foundation | Amanda’s Mental Health Fun Run \| Trafigura Foundation |
| Meta description | …help bring their… *(cut off)* | Staff story: Amanda turns a family fun run into a movement against mental-health stigma, backed by Trafigura Foundation staff engagement. |

**Focus keyphrase (optional):** mental health stigma staff engagement

---

### 2. `/news/generating-revenue-from-conservation-to-build-resilience-in-coastal-kenya/`

| Field | Current | Proposed |
|---|---|---|
| SEO title | Generating Revenue From Conservation… *(96 chars, long)* | Coastal Kenya Field Visit \| Trafigura Foundation |
| Meta description | …environment more… *(cut off)* | Field visit to Plan Vivo mangrove and seagrass projects near Mombasa and Vanga, where coastal communities earn from conservation and build climate resilience. |

**Focus keyphrase:** Plan Vivo Kenya mangroves

---

### 3. `/news/when-the-rain-stopped-coming-bringing-anticipatory-action-to-life-in-zimbabwe/`

| Field | Current | Proposed |
|---|---|---|
| SEO title | When the Rain Stopped Coming: Turning Climate Forecasts into Early Action — … *(long)* | Anticipatory Action in Zimbabwe \| Trafigura Foundation |
| Meta description | …to see how… *(cut off)* | Film with Start Network: how communities in Zimbabwe use climate forecasts to prepare for drought before it becomes a humanitarian crisis. |

**Focus keyphrase:** anticipatory action Zimbabwe

---

### 4. `/news/our-partner-forum-at-new-york-climate-week/`

| Field | Current | Proposed |
|---|---|---|
| SEO title | Our Partner Forum at New York Climate Week — Trafigura Foundation | Partner Forum at NYC Climate Week \| Trafigura Foundation |
| Meta description | …Watch the video and read… *(cut off)* | At New York Climate Week, 24 partners from the Trafigura Foundation and Puma Energy Fund networks met to ask what it takes to build lasting resilience. |

**Focus keyphrase:** New York Climate Week partners

---

### 5. `/news/new-impact-investments-for-climate-resilience-in-africa-and-island-states/`

| Field | Current | Proposed |
|---|---|---|
| SEO title | New Impact Investments for Climate Resilience in Africa and Small Island States — … *(long)* | Catalyst Fund & Outrigger Investments \| Trafigura Foundation |
| Meta description | …world’s most exposed… *(cut off)* | Two new impact investments: Catalyst Fund for African climate entrepreneurs, and Outrigger for nature-positive businesses in small island states. |

**Focus keyphrase:** impact investments climate resilience

---

### 6. `/partner-stories/outrigger/`

| Field | Current | Proposed |
|---|---|---|
| SEO title | Outrigger — Trafigura Foundation | Outrigger Impact Fund \| Trafigura Foundation |
| Meta description | …social and environmental… *(cut off)* | Outrigger Impact Fund backs early- and growth-stage blue economy businesses in Small Island Developing States building climate and nature resilience. |

**Focus keyphrase:** Outrigger Impact Fund SIDS

---

### 7. `/partner-stories/catalyst-fund/`

| Field | Current | Proposed |
|---|---|---|
| SEO title | Catalyst Fund — Trafigura Foundation | Catalyst Fund Africa \| Trafigura Foundation |
| Meta description | …in sectors from… *(cut off)* | Catalyst Fund is an early-stage VC and venture builder helping African founders scale tech-enabled climate adaptation and resilience businesses. |

**Focus keyphrase:** Catalyst Fund Africa climate  
*(Helps stop AI tools reading the card as “New Catalyst Fund”.)*

---

## B. CTR fixes (high impressions, low clicks)

### 8. `/partner-stories/comaco/` — ~3 960 imp., CTR 0,56 % (`trafigura zambia`)

| Field | Current | Proposed |
|---|---|---|
| SEO title | COMACO Zambia \| Trafigura Foundation | Trafigura Foundation & COMACO in Zambia |
| Meta description | *(OK length, keep spirit, sharpen Zambia)* | In Zambia, the Trafigura Foundation partners with COMACO on chemical-free farming, It's Wild! markets, carbon credits and rural livelihoods. |

---

### 9. `/news/new-partnership-to-make-conservation-profitable-for-farming-families-in-zambia/` — ~1 129 imp., CTR 0,18 %, pos. ~1,3

| Field | Current | Proposed |
|---|---|---|
| SEO title | Conservation Farming for Zambian Families \| Trafigura Foundation | Trafigura Foundation Partners with COMACO in Zambia |
| Meta description | Partnering with COMACO… | New Trafigura Foundation partnership with COMACO: climate-resilient farming for Zambian families, premium markets and ecosystem restoration. |

---

### 10. `/news/wetlands-a-secret-weapon-against-climate-change/` — ~2 659 imp., CTR 0,30 % (`wetlands climate`)

| Field | Current | Proposed |
|---|---|---|
| SEO title | Wetlands & Climate \| Trafigura Foundation | Why Wetlands Matter for Climate \| Trafigura Foundation |
| Meta description | Wetlands act as carbon sinks… Pacific Northwest… | Wetlands store carbon and buffer extreme weather. Insight on why these ecosystems matter for climate resilience — and what new research reveals. |

---

## Character counts (proposed)

| # | SEO title (with brand) | ≈ chars | Meta ≈ |
|---|---|---:|---:|
| 1 | Amanda’s Mental Health Fun Run \| Trafigura Foundation | 52 | 148 |
| 2 | Coastal Kenya Field Visit \| Trafigura Foundation | 48 | 155 |
| 3 | Anticipatory Action in Zimbabwe \| Trafigura Foundation | 54 | 143 |
| 4 | Partner Forum at NYC Climate Week \| Trafigura Foundation | 55 | 155 |
| 5 | Catalyst Fund & Outrigger Investments \| Trafigura Foundation | 58 | 148 |
| 6 | Outrigger Impact Fund \| Trafigura Foundation | 44 | 148 |
| 7 | Catalyst Fund Africa \| Trafigura Foundation | 43 | 140 |
| 8 | Trafigura Foundation & COMACO in Zambia | 39 | 138 |
| 9 | Trafigura Foundation Partners with COMACO in Zambia | 52 | 142 |
| 10 | Why Wetlands Matter for Climate \| Trafigura Foundation | 53 | 148 |

---

## After publishing in Yoast

1. Open each URL → view-source → confirm `<meta name="description">` has the full sentence (no `…`).
2. Request indexing in GSC for the 3 CTR URLs (COMACO, Zambia news, wetlands).
3. Refresh `SEO/yoast-meta-all-pages.csv` when done.
