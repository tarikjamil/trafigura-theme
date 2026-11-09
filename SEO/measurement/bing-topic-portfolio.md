# Bing Topics Portfolio → Trafigura AEO loop

How we steal the useful part of the LinkedIn “Topic Portfolio + LLM test + content” play — without `looot` / Cloro.

Prerequisite: Bing Webmaster Tools verified for `trafigurafoundation.org` (`SEO/measurement/README.md` §3). ChatGPT search and Copilot lean on Bing’s index; Topics Portfolio is the first-party gap list.

## Once Bing is connected

1. Open [Bing Webmaster Tools](https://www.bing.com/webmasters) → site → **AI Performance**.
2. If data exists, open the **Topics Portfolio** tab (next to Citations & Pages). No tab = not enough AI citation volume yet — log “no Topics Portfolio data” in the monthly report and stop. Do not invent topics.
3. For the last **3 months**, screenshot / export:
   - Topics list (Topic, Topic Size, Sites Cited, Queries)
   - **Top Opportunity Queries** (cross-topic)
4. For each meaningful topic (climate adaptation, partners, blue carbon, anticipatory / disaster finance — skip Group-trading noise):
   - Copy **Grounding queries** (already cited)
   - Copy **Opportunity queries** (others cited, we are not)
5. Paste both lists into `SEO/measurement/citation-opportunity-brief-YYYY-MM.md` under **Bing Topics Portfolio**.

Treat Bing numbers as directional. Filter out competitor-brand opportunities and Trafigura *Group* commercial queries.

## Turn queries into natural questions

For each kept opportunity query, write one buyer/journalist question a human would ask an AI assistant. Examples:

| Opportunity-ish query | Natural question to test |
|---|---|
| blue catalyst fund mangrove conservation | What is the Blue Catalyst Fund and how does it fund mangrove conservation? |
| what is iswan | What is ISWAN and what does it do for seafarers? |
| start ready | What is Start Ready and who funds anticipatory action? |
| what companies or foundations partner with the irc? | Which foundations partner with the International Rescue Committee on climate / anticipatory action? |
| comaco zambia | What is COMACO in Zambia and how does conservation farming work? |

Add those questions as **Q7+** rows in the next `aeo-log.csv` run (see README §1b).

## Citation spot-check (no SaaS)

Same routine as the monthly P1–P6 check:

1. Private / logged-out window.
2. Ask the natural question in **ChatGPT (search on)**, **Copilot**, **Gemini**, **Perplexity**.
3. Score separately:
   - **mentioned** — Foundation or partner named in the prose
   - **cited** — `trafigurafoundation.org` (or annual-report microsite) appears as a linked source
4. Log in `aeo-log.csv`. Mention without a link = gap for that URL’s extractability / authority, not a win.

Re-test the same questions ~1 week after publishing or strengthening a page.

## Only build when we can win

Before drafting a new page, answer yes to all three:

1. **We have unique proof** on the live site or an approved explainer (partner + figures + Foundation role).
2. **The current cited sources are beatable** on that specific question (weaker definition, no Foundation angle, or wrong geography) — or we only need a stronger answer block on an *existing* URL.
3. **Intent matches a Foundation page** — not Group trading, not “CEO of partner X”, not school “wetlands climate/weather” quizzes.

If any answer is no → skip or fix an existing partner/news page instead of shipping a thin “What is X?” post.

## After each publish

- Theme IndexNow ping (automatic).
- Confirm URL in Bing → URL Inspection when useful.
- Re-run the matching Q-prompt set the following week; append `aeo-log.csv`.
- Note Bing AI Performance / Topics Portfolio deltas in the monthly report (citations, not vanity traffic).
