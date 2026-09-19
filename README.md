# H.Tubman Solutions Limited — Website

PHP website for H.Tubman Solutions (CCTV & Security + ICT Solutions), live domain **https://www.htubmansolutions.com**.
Layout follows the "Reparo" technology template; colours come from the H.Tubman logo.

## Run locally
- **XAMPP:** start Apache, then open http://localhost/tubmansolutions/
- **Without Apache:** `C:/xampp/php/php.exe -S localhost:8090 router.php` from this folder, then open http://localhost:8090/

## 1. Turn on email (required once)
Every form sends to **info@htubmansolutions.com** through Titan Email (Hostinger) SMTP.

1. Open `includes/mail-config.php` (a private file: git-ignored and blocked from the web).
2. Put the info@ mailbox password in `'password' => ''`.
3. Submit the contact form once and check the info@ inbox.

If delivery fails, the reason is written to `storage/mail-errors.log`. Every enquiry is also saved in `storage/enquiries.csv`, so nothing is ever lost.
Settings used: `smtp.titan.email`, port `465`, SSL, username `info@htubmansolutions.com`.

## 2. Where to edit things
| What | File |
|---|---|
| Phones, WhatsApp, email, domain, address, opening hours, social links, Google review link | `includes/config.php` → `$SITE` |
| Page URLs (SEO slugs) | `includes/config.php` → `$ROUTES` **and** `.htaccess` |
| Service content, H1s, SEO titles & descriptions | `includes/config.php` → `$SERVICES` |
| FAQs (feed the FAQ page, search answers, FAQ schema and llms.txt) | `$FAQS`, `$FAQ_ICT`, `$FAQ_GENERAL` |
| Clients, industries, service areas, CCTV data | `includes/config.php` |
| Photos (Unsplash IDs or local paths like `assets/img/projects/site-1.jpg`) | `$IMAGES` |
| Search synonyms | `includes/search-engine.php` → `SEARCH_SYNONYMS` |

## 3. SEO & AI-search features
- **Clean keyword URLs** (e.g. `/cctv-installation-uganda`). Old `.php` addresses 301-redirect to them.
- **Unique title, meta description, H1, canonical URL, Open Graph and X/Twitter tags** on every page.
- **Structured data (JSON-LD):** LocalBusiness (NAP, contact points incl. WhatsApp, service catalogue, areas served), WebSite, WebPage, BreadcrumbList, a Service entry per service page, and FAQPage wherever FAQs appear.
- **Share images:** 1200×630 PNG per page in `assets/img/og/`. To regenerate after editing content:
  ```
  C:/xampp/php/php.exe tools/og-data.php > tools/og-data.json
  python tools/make-og-images.py                 # or add: --photo path/to/real-installation.jpg
  ```
- **`/sitemap.xml`** (automatic, with lastmod + images), **`/robots.txt`** (explicitly allows Google, Bing, ChatGPT, Perplexity, Claude, Gemini and Apple crawlers), and **`/llms.txt`**, a plain-language business summary for AI assistants. All are generated from `config.php`.
- **FAQ page** (`/faq`) answering the questions people type or ask voice assistants ("CCTV installation near me", cost, brands, remote viewing…).
- **Site search** (header magnifier, or press `/`): synonyms (kamera, fingerprint, wifi, "how much"…), typo correction, instant FAQ answers. Searches are logged to `storage/searches.csv`, so you can see what customers look for and write content for it.

## 4. Go-live checklist (off-site work that decides local rankings)
1. **Google Business Profile.** Primary category *Security system installer*. Add *Computer support and services*, *Computer networking service*, *Security service* and *Computer consultant*. Use the exact name, phone and website from `$SITE`. Add the WhatsApp link, services, real photos and opening hours. Then paste the profile URL into `$SITE['google_business']` and the review link into `$SITE['google_review']` (a "Review us" button appears in the footer).
2. **Google Search Console + Bing Webmaster Tools.** Verify the domain and submit `https://www.htubmansolutions.com/sitemap.xml`.
3. **Reviews.** Ask every satisfied client for a Google review, and reply to all of them.
4. **Citations.** List the business with identical name, phone and website on Yellow Pages Uganda, BusinessList Uganda, Facebook, LinkedIn and Instagram. Add those profile URLs to `$SITE['social']`; they are then included in the schema (`sameAs`) and shown in the footer.
5. **Real photos.** Replace stock photos with your own installations (`$IMAGES`) and regenerate the share images with `--photo`.
6. **Address & hours.** Fill in `$SITE['street']` and `$SITE['hours']` once they match the Google Business Profile exactly.
7. Confirm you have permission to show each client in `$CLIENTS`.
8. If the site ever runs in a sub-folder, update the `ErrorDocument` path in `.htaccess`.
