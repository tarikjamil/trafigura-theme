# Monthly client reports — Trafigura Foundation

**Goal:** a short, decision-ready brief each month covering:

1. Search performance (GSC)  
2. Site engagement (GA4)  
3. Technical / CWV (when relevant)  
4. **AEO / answer readiness**  
5. Work completed · next month plan · risks  

**Live charts:** [Looker Studio](https://datastudio.google.com/reporting/98a2859f-e160-45cd-8aeb-20dc26873aea) stays the deep-dive. The written report is what the client forwards — aim **~6–8 pages**, not a 20-page PDF of every tile.

**Proposal canvas (keep / cut / AEO):** open `monthly-report-proposal` in Cursor canvases.

## How we produce a report (≈45–60 min)

### First week of the new month

1. Looker → date range = **previous calendar month**, with **MoM and YoY (same month last year)** comparisons.  
2. Paste **4 GSC KPIs** + top queries/pages into `YYYY-MM.md`.  
3. Paste **GA4** sessions / engagement / top landings.  
4. **AEO spot-check:** run the 3 fixed prompts (ChatGPT / Perplexity / Gemini) → fill the score table.  
5. CWV: one line, or expand if work shipped.  
6. Ask Cursor: *“Draft YYYY-MM monthly client report from template + these numbers.”*

### Deliverables

| File | Audience |
|---|---|
| `SEO/monthly-reports/YYYY-MM-client.md` | Client-facing source (plain language + analysis paragraphs) |
| `SEO/monthly-reports/YYYY-MM-Report.pdf` | **PDF to email the client** |
| `SEO/monthly-reports/YYYY-MM.md` | Internal/technical working copy (optional) |
| Canvas `monthly-report-YYYY-MM.canvas.tsx` | Visual share-in-Cursor |
| Looker link | Exploration appendix |

Regenerate PDF after edits:
```bash
cd SEO/monthly-reports
npx md-to-pdf YYYY-MM-client.md --stylesheet pdf-style.css \
  --pdf-options '{"format":"A4","margin":{"top":"0","bottom":"0","left":"0","right":"0"},"printBackground":true,"preferCSSPageSize":true}'
mv YYYY-MM-client.pdf YYYY-MM-Report.pdf
```

## Client report storyline (PDF)

| # | Section |
|---|---|
| Cover | Photo + orange panel |
| 00 | Goal of this report |
| 01 | Work completed |
| 02 | Content published |
| 03 | How people find Trafigura Foundation |
| 04 | What visitors do on the site |
| 05 | Answer engines & AI visibility |
| 06 | Site speed & technical health |
| 07 | Summary & conclusion |
| 08 | Plan for next month |
| Close | Thank you (orange, no photo) |

## Folder layout

```
SEO/monthly-reports/
  README.md
  _TEMPLATE.md              ← SEO + AEO structure
  2026-08.md
  2026-08/                  ← optional CSVs / screenshots
```

## Looker PDF export checklist

Use this when exporting the monthly Looker PDF to send the agent. **August 2026 export reviewed 2 Sep 2026.**

### Must have (you have most of these)

| # | Tile | Status in Aug PDF |
|---|---|---|
| 1 | **GSC scorecards** — clicks, impressions, CTR, avg position (**MoM + YoY** %) | ✅ |
| 2 | **GSC top pages** — table, 10–15 rows, sort by clicks | ✅ (you have ~21) |
| 3 | **GSC top queries** — table with Query + clicks/impressions/CTR/position | ❌ **Missing** — page labeled “Top Queries” shows Brand/Non-brand only |
| 4 | **Brand vs non-brand** — clicks split (calculated field) | ✅ |
| 5 | **GA4 scorecards** — sessions, engagement rate, engaged sessions (**MoM + YoY**) | ✅ |
| 6 | **GA4 top landing pages** — 10 rows | ✅ |
| 7 | **Date range** visible — e.g. Aug 1–31, 2026 | ✅ |

### Nice to have (optional)

| Tile | Status in Aug PDF | Note |
|---|---|---|
| GSC YoY same month | ✅ | Keep when data exists |
| GA4 YoY | ✅ | Keep |
| **Organic sessions only** (GA4 filter: Organic Search) | ❌ Missing | One scorecard — helps separate SEO from direct/referral |
| GSC daily clicks/impressions charts | ✅ | Good for narrative |
| Device split | ✅ in PDF | Fine in Looker; agent won’t repeat in client brief |
| Country table | ✅ in PDF | Fine in Looker; skip in written report unless notable |

### Remove / fix in Looker

| Issue | Action |
|---|---|
| “Top Queries” chart shows Brand type | Rename chart **“Brand vs non-brand”**; add a **separate** table with dimension **Query** (data source: `… site`) |
| Duplicate “Top pages” pages (pp. 4–5 identical) | Delete duplicate chart or fix pagination so PDF doesn’t repeat |
| Page 3 mixes GA4 landings + GSC charts + device | OK for exploration; optional cleanup later |
| Old Semrush / objectives slides | ✅ Already removed — keep it that way |

### One tile still to add

**GSC Top queries** (data source `trafigurafoundation.org site`):

- Dimension: **Query**
- Metrics: Clicks, Impressions, Site CTR, Average Position
- Sort: Clicks ↓
- Rows: **15**
- Optional second table: same but filter **Brand type = Non-brand**

**GA4 Organic sessions** (optional scorecard):

- Metric: Sessions
- Filter: Session default channel group = **Organic Search**
- Show MoM % next to total sessions

### What you send each month

1. This Looker PDF (after adding top queries)
2. Say: *“Draft [month] report from PDF + recheck sitemap”*
3. Optional: 3 AEO prompt results (or ask agent to remind you)

Agent handles: written client brief, insights, work/plan/risks, AEO section, sitemap diff — **not** duplicating every Looker tile.

## What to send the agent each month

- GSC: clicks, impressions, CTR, position (+ top queries/pages)  
- GA4: sessions, engagement, top landings  
- Optional: Looker PDF/export  
- Notes on content launches / outages  
- AEO prompt results (or ask agent to remind you of the 3 prompts)

Without GSC/GA4, Work / Plan / Risks / AEO ship-log can still be drafted; Performance stays incomplete.

## Sitemap tracking (client edits)

Each month, ask: *“Recheck the sitemap for [month]”*.

- **Baseline:** `SEO/sitemap-baseline/all-urls.csv` (114 URLs, saved 2 Sep 2026)
- **Diff output:** `SEO/sitemap-baseline/diffs/YYYY-MM.md`
- Agent flags **added / removed / edited** URLs and adds a **Sitemap changes** section to the monthly report
- After confirmed changes, baseline CSVs get updated for the next month

See `SEO/sitemap-baseline/README.md`.

## What we deliberately skip monthly

- Generic SEO objectives boilerplate  
- Full Semrush dumps (only material Δ)  
- Full country/device tables (quarterly if needed)  
- YoY charts when baseline is missing  
- Auto-commentary that contradicts the numbers  
