# Google API setup — Search Console MCP + PageSpeed key

One Google Cloud project gives you both:

- an **OAuth client file** so Cursor can read Search Console (the `gscServer` MCP), and
- a **PageSpeed Insights API key** so `psi.sh` stops hitting the shared “quota exceeded” limit.

About 10 minutes. Use the Google account that can see trafigurafoundation.org in Search Console.

> The page at developers.google.com is documentation only. Everything below happens at **console.cloud.google.com**.

## 1. Create a project

1. Open <https://console.cloud.google.com/>.
2. Top bar → project picker (next to the Google Cloud logo) → **New project**.
3. Name: `trafigura-seo` → **Create**. Make sure it is selected in the top bar afterwards.

## 2. Turn on the two APIs

1. Open <https://console.cloud.google.com/apis/library>.
2. Search **Google Search Console API** → open it → **Enable**.
3. Back to the library, search **PageSpeed Insights API** → **Enable**.

## 3. Consent screen (needed once before an OAuth client)

1. Open <https://console.cloud.google.com/auth/overview> → **Get started**.
2. App name `Trafigura SEO`, support email = your address → **Next**.
3. Audience:
   - Google Workspace account (e.g. @yourcompany.com) → choose **Internal**. Done, skip to step 4.
   - Personal Gmail → choose **External**.
4. Contact email → **Next** → agree → **Create**.
5. External only: **Audience** → **Test users** → **Add users** → your Gmail → Save.
   Then click **Publish app** on the same page. Without publishing, Google expires the login every 7 days. Publishing a personal-use app does not need Google review; you will just see “Google hasn’t verified this app” on first login → **Advanced** → **Go to Trafigura SEO**.

## 4. OAuth client for the Search Console MCP

1. Open <https://console.cloud.google.com/auth/clients> → **Create client**.
2. Application type **Desktop app**, name `Cursor GSC` → **Create**.
3. Click **Download JSON**.
4. In Terminal:

   ```bash
   mv ~/Downloads/client_secret_*.json ~/.config/mcp-gsc/client_secrets.json
   ```

## 5. API key for PageSpeed

1. Open <https://console.cloud.google.com/apis/credentials> → **Create credentials** → **API key**. Copy it.
2. Click the key → **API restrictions** → **Restrict key** → tick **PageSpeed Insights API** → **Save**.
3. In Terminal (paste your key in place of `YOUR_KEY`):

   ```bash
   printf '%s' 'YOUR_KEY' > ~/.config/mcp-gsc/psi_api_key && chmod 600 ~/.config/mcp-gsc/psi_api_key
   ```

## 6. Connect Cursor

1. Quit Cursor completely (**Cmd+Q**) and reopen it.
2. In chat, ask: **“List my GSC properties.”**
3. A browser window opens → choose the Google account → **Allow**. The login is saved; you won’t be asked again.
4. If nothing happens, ask **“Call get_capabilities”** — it reports what is missing.

Then PageSpeed runs with:

```bash
bash SEO/measurement/psi.sh
```

## Nothing to share

Keep both files private. They live outside the theme repo (`~/.config/mcp-gsc/`), so they are never committed or deployed.
