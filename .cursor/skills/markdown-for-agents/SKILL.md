---
name: markdown-for-agents
description: >-
  Checks whether a site uses HTTP content negotiation (Accept: text/markdown)
  to serve Markdown to AI agents, including Cloudflare Markdown for Agents
  signals (x-markdown-tokens, content-signal, Vary: accept). Use when the user
  asks to test Accept headers, markdown for agents, content negotiation, or
  whether trafigurafoundation.org or a competitor serves markdown instead of HTML.
---

# Markdown for agents

Some sites convert HTML to Markdown when the client sends `Accept: text/markdown`. Cloudflare calls this Markdown for Agents. A normal browser request still gets HTML. A few sites return Markdown even on an HTML `Accept`.

Always compare both requests. A single `Accept: text/markdown` curl is not enough: without the HTML control you cannot tell negotiation from a site that is Markdown-only.

## Run

```bash
bash .cursor/skills/markdown-for-agents/scripts/probe.sh URL [URL...]
```

Default Trafigura set when the user says “our site” and does not list URLs:

- `https://trafigurafoundation.org/`
- `https://trafigurafoundation.org/content-hub/`
- `https://trafigurafoundation.org/partners-stories/`
- `https://trafigurafoundation.org/areas-of-work/`
- one news URL and one partner-story URL from `SEO/` if present

Also request these once per host (status + content-type only; they are a separate convention from Accept negotiation):

```bash
curl -sSI -A "Mozilla/5.0" "https://HOST/llms.txt"
curl -sSI -A "Mozilla/5.0" "https://HOST/llms-full.txt"
```

## What the script sends

| Mode | Accept |
|---|---|
| html | `text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8` |
| markdown | `text/markdown` |
| prefer-both | `text/markdown, text/html;q=0.9` |

User-Agent is `Mozilla/5.0`. Follow redirects. Read the **last** headers in the dump (the final response).

## How to read it

| Verdict | Meaning |
|---|---|
| `html-only` | Markdown `Accept` still returns HTML. Negotiation is off. |
| `negotiating` | Markdown only when `Accept` includes `text/markdown`. |
| `aggressive` | Markdown even on the HTML `Accept`. |
| `unclear` | Body is neither obvious HTML nor Markdown. Quote status and content-type. |

Cloudflare Markdown for Agents, when enabled, typically adds on the converted response:

- `content-type: text/markdown`
- `vary: accept`
- `x-markdown-tokens` and `x-original-tokens`
- `content-signal` (ai-train / search / ai-input)
- `cf-ray` plus a Cloudflare `server` header (the zone is on Cloudflare; that alone does not mean conversion is on)

`prefer-both` should match `markdown` when conversion treats `text/markdown` as one acceptable type. If only the strict `text/markdown` request converts, say so.

Byte counts: Markdown is usually much smaller than the HTML document. Report both sizes when they differ.

## Report

Lead with the site-level verdict, then a short table:

| URL | HTML | Markdown Accept | Verdict |
|---|---|---|---|
| … | content-type, bytes | content-type, bytes, token headers if any | html-only / negotiating / aggressive |

Then: `llms.txt` / `llms-full.txt` status, and whether `cf-ray` shows Cloudflare. Do not recommend turning the feature on unless the user asks. Do not invent crawl or ranking impact.
