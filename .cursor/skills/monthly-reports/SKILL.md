---
name: monthly-reports
description: >-
  Drafts Trafigura Foundation monthly digital/SEO/AEO client reports (HTML+PDF)
  from Looker/GSC/GA4 exports, sitemap diffs, and shipped work. Use when the
  user asks for a monthly report, client PDF, Looker brief, GSC/GA4 write-up,
  AEO spot-check, sitemap recheck, or anything in SEO/monthly-reports/.
---

# Monthly client reports

Produce the **client PDF** each month. Looker stays the deep-dive; the written report is what the Foundation forwards (~6–8 pages).

Read [voice.md](voice.md) before drafting copy. Use [html-skeleton.md](html-skeleton.md) for markup. Human process: `SEO/monthly-reports/README.md`.

## When this starts

Typical prompt: *“Draft [Month] report from PDF + recheck sitemap”* plus a Looker PDF.

If GSC/GA4 numbers are missing, still draft Work / Plan / AEO / sitemap; mark Performance **TBC** and ask for the PDF. Do not invent KPIs.

## Inputs (expect / request)

| Need | Source |
|---|---|
| GSC 4 KPIs + MoM + YoY | Looker PDF (previous calendar month) |
| Top queries (by clicks, ~10–15) | Looker — **Query** table, not Brand/Non-brand chart |
| Top pages (by clicks) | Looker |
| Brand vs non-brand clicks | Looker (brand ≈ query contains “trafigura”) |
| GA4 sessions, engagement, organic sessions, top landings | Looker |
| Content launches / outages / client asks | User notes |
| AEO 3-prompt results | User, or remind them of the prompts |

## Deliverables

| File | Audience |
|---|---|
| `SEO/monthly-reports/YYYY-MM-client.md` | **Primary** — client HTML source |
| `SEO/monthly-reports/YYYY-MM-Report.pdf` | **Email this** |
| `SEO/monthly-reports/YYYY-MM.md` | Internal/technical (full tables, Looker URL OK) |
| `SEO/monthly-reports/YYYY-MM-todos.md` | Internal follow-ups **not** in the PDF |
| `SEO/sitemap-baseline/diffs/YYYY-MM.md` | Sitemap diff |

Copy last month’s `*-client.md` as the HTML shell, then replace period, numbers, and narrative. Keep cover/thanks assets (`assets/cover-hero.jpg`, logos).

**Never** put the Looker dashboard URL in client files.

Optional Cursor canvas (`monthly-report-YYYY-MM.canvas.tsx`) only if the user asks; PDF is the shareable artefact.

## Workflow

Copy and track:

```
- [ ] 1. Confirm period (previous calendar month) and report date
- [ ] 2. Read prior *-client.md + *-todos.md + §08 plan
- [ ] 3. Extract Looker/GSC/GA4 (Read the PDF; do not guess)
- [ ] 4. Sitemap: bash SEO/sitemap-baseline/compare.sh YYYY-MM
- [ ] 5. Work completed (git + checklist + prior plan + user notes)
- [ ] 6. Draft YYYY-MM.md (internal numbers)
- [ ] 7. Draft YYYY-MM-client.md (plain language)
- [ ] 8. Draft YYYY-MM-todos.md (client asks / internal only)
- [ ] 9. Build PDF
- [ ] 10. Sanity-check: numbers match PDF; insights don’t contradict KPIs
```

### 1. Numbers

- Date range = full previous calendar month, compared **MoM** and **YoY (same month last year)**.
- Position: **lower is better**. In client tables write “Improved” / “Softer”, not a red negative % when the number dropped.
- Use unicode minus `−` in deltas.
- Client labels: see [voice.md](voice.md).
- Skip country/device/Semrush unless something material moved.
- If Looker “Top Queries” is only Brand vs non-brand, say so and use what exists; don’t fabricate query rows.

### 2. Sitemap

```bash
bash SEO/sitemap-baseline/compare.sh YYYY-MM
```

- Added URLs → §02 Content published (news vs partner stories).
- Removed + similar added → flag possible slug change / 301.
- For each **added** URL: unique Yoast title/meta, OG, intended indexability.
- Do **not** overwrite baseline CSVs until the user confirms (auto-OK if only additions).

### 3. Work completed

Pull from: prior month §08, `git log` for the period, `SEO/CHECKLIST-big-wins.md`, `SEO/AEO-recommendations.md`, sitemap additions, user notes.

Group in the client PDF as: technical SEO / site · structure & linking · content · reporting (only if something shipped).

### 4. AEO

Goal = **accurate citation**, not ChatGPT traffic.

Same 3 prompts every month:

1. What is the Trafigura Foundation?
2. What does the Trafigura Foundation fund?
3. What are the Trafigura Foundation’s areas of work?

Score = cited + accurate across 3 = **/6**. If the user didn’t run them, leave pending and remind — don’t fake Yes.

Pillars: Sustainable Livelihoods · Prepared Communities · Thriving Nature.

### 5. Plan & risks

- Client §08: 4–6 actions, High/Medium, “why it matters” in plain language.
- Client asks (OG wipe, Tales noindex, etc.) → `YYYY-MM-todos.md` only — **not** a “needs your input” block in the PDF.
- Carry unfinished items forward.

### 6. PDF

```bash
cd SEO/monthly-reports
npx md-to-pdf YYYY-MM-client.md --stylesheet pdf-style.css \
  --pdf-options '{"format":"A4","margin":{"top":"0","bottom":"0","left":"0","right":"0"},"printBackground":true,"preferCSSPageSize":true}'
mv YYYY-MM-client.pdf YYYY-MM-Report.pdf
```

Do not commit unless asked.

## Client PDF storyline

| # | Title |
|---|---|
| Cover | Photo + orange panel (period, org, Digital Performance Report, Made By UNE) |
| 00 | Goal of this report |
| 01 | Work completed |
| 02 | Content published |
| 03 | How people find Trafigura Foundation (GSC) |
| 04 | What visitors do on the site (GA4) |
| 05 | Answer engines & AI visibility |
| 06 | Site speed & technical health (one line if nothing shipped) |
| 07 | Summary & conclusion (4 KPIs + “In short”) |
| 08 | Plan for next month |
| Close | Thank you (orange, no photo) |

Every data section ends with an insight (`What this means`). Honest: a −5% click month is not a “strong growth story”.

## Hard rules

- No invented metrics, AEO scores, or query lists.
- No Looker URL, Semrush dump, or SEO-objectives boilerplate in the client PDF.
- Don’t clone every Looker tile.
- Don’t change theme PHP/CSS as part of reporting unless the user asks.
- British English. Agency credit: **UNE** / Made By UNE.
