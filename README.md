# H.Tubman Solutions Limited — Website

PHP website for H.Tubman Solutions (CCTV & Security + ICT Solutions). Layout follows the "Reparo" technology template; colours come from the H.Tubman logo.

## Run locally
- **XAMPP:** start Apache, then open http://localhost/tubmansolutions/
- **Without Apache:** `C:/xampp/php/php.exe -S localhost:8090` from this folder, then open http://localhost:8090/

## Where to edit things
| What | File |
|---|---|
| Phone numbers, WhatsApp number, email, domain | `includes/config.php` → `$SITE` |
| Photos (Unsplash IDs or local paths such as `assets/img/projects/site-1.jpg`) | `includes/config.php` → `$IMAGES` |
| Service page content (lists, headlines, SEO titles) | `includes/config.php` → `$SERVICES` |
| FAQ, clients, industries, values | `includes/config.php` |
| Colours and fonts | `assets/css/style.css` → `:root` |
| Header / footer | `includes/header.php`, `includes/footer.php` |

## Pages
`index.php` (home), `cctv.php` (CCTV landing page), `services.php`, 7 service pages (`networking.php`, `access-control.php`, `it-support.php`, `servers.php`, `cybersecurity.php`, `hardware.php`, `digital-solutions.php`, all rendered by `includes/service-page.php`), `about.php`, `projects.php`, `contact.php`, `404.php`.

## Enquiry forms
All forms post to `contact.php` (`includes/form-handler.php`). Each valid enquiry is:
1. appended to `storage/enquiries.csv` (the folder is blocked from the web by `.htaccess`), and
2. emailed to `$SITE['email']` using PHP `mail()`. This works on most hosts. Local XAMPP does not send mail unless you configure sendmail.

Each form also has a **Send via WhatsApp** button that opens WhatsApp with the form details already filled in.

## Before going live
- Replace stock photos with real H.Tubman project photos (`$IMAGES` in `includes/config.php`).
- Confirm you have permission to show each client name listed in `$CLIENTS`.
- Confirm which number should receive WhatsApp chats (`$SITE['whatsapp']`, currently 0789977270).
- If the site is deployed in a sub-folder, update the `ErrorDocument` path in `.htaccess`.
- Submit `sitemap.xml` in Google Search Console and set up the Google Business Profile (primary category: *Security system installer*).
