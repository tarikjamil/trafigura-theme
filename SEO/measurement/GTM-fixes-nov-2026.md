# GTM-KSB2XVQ — corrections (novembre 2026)

Workspace export reviewed 7 Nov 2026. Theme loads this container deferred (`gtm-deferred.php`). GA measurement ID: **G-4PCWE9JH0K**.

## Import JSON (preferred)

File: [`GTM-KSB2XVQ-import-nov-2026.json`](GTM-KSB2XVQ-import-nov-2026.json)

1. Tag Manager → container **GTM-KSB2XVQ** → **Admin** → **Import Container**
2. Choose the JSON file
3. Workspace: **Existing** (your current workspace) or a new one named `UNE Nov 2026 fixes`
4. Import option: **Merge** → **Overwrite conflicting tags, triggers and variables**
5. Confirm the diff shows roughly:
   - New trigger `CE - sectionTimeSpent`
   - Renamed DOM Ready trigger
   - `GA4 - Event - Scroll section to GA4` → fires on CE
   - `GA4 - Event - CTA` and `GA4 - Event - Click` → paused
   - Scroll event name → `scroll` + `percent_scrolled`
6. **Preview** on https://trafigurafoundation.org/ (checks below), then **Submit** / publish

If Merge looks messy, import into a **new workspace**, Preview from there, then publish that workspace.

---

Manual steps below are only if you prefer not to import.

Do this in **Tag Manager → Preview** on https://trafigurafoundation.org/ before publishing.

---

## 1. Fix `sectionTimeSpent` (Custom Event)

**Problem:** the Custom HTML pushes `event: 'sectionTimeSpent'` when a `.section` leaves the viewport, but the GA4 event tag fires on **DOM Ready** — too early, params empty.

### Steps

1. **Triggers → New**
   - Name: `CE - sectionTimeSpent`
   - Type: **Custom Event**
   - Event name: `sectionTimeSpent` (exact)
   - Save

2. Open tag **GA4 - Event - Scroll section to GA4**
   - Remove trigger `sectionTimeSpent` (DOM Ready)
   - Add trigger `CE - sectionTimeSpent`
   - Keep event name `sectionTimeSpent`
   - Keep params `sectionId` → `{{sectionId}}`, `timeSpent` → `{{timeSpent}}`
   - Save

3. Leave tag **Event - scroll section** (Custom HTML) on **DOM Ready** — it only installs the observers.

### Preview check

1. Open homepage in Preview + Tag Assistant.
2. Scroll past a section that has an `id` on `.section`.
3. You should see dataLayer event `sectionTimeSpent`, then the GA4 tag fire with non-empty `sectionId` and `timeSpent` (ms).
4. Sections **without** `id` are skipped by the script (`times[id]` with `id` undefined) — expected.

---

## 2. CTA tag — choose one path

**Problem:** tag **GA4 - Event - CTA** looks for attribute `track2` containing `cta`. Theme has **zero** `track2` / `track="cta"` → 0 events in October.

### Option A — wire real CTAs (if you want the metric)

1. In the theme, on primary CTA links only (not every button), add:
   ```html
   track2="cta"
   ```
   Same pattern as existing `track="navbar"` / `track="footer"`.
2. Typical spots: homepage “Content Hub” / partners / areas CTAs, Content Hub “Explore our partners”, end-of-story partner CTAs.
3. Preview: click a marked CTA → tag **GA4 - Event - CTA** fires, event `click_cta`.

### Option B — remove the dead tag (faster)

1. Pause or delete **GA4 - Event - CTA**
2. Pause/delete trigger **GA4 - trigger - CTA - click**
3. Optional: delete variable **Click Attribute - Track2**

Prefer **B** unless David asks for CTA funnels. Re-add later with Option A.

---

## 3. Pause noisy all-clicks tag

1. Pause **GA4 - Event - Click** (`click-element` on every link click).
2. Keep **click_navbar** and **click_footer** — those are intentional.
3. Preview: navbar click still sends `click_navbar`; random body link no longer sends `click-element`.

---

## 4. (Optional) Clean scroll event names

**Current:** four event names — `25%_scroll`, `50%_scroll`, `75%_scroll`, `90%_scroll`.

**Better GA4 practice:** one event `scroll` + parameter `percent_scrolled`.

1. Open **GA4 - Event - Scroll**
2. Event name → `scroll` (fixed)
3. In Event parameters, add:
   - `percent_scrolled` = `{{Scroll Depth Threshold}}`
4. Keep page_url / page_path if useful
5. Save; leave Scroll Depth trigger (25,50,75,90) as-is

Historical `25%_scroll` etc. stay in GA4; new hits use `scroll`. No need to delete old events.

Skip this if you already built Looker tiles on `25%_scroll` — then leave as-is.

---

## 5. (Optional) Delete unused variables

- **Click - Attribute - track3** — unused
- **Section - Why - exist** — unused JS
- Variable named **dataLayer** (type Data Layer → name `dataLayer`) — unused custom; built-ins cover this

---

## 6. Publish

1. Preview still open → smoke-test:
   - Page load → **GA4 - Config** once
   - Scroll → `scroll` (or `%_scroll`) thresholds
   - Navbar link → `click_navbar`
   - Leave a section → `sectionTimeSpent` with values
2. **Submit** → Version name e.g. `2026-11 fix sectionTimeSpent + pause click-element`
3. After 24–48 h, in GA4 → Events: `sectionTimeSpent` should stay high but DebugView / exploration should show real `sectionId` values; `click-element` should drop toward 0; `click_cta` only if Option A.

---

## Do not change

| Item | Why |
|---|---|
| Theme `gtm-deferred.php` | Idle / first interaction load — keeps LCP clean |
| Separate gtag in theme | Must not add — GA comes from this container |
| **GA4 - Config** | Working (`page_view` 5.6k in Oct) |
| **GA4 - Event - Navbar** | Working |
| Consent Mode | Leave NOT_SET until a CMP is required |

---

## Quick reference — tags after fix

| Tag | Trigger | Event |
|---|---|---|
| GA4 - Config | All Pages | (config) |
| Event - scroll section (HTML) | DOM Ready | (sets observers) |
| GA4 - Event - Scroll section to GA4 | **CE - sectionTimeSpent** | sectionTimeSpent |
| GA4 - Event - Scroll | Scroll Depth | scroll *(or keep %_scroll)* |
| GA4 - Event - Navbar | Link Click track=navbar | click_navbar |
| GA4 - Event - Footer | Link Click track=footer | click_footer |
| GA4 - Event - CTA | paused / or track2=cta | click_cta |
| GA4 - Event - Click | **paused** | click-element |
