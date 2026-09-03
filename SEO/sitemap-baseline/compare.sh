#!/usr/bin/env bash
# Fetch live Yoast sitemaps and diff against SEO/sitemap-baseline/all-urls.csv
# Usage: ./compare.sh [YYYY-MM]   (default: current month)

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
BASELINE="$SCRIPT_DIR/all-urls.csv"
PERIOD="${1:-$(date +%Y-%m)}"
TMP="$(mktemp -d)"
UA='Mozilla/5.0 (compatible; SitemapDiff/1.0)'
SITE='https://trafigurafoundation.org'

if [[ ! -f "$BASELINE" ]]; then
  echo "Missing baseline: $BASELINE" >&2
  exit 1
fi

curl -skL -A "$UA" -o "$TMP/sitemap_index.xml" "$SITE/sitemap_index.xml"
for sm in page area-of-work news partner-stories; do
  curl -skL -A "$UA" -o "$TMP/${sm}-sitemap.xml" "$SITE/${sm}-sitemap.xml"
done

python3 - "$TMP" "$BASELINE" "$PERIOD" "$SCRIPT_DIR" <<'PY'
import re, sys
from pathlib import Path
from datetime import datetime, timezone

tmp, baseline_path, period, script_dir = sys.argv[1:5]
tmp = Path(tmp)
baseline_path = Path(baseline_path)
script_dir = Path(script_dir)

def parse_sitemap(path):
    text = path.read_text(errors='ignore')
    out = {}
    for block in re.findall(r'<url>(.*?)</url>', text, re.S):
        loc = re.search(r'<loc>(.*?)</loc>', block)
        lm = re.search(r'<lastmod>(.*?)</lastmod>', block)
        if loc:
            url = loc.group(1).strip()
            out[url] = lm.group(1).strip() if lm else ''
    return out

live = {}
for name in ['page', 'area-of-work', 'news', 'partner-stories']:
    live.update(parse_sitemap(tmp / f'{name}-sitemap.xml'))

baseline = {}
with baseline_path.open() as f:
    next(f)
    for line in f:
        line = line.strip()
        if not line:
            continue
        parts = line.split(',', 2)
        url = parts[0]
        lastmod = parts[2] if len(parts) > 2 else ''
        baseline[url] = lastmod

added = sorted(set(live) - set(baseline))
removed = sorted(set(baseline) - set(live))
edited = sorted(
    url for url in set(live) & set(baseline)
    if live[url] and baseline[url] and live[url] != baseline[url]
)

counts = {
    'page': len(parse_sitemap(tmp / 'page-sitemap.xml')),
    'area-of-work': len(parse_sitemap(tmp / 'area-of-work-sitemap.xml')),
    'news': len(parse_sitemap(tmp / 'news-sitemap.xml')),
    'partner-stories': len(parse_sitemap(tmp / 'partner-stories-sitemap.xml')),
}
total = sum(counts.values())

out_dir = script_dir / 'diffs'
out_dir.mkdir(exist_ok=True)
out_file = out_dir / f'{period}.md'

lines = [
    f'# Sitemap diff — {period}',
    '',
    f'Generated: {datetime.now(timezone.utc).strftime("%Y-%m-%d %H:%M UTC")}',
    f'Baseline: `{baseline_path.name}` ({len(baseline)} URLs)',
    f'Live total: **{total}** (page {counts["page"]} · areas {counts["area-of-work"]} · news {counts["news"]} · partners {counts["partner-stories"]})',
    '',
]

if not added and not removed and not edited:
    lines.append('**No URL additions, removals, or lastmod changes vs baseline.**')
else:
    if added:
        lines += ['## Added', '']
        for u in added:
            lines.append(f'- `{u}` (lastmod: {live[u] or "—"})')
        lines.append('')
    if removed:
        lines += ['## Removed', '']
        for u in removed:
            lines.append(f'- `{u}` (was lastmod: {baseline[u] or "—"})')
        lines.append('')
    if edited:
        lines += ['## Edited (lastmod changed)', '']
        for u in edited:
            lines.append(f'- `{u}` — {baseline[u]} → {live[u]}')
        lines.append('')

    lines += [
        '## SEO follow-up',
        '',
        '- [ ] Yoast title + meta for each **added** URL',
        '- [ ] Confirm 301 if slug **removed** + similar URL **added**',
        '- [ ] Refresh `yoast-meta-all-pages.csv` if material churn',
        '',
    ]

out_file.write_text('\n'.join(lines) + '\n')
print(out_file.read_text())
PY
