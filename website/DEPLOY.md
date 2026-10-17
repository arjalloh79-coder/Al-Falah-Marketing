# Al-Falah Marketing — Deploy (Hostinger)

## Correct structure
All site files must sit **directly** in `public_html/`:

```
public_html/
  index.html
  about.html
  english-app.html
  robots.txt
  sitemap.xml
  404.html
  assets/
  api/
  admin/
  blog/
  services/
```

Never extract into a subfolder like `public_html/al-falah-full-site/`.

## After upload
1. Hard refresh: Ctrl+Shift+R
2. Test https://al-falahmarketing.com/
3. Test https://al-falahmarketing.com/sitemap.xml
4. Test contact form + newsletter (needs PHP + `api/config.php` email settings)

## English Learning App
- Marketing page: `/english-app.html`
- Live PWA: https://english.al-falahmarketing.com/
- Code: GitHub `arjalloh79-coder/Al-Falah-English-Learning` (Vite build → deploy `dist/` to that subdomain)

## Blog images
Do not use `/storage/public/blogs/` (old Laravel). Use `assets/images/` covers.
