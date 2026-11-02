#!/usr/bin/env bash
# PageSpeed Insights for one URL per template, mobile + desktop.
# Usage: PSI_API_KEY=... bash SEO/measurement/psi.sh
set -euo pipefail

KEY_FILE="$HOME/.config/mcp-gsc/psi_api_key"
if [ -z "${PSI_API_KEY:-}" ] && [ -f "$KEY_FILE" ]; then
  PSI_API_KEY="$(tr -d '[:space:]' < "$KEY_FILE")"
fi
: "${PSI_API_KEY:?Set PSI_API_KEY or save it to ~/.config/mcp-gsc/psi_api_key (see SEO/measurement/API-SETUP.md)}"

DIR="$(cd "$(dirname "$0")" && pwd)"
LOG="$DIR/psi-log.csv"
[ -f "$LOG" ] || echo "date,template,strategy,url,performance,accessibility,best_practices,seo,lcp_s,fcp_s,tbt_ms,cls" > "$LOG"

URLS=(
  "home|https://trafigurafoundation.org/"
  "who-we-are|https://trafigurafoundation.org/who-we-are/"
  "our-approach|https://trafigurafoundation.org/our-approach/"
  "news|https://trafigurafoundation.org/news/wetlands-a-secret-weapon-against-climate-change/"
  "partner|https://trafigurafoundation.org/partner-stories/comaco/"
  "area|https://trafigurafoundation.org/area-of-work/thriving-nature/"
  "staff-engagement|https://trafigurafoundation.org/staff-engagement/"
  "content-hub|https://trafigurafoundation.org/content-hub/"
)

today="$(date +%Y-%m-%d)"
for entry in "${URLS[@]}"; do
  name="${entry%%|*}"
  url="${entry#*|}"
  for strategy in mobile desktop; do
    api="https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=$(python3 -c 'import sys,urllib.parse;print(urllib.parse.quote(sys.argv[1],safe=""))' "$url")&strategy=$strategy&category=performance&category=accessibility&category=best-practices&category=seo&key=$PSI_API_KEY"
    json="$(curl -s -m 180 "$api")"
    row="$(printf '%s' "$json" | python3 -c '
import json,sys
d=json.load(sys.stdin)
if "error" in d:
    print("ERROR: "+d["error"]["message"][:120]); sys.exit(0)
lr=d["lighthouseResult"]; c=lr["categories"]; a=lr["audits"]
s=lambda k: str(round(c[k]["score"]*100)) if c.get(k,{}).get("score") is not None else ""
print(",".join([s("performance"),s("accessibility"),s("best-practices"),s("seo"),
  "%.1f"%(a["largest-contentful-paint"]["numericValue"]/1000),
  "%.1f"%(a["first-contentful-paint"]["numericValue"]/1000),
  str(round(a["total-blocking-time"]["numericValue"])),
  "%.3f"%a["cumulative-layout-shift"]["numericValue"]]))
')"
    case "$row" in
      ERROR*) echo "$name $strategy: $row" ;;
      *) echo "$today,$name,$strategy,$url,$row" >> "$LOG"; echo "$name $strategy: $row" ;;
    esac
  done
done
echo "Logged to $LOG"
