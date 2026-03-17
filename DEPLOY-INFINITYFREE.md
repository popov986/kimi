# Deploy this project on InfinityFree

Follow these steps to put your Ki-Mi site on [InfinityFree](https://www.infinityfree.com/) (dash.infinityfree.com).

---

## 1. Create an account and site

1. Go to **https://dash.infinityfree.com/** and sign up / log in.
2. Click **Create Account** (or use **New Account**).
3. Choose a domain (free subdomain like `yoursite.infinityfreeapp.com` or connect your own).
4. Wait until the account is active (a few minutes). Note your **FTP username**, **FTP password**, and **hostname** (e.g. `ftpupload.net`).

---

## 2. Upload the project

Your **document root** on InfinityFree must be the folder that contains **both** the `public` folder **and** the `HTWF`, `images`, `scripts` folders (the whole Template folder).

### Option A: Using the online File Manager

1. In the InfinityFree dashboard, open **File Manager** (or **htdocs** / **public_html**).
2. Go into the folder that is your **document root** (often `htdocs` or `public_html`).
3. Upload the **entire contents** of your `Template` folder into this root so that you see:
   - `.htaccess` (at the root)
   - `public/` (folder with `index.php`, `home.php`, `about.php`, etc.)
   - `includes/`
   - `HTWF/`
   - `images/`
   - `scripts/`
   - Any other folders in Template (e.g. `pages/` if present).

So the structure on the server should look like:

```
htdocs/  (or public_html/)
├── .htaccess
├── public/
│   ├── index.php
│   ├── home.php
│   ├── about.php
│   ├── contact.php
│   ├── portfolio.php
│   ├── galery.php
│   ├── search.php
│   └── 404.php
├── includes/
│   ├── config.php
│   ├── head.php
│   ├── header.php
│   ├── footer.php
│   ├── lang.php
│   ├── lang_switch.php
│   └── lang/
│       └── de.php
├── HTWF/
├── images/
└── scripts/
```

### Option B: Using FTP (FileZilla, WinSCP, etc.)

1. Host: use the FTP hostname from the dashboard (e.g. `ftpupload.net`).
2. Username / password: from the dashboard.
3. Connect and go to the **document root** (often `htdocs` or `public_html`).
4. Upload the **whole** `Template` folder contents into that root (same structure as above).

---

## 3. Set the document root (if needed)

- On InfinityFree, the web root is usually **htdocs** or **public_html**.
- Make sure the `.htaccess` file and the `public`, `includes`, `HTWF`, `images`, `scripts` folders are **inside** that root (not one level too deep).

If your panel has a “Document root” or “Web root” setting, point it to the folder that **contains** `public` and `HTWF` (i.e. the folder where `.htaccess` is).

---

## 4. Check PHP version

- In the dashboard, open **PHP configuration** or **Select PHP version**.
- Choose **PHP 7.4** or **8.x**.
- Save. The project uses normal PHP (sessions, `mb_string`, etc.) and works on 7.4+.

---

## 5. Test the site

1. Open your site URL (e.g. `https://yoursite.infinityfreeapp.com/`).
2. You should see the home page.
3. Try:
   - `/about`
   - `/contact`
   - `/search?q=message`
   - Language switch (EN/DE).

If you get **404** or **500**:

- Confirm `.htaccess` is in the document root and that **mod_rewrite** is enabled (InfinityFree usually has it on).
- Confirm the folder structure matches the diagram above.
- Check the host’s error log (dashboard → Error log / Logs) for the exact error.

---

## 6. Optional: contact form email

The contact form sends to the address set in `includes/config.php`:

```php
$contact_email = 'info@kimi-bau.de';
```

- Use an email you can receive (e.g. Gmail).
- On free hosts, mail can be blocked or go to spam; check spam and the host’s “Mail” or “PHP mail” docs.

---

## Quick checklist

- [ ] Entire Template contents uploaded to document root (htdocs / public_html).
- [ ] `.htaccess` is in that root (same level as `public/` and `HTWF/`).
- [ ] PHP 7.4+ selected.
- [ ] Home page loads at `https://yourdomain/`.
- [ ] `/about`, `/contact`, `/search` work.
- [ ] Language toggle and search work.

If something doesn’t work, note the exact URL and error message (or a screenshot) and use that to debug (e.g. wrong path, missing `.htaccess`, or PHP version).
