# Yoast updates — November 2026

Paste into each post’s Yoast box (SEO title, Meta description, Focus keyphrase). Copy is based on the live page text as of 2 Nov 2026. Purge W3TC after saving.

The theme now also replaces the 2007 boilerplate with the story’s own opening paragraph when a news or partner story has no Yoast description (`inc/seo-aeo.php`). Hand-written copy below still wins over that fallback.

## A. Seven stories still on the 2007 description

| URL | SEO title | Meta description | Focus keyphrase |
|---|---|---|---|
| `/news/breaking-the-invisible-barrier/` | Breaking the Invisible Barrier: A Fun Run for Mental Health | Meet Amanda, a Trafigura colleague turning a family fun run into a movement against mental health stigma, with backing from the Trafigura Foundation. | mental health fun run |
| `/news/generating-revenue-from-conservation-to-build-resilience-in-coastal-kenya/` | Mangrove Carbon Credits Build Resilience in Coastal Kenya | Near Gazi Bay and Vanga, Plan Vivo-certified projects let Kenyan coastal communities restore mangroves and fund local priorities from carbon credits. | mangrove carbon credits Kenya |
| `/news/when-the-rain-stopped-coming-bringing-anticipatory-action-to-life-in-zimbabwe/` | When the Rain Stopped Coming: Anticipatory Action in Zimbabwe | Our film with Start Network shows how communities in Zimbabwe prepare for drought before it becomes a crisis, through the Start Ready programme. | anticipatory action Zimbabwe |
| `/news/our-partner-forum-at-new-york-climate-week/` | Partner Forum at NY Climate Week: 4 Lessons on Resilience | 24 partners from the Trafigura Foundation and Puma Energy Fund networks met at New York Climate Week. Watch the video and read what they told us. | New York Climate Week partner forum |
| `/news/new-impact-investments-for-climate-resilience-in-africa-and-island-states/` | New Impact Investments in Catalyst Fund and Outrigger | Two new impact investments back climate-resilience entrepreneurs: Catalyst Fund in Africa and Outrigger in Small Island States, alongside our grants. | climate resilience impact investment |
| `/partner-stories/outrigger/` | Outrigger Impact Fund: Blue Economy for Small Island States | Small Island Developing States get only 0.2% of global climate finance. Outrigger invests in island businesses in blue carbon, ecotourism and fisheries. | Outrigger Impact Fund |
| `/partner-stories/catalyst-fund/` | Catalyst Fund: Backing Climate Adaptation Startups in Africa | Catalyst Fund backs African founders building climate adaptation solutions in clean mobility, cold chains, carbon removal and climate-smart agriculture. | Catalyst Fund climate adaptation |

## B. Snippet rewrites — high impressions, low CTR (October GSC)

| URL | Oct impressions / CTR / pos. | Current title | New SEO title | New meta description | Focus keyphrase |
|---|---|---|---|---|---|
| `/partner-stories/comaco/` | 3,960 / 0.56% / 7.1 — main query “trafigura zambia” (3,663 impr.) | COMACO Zambia \| Trafigura Foundation | Trafigura Foundation in Zambia: COMACO Conservation Farming | How the Trafigura Foundation backs COMACO in Zambia: premium It’s Wild! markets, 80 million more trees and 2.5 million people more resilient to climate. | Trafigura Zambia |
| `/news/wetlands-a-secret-weapon-against-climate-change/` | 2,659 / 0.3% / 6.4 | Wetlands & Climate \| Trafigura Foundation | Wetlands: A Secret Weapon Against Climate Change | Wetlands cover 6–8% of the world’s land yet hold 20–30% of soil carbon. A new study found hidden forest wetlands that raise carbon estimates fivefold. | wetlands climate change |
| `/contact/` | 1,082 / 1.1% / 4.6 | Contact Us \| Trafigura Foundation | Contact the Trafigura Foundation \| Geneva, Switzerland | Contact the Trafigura Foundation in Geneva: 1, rue de Jargonnant, +41 22 594 69 00 or our online form. Report concerns anonymously 24/7 via NAVEX Global. | Trafigura Foundation contact |

Why these three:

- **COMACO** — people searching “trafigura zambia” see a title that starts with “COMACO”, a name they don’t know. Leading with “Trafigura Foundation in Zambia” matches the query.
- **Wetlands** — the old title was too vague to click. The new description leads with the two numbers from the article.
- **Contact** — searchers want the address and phone; putting them in the snippet answers the query (and helps AI answers quote the right details).

Also fix the H1 capitalisation on the wetlands story in WordPress: “Wetlands: A secret Weapon…” → “Wetlands: A Secret Weapon Against Climate Change”.

## After publishing

- [ ] Purge W3TC
- [ ] Refresh `yoast-meta-all-pages.csv` with these ten rows
- [ ] Re-check CTR for these URLs in the December report (compare Nov vs Oct)
