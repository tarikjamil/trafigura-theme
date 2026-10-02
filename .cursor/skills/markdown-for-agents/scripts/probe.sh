#!/usr/bin/env bash
# Compare an HTML Accept with Accept: text/markdown for one or more URLs.
# Usage: probe.sh URL [URL...]
set -euo pipefail

if [[ $# -lt 1 ]]; then
  echo "Usage: probe.sh URL [URL...]" >&2
  exit 1
fi

tmpdir=$(mktemp -d)
trap 'rm -rf "$tmpdir"' EXIT

header_last() {
  local file=$1 key=$2
  awk -v k="$key" 'BEGIN { IGNORECASE = 1 }
    { gsub(/\r/, "") }
    tolower($0) ~ "^" tolower(k) ":" {
      sub(/^[^:]+:[[:space:]]*/, "")
      v = $0
    }
    END { print v }' "$file"
}

status_last() {
  awk '{ gsub(/\r/, "") }
    $0 ~ /^HTTP\// { code = $2 }
    END { print code }' "$1"
}

body_kind() {
  local file=$1
  local head
  head=$(head -c 1200 "$file" | tr -d '\000')
  if printf '%s' "$head" | grep -qiE '<!doctype html|<html|<head'; then
    echo html
  elif printf '%s' "$head" | grep -qE '(^|[[:space:]])(---|# |## )'; then
    echo markdown
  else
    echo other
  fi
}

fetch() {
  local url=$1 accept=$2 tag=$3
  curl -sS -L --max-redirs 8 --compressed \
    -A "Mozilla/5.0" \
    -H "Accept: $accept" \
    -D "$tmpdir/$tag.hdr" -o "$tmpdir/$tag.body" \
    --max-time 40 \
    "$url" || true
}

report_mode() {
  local label=$1 tag=$2
  local hdr="$tmpdir/$tag.hdr" body="$tmpdir/$tag.body"
  local status ctype vary tokens original signal kind bytes
  status=$(status_last "$hdr")
  ctype=$(header_last "$hdr" "content-type")
  vary=$(header_last "$hdr" "vary")
  tokens=$(header_last "$hdr" "x-markdown-tokens")
  original=$(header_last "$hdr" "x-original-tokens")
  signal=$(header_last "$hdr" "content-signal")
  kind=$(body_kind "$body")
  bytes=$(wc -c <"$body" | tr -d ' ')
  printf '  %-16s status=%s type=%s body=%s bytes=%s\n' \
    "$label" "${status:-?}" "${ctype:-?}" "$kind" "$bytes"
  printf '  %-16s vary=%s x-markdown-tokens=%s x-original-tokens=%s\n' \
    "" "${vary:-—}" "${tokens:-—}" "${original:-—}"
  if [[ -n "$signal" ]]; then
    printf '  %-16s content-signal=%s\n' "" "$signal"
  fi
}

verdict() {
  local html_type md_type html_kind md_kind
  html_type=$(header_last "$tmpdir/html.hdr" "content-type")
  md_type=$(header_last "$tmpdir/md.hdr" "content-type")
  html_kind=$(body_kind "$tmpdir/html.body")
  md_kind=$(body_kind "$tmpdir/md.body")

  local md_is=0 html_is=0
  if printf '%s' "$md_type" | grep -qi 'text/markdown' || [[ "$md_kind" == markdown ]]; then
    md_is=1
  fi
  if printf '%s' "$html_type" | grep -qi 'text/markdown' || [[ "$html_kind" == markdown ]]; then
    html_is=1
  fi

  if [[ $md_is -eq 1 && $html_is -eq 1 ]]; then
    echo "aggressive — markdown even on an HTML Accept"
  elif [[ $md_is -eq 1 && $html_is -eq 0 ]]; then
    echo "negotiating — markdown only when Accept includes text/markdown"
  elif [[ "$html_kind" == html && "$md_kind" == html ]]; then
    echo "html-only — Accept: text/markdown still returns HTML"
  else
    echo "unclear — html=$html_kind ($html_type); markdown-accept=$md_kind ($md_type)"
  fi
}

for url in "$@"; do
  echo "URL $url"
  fetch "$url" "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8" html
  fetch "$url" "text/markdown" md
  fetch "$url" "text/markdown, text/html;q=0.9" prefer
  report_mode "html" html
  report_mode "markdown" md
  report_mode "prefer-both" prefer
  server=$(header_last "$tmpdir/md.hdr" "server")
  cf=$(header_last "$tmpdir/md.hdr" "cf-ray")
  printf '  %-16s server=%s cf-ray=%s\n' "edge" "${server:-—}" "${cf:-—}"
  echo "  verdict: $(verdict)"
  echo
done
