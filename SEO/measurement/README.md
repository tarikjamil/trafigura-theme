# Measurement — monthly routine

Run on the first working day of each month, before drafting the monthly report. Results feed `SEO/monthly-reports/YYYY-MM.md`.

| What | Tool | Where results go | Time |
|---|---|---|---|
| Search performance | GSC (Looker export, or GSC MCP: `sc-domain:trafigurafoundation.org`) | monthly report | — |
| AI answer check | ChatGPT, Perplexity, Google AI Overview, Copilot | `aeo-log.csv` | 20–40 min |
| Citation gaps (Bing) | Bing Webmaster → AI Performance → Topics Portfolio | `citation-opportunity-brief-YYYY-MM.md` | 15 min |
| AI referral traffic | GA4 “AI assistants” channel (setup below) | monthly report | 5 min |
| Bing / ChatGPT search visibility | Bing Webmaster Tools (setup below) | monthly report | 5 min |
| Page speed, one URL per template | `bash SEO/measurement/psi.sh` | `psi-log.csv` | 5 min |

Playbook for the LinkedIn-style loop (Bing gaps → natural questions → mention vs cite → build only when we can win): `SEO/measurement/bing-topic-portfolio.md`. Current GSC-based brief: `SEO/measurement/citation-opportunity-brief-2026-11.md`.

## 1. AEO check — same prompts every month

Use a logged-out / private window. Ask each prompt in **ChatGPT (search on)**, **Perplexity**, **Google** (note whether an AI Overview appears) and **Copilot**. Log one row per prompt × engine in `aeo-log.csv`.

| ID | Prompt | What a good answer contains |
|---|---|---|
| P1 | What is the Trafigura Foundation? | Independent foundation, created 2007, climate adaptation, Geneva; cites trafigurafoundation.org |
| P2 | What does the Trafigura Foundation fund? | Climate adaptation for vulnerable communities and ecosystems; three areas of work |
| P3 | What are the Trafigura Foundation’s areas of work? | Prepared communities, Sustainable livelihoods, Thriving nature |
| P4 | Does the Trafigura Foundation accept funding applications? | No unsolicited applications; Management Team sources partners |
| P5 | Who does the Trafigura Foundation partner with in Africa? | Named partners (e.g. COMACO, SDI, Start Network, Maliasili) |
| P6 | What is anticipatory action and who funds it? | Non-brand: does the Foundation / Start Ready appear at all? |

Columns in `aeo-log.csv`:

- `cites_site` — **yes only if** `trafigurafoundation.org` (or the annual-report microsite) appears as a **linked source**. Name-drop in the prose without a link = `no` and note “mentioned, not cited”
- `accurate` — yes / partly / no
- `confuses_with_group` — yes if the answer mixes up the Foundation with Trafigura Group trading business
- `sources_cited` — domains / URLs shown as sources
- `notes` — wrong facts, competitor sources, mention-without-link, etc.

The client PDF reports: how many of P1–P5 cite the site, any factual errors, and whether P6 mentions the Foundation.

### 1b. Opportunity prompts (Q7+)

After the core P1–P6 set, run the natural questions from the latest `citation-opportunity-brief-YYYY-MM.md` (Nov 2026: Q7–Q14 — ISWAN, Blue Catalyst / mangroves, Maliasili, IRC funders, Start Ready / anticipatory funders, COMACO, wetlands role, Group vs Foundation). Same engines, same mention≠cite rule. Skip any Q whose page was not strengthened or published yet if time is short; prioritise Q7, Q8, Q11.

## 2. GA4 — “AI assistants” channel (one-off setup, ~5 min)

GA4 lumps ChatGPT and Perplexity visits into “Referral”. A custom channel group splits them out and applies to past data too.

1. GA4 → **Admin** → **Data display** → **Channel groups** → **Create new channel group**.
2. Name it `Default + AI`. GA4 copies the default channels.
3. **Add new channel** → name `AI assistants` → condition **Source** → **matches regex**:
   ```
   chatgpt\.com|chat\.openai\.com|perplexity\.ai|gemini\.google\.com|copilot\.microsoft\.com|claude\.ai|edgeservices\.bing\.com|you\.com|poe\.com|meta\.ai|deepseek\.com
   ```
4. **Reorder** so `AI assistants` sits **above** `Referral` (GA4 uses the first match). Save.
5. In Reports → Acquisition → Traffic acquisition, switch the primary dimension to **Session — Default + AI**.
6. In Looker Studio, add a table: dimension = this channel group, metrics = sessions, engaged sessions. This also gives the channel split the October report was missing.

## 3. Bing Webmaster Tools (one-off setup, ~5 min)

ChatGPT search and Microsoft Copilot rely heavily on Bing’s index.

1. Go to <https://www.bing.com/webmasters> and sign in with the Google account that owns Search Console.
2. Choose **Import from Google Search Console** — it verifies the site and imports the sitemap in one step.
3. Check **Sitemaps** shows `https://trafigurafoundation.org/sitemap_index.xml`.
4. Under **IndexNow**, URLs should start appearing after the next publish (the theme pings automatically). Key file: `https://trafigurafoundation.org/8145752a3c514a4beb817aa3b1f06ee8.txt`.
5. Monthly: note Bing clicks / impressions next to the GSC numbers.
6. Monthly (once AI data exists): **AI Performance → Topics Portfolio** — follow `bing-topic-portfolio.md`. Paste opportunity queries into a new or updated `citation-opportunity-brief-YYYY-MM.md`. If the Topics Portfolio tab is missing, write “insufficient AI citation data” and keep using the GSC + AEO brief.

## 4. PageSpeed — one URL per template

Needs a PageSpeed Insights API key (see `SEO/measurement/API-SETUP.md`). Then:

```bash
export PSI_API_KEY=your-key
bash SEO/measurement/psi.sh
```

It tests mobile + desktop for each template and appends to `psi-log.csv`. Quote PSI numbers in client reports. Local Lighthouse with `--throttling-method=devtools` matched PSI on Who We Are (97 / 2.2 s local vs 97 / 2.5 s PSI on 2 Nov 2026), so it is a usable stand-in when the API quota runs out; the older simulated local runs were not.

## Baseline — local Lighthouse, mobile, 2 Nov 2026 (before this month’s fixes)

Devtools throttling (Slow 4G, 4× CPU), Lighthouse 12.

| Template | URL tested | Perf | LCP | Main cause |
|---|---|---:|---:|---|
| Our Approach | `/our-approach/` | 86 | 3.2 s | Hero download competes with the 62 KB launch-video poster and Elementor JS |
| Who We Are (control) | `/who-we-are/` | 97 | 2.2 s | — |
| News story | `/news/wetlands-a-secret-weapon-against-climate-change/` | 74 | 5.4 s | Hero image lazy-loaded by W3TC (load delay 3.2 s) |
| Partner story | `/partner-stories/comaco/` | 72 | 5.4 s | Same (load delay 3.1 s) |
| Area of work | `/area-of-work/thriving-nature/` | 74 | 5.1 s | Same (load delay 2.9 s) |
| Staff Engagement | `/staff-engagement/` | 61 | 12.8 s | Same (load delay 9.8 s) |

Fixes shipped in the theme on 2 Nov (deploy + W3TC purge needed): heroes eager / `fetchpriority="high"` / `no-lazy` on news, partner, area, Staff Engagement, Contact, Areas of Work, Content Hub and default pages; launch-video poster deferred; CSS bundle minified (−18% gzip).

## After deploy — local Lighthouse, mobile, 2 Nov 2026 (13:55)

| Template | Perf before → after | LCP before → after | LCP load delay | What still limits LCP |
|---|---|---|---:|---|
| Our Approach | 86 → **90** | 3.2 → **3.0 s** | 0.4 s | 36 KB hero download competing with Elementor JS |
| Who We Are | 97 → **97** | 2.2 → **2.0 s** | 0.4 s | — |
| News story | 74 → **77** | 5.4 → **4.7 s** | 3.2 → **0.4 s** | 88 KB JPEG hero (768w) — serve WebP |
| Partner story | 72 → **77** | 5.4 → **4.6 s** | 3.1 → **0.4 s** | 88 KB JPEG hero — serve WebP |
| Area of work | 74 → **80** | 5.1 → **4.3 s** | 2.9 → **0.4 s** | 85 KB JPEG hero — serve WebP |
| Staff Engagement | 61 → 58 | 12.8 → 11.4 s | 9.8 → **0.5 s** | 34 hidden map photos (1.26 MB) downloading eagerly — fixed in a second commit (`data-src`), re-test after deploy |

Best practices went to 100 on five of six pages.
