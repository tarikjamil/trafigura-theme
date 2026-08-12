# AEO Recommendations — Trafigura Foundation

AEO (Answer Engine Optimization) = being chosen and cited by AI answer surfaces: Google AI Overviews, ChatGPT/Perplexity browsing, Gemini, Copilot, voice assistants, etc.

For a philanthropic foundation, the goal is not traffic volume alone — it is **accurate entity recognition**, **citation-worthy facts**, and **clear answers** about who you fund and why.

---

## 1. What to do first (high impact, low drama)

### Fix classic SEO foundations (already in checklist)
AI systems lean heavily on the same signals as Google:
- Unique titles & meta
- Clean canonicals (no junk URLs)
- Clear H1 + structured headings
- Internal links between pillars ↔ partners ↔ news

Without this, AEO work sits on a broken base.

### Publish an `llms.txt` (currently 404)
Create `https://trafigurafoundation.org/llms.txt` that points crawlers/agents to the best source pages, e.g.:
- Who we are / mission
- Approach / 2023–2027 strategy
- Three areas of work
- Partners index
- Latest annual report
- Contact

Keep it short, factual, link-heavy. Optionally add `llms-full.txt` later with longer excerpts.

### Strengthen the entity “Trafigura Foundation”
Make one consistent definition used in About, Organization schema, and footer:
> Trafigura Foundation is an independent philanthropic foundation that funds climate adaptation solutions for communities and ecosystems most vulnerable to climate change.

Ensure `sameAs` in schema includes LinkedIn (and any official profiles). Keep NAP (Geneva address/phone) consistent.

---

## 2. Content patterns that win citations

### Answer-first blocks on pillar pages
On Sustainable Livelihoods / Thriving Nature / Prepared Communities, add near the top:

1. **One-sentence definition** of the pillar  
2. **Who it serves**  
3. **What you fund** (types of interventions)  
4. **Example partners** (linked)  
5. **Outcomes you look for**

AI overviews love extractable definitions + lists.

### FAQ sections (real questions, short answers)
Target questions partners, NGOs, journalists, and AI already ask:
- What does the Trafigura Foundation fund?
- Does the Trafigura Foundation accept unsolicited proposals?
- What is the Foundation’s climate adaptation strategy (2023–2027)?
- What are the three areas of work?
- How does staff engagement / matching work?
- Where is the Foundation based?

Implement as visible FAQ + `FAQPage` schema (Yoast or custom). Only mark up FAQs that appear on-page.

### Quotable facts & stats
Every major page should include 2–4 citeable facts with dates:
- Year founded (2007)
- Strategy window (2023–2027)
- Geography focus examples
- Number of active partners / countries (keep updated annually)
- Link to latest Annual Report PDF **and** HTML summary

AI prefers dated, attributable statements over marketing adjectives.

### Partner pages as “entity hubs”
Each partner story should open with:
- Partner legal/common name  
- Geography  
- Area of work tag(s)  
- One-paragraph “what the programme does”  
- Trafigura Foundation’s role (grant / catalytic funding / etc.)  
- Status (New / Ongoing)

This reduces confusion when AI merges duplicate partner URLs.

---

## 3. Technical AEO checklist

- [ ] `llms.txt` live + linked from robots.txt or footer (optional)
- [ ] Organization / NGO schema accurate (logo, description, sameAs, address)
- [ ] Article/NewsArticle on news posts
- [ ] FAQPage only where FAQs are visible
- [ ] Breadcrumbs on all deep URLs
- [ ] HTML summaries for key PDFs (strategy + annual reports)
- [ ] Open Graph / social titles fixed (same quality as SEO titles)
- [ ] No conflicting duplicate partner/news entities without canonical
- [ ] Fast LCP — answer engines still use crawled HTML; heavy JS hurts extractability

---

## 4. Content roadmap for AEO (90 days)

| Month | Deliverable | Why it helps AEO |
|---|---|---|
| 1 | Meta + junk cleanup + entity blurb + `llms.txt` | Clean crawlable facts |
| 1 | FAQ on Home / Who we are / Approach / Contact | Direct Q&A extraction |
| 2 | Pillar pages rewritten answer-first + FAQ | Topic authority for 3 themes |
| 2 | Partner template standardised | Better entity disambiguation |
| 3 | 4–6 “explainer” insights (not just news): e.g. anticipatory action, blue carbon, informal settlements resilience | Becomes citation source for thematic queries |
| 3 | Case-study hub with short abstracts | AI cites summaries more than long PDFs |

---

## 5. Query themes to own (not vanity keywords)

Prioritise questions where Trafigura Foundation can be the authoritative answer:

1. Trafigura Foundation climate adaptation strategy  
2. Trafigura Foundation areas of work / pillars  
3. Trafigura Foundation partners + [country/theme]  
4. Staff engagement / employee matching philanthropy Trafigura  
5. Blue carbon / coastal resilience funding partners  
6. Climate resilience informal settlements Africa (SDI angle)  
7. Conservation livelihoods Zambia (COMACO angle)  
8. Annual report Trafigura Foundation [year]

Build one strong HTML page (or update an existing one) that answers each theme clearly.

---

## 6. Measurement (practical)

- Google Search Console: impressions for brand + “climate adaptation” adjacent queries; track FAQ rich results if eligible  
- Manual AI checks monthly (same prompt set):
  - “What does the Trafigura Foundation do?”
  - “What are Trafigura Foundation’s areas of work?”
  - “Who are Trafigura Foundation partners in Africa / Latin America?”
- Note whether answers cite your site vs Wikipedia / Trafigura Group only  
- Track referral traffic from ChatGPT/Perplexity if visible in analytics

---

## 7. What not to over-invest in

- Keyword stuffing for AI — hurts trust  
- Hidden text for models — against guidelines, risky  
- Dozens of thin “What is X?” posts with no unique Foundation POV  
- Paying for vanity “AI SEO tools” before fixing duplicates, placeholders, and entity clarity

---

## Suggested ownership

| Workstream | Owner suggestion |
|---|---|
| Yoast meta bulk update | Content / digital editor |
| Noindex + redirects + robots | Dev / WP admin |
| FAQ + pillar rewrites | Comms + programme team |
| Schema / llms.txt | Dev |
| Quarterly AI citation review | Comms |

See also: `CHECKLIST-big-wins.md` and `yoast-meta-all-pages.csv`.
