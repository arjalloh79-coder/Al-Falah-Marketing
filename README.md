# Al-Falah Marketing — Official Website

**Live site:** [https://al-falahmarketing.com](https://al-falahmarketing.com)  
**Owner:** [arjalloh79-coder](https://github.com/arjalloh79-coder) · Abdulrahman Jalloh

This repository is the **single source of truth** for the Al-Falah Marketing production website (static multi-page site + PHP forms/admin + AI assistant).

## Structure

```
/
├── index.html, about.html, services.html, …   # Public pages
├── blog/ , services/ , institutions-*.html    # Sections
├── assets/images/ , assets/videos/            # Media
├── api/          # contact, newsletter, AI assistant (PHP)
├── admin/        # Simple PHP admin (blog/pages)
├── ai-assistant.js , theme-toggle.js , theme-light.css
├── lang-persist.js
└── archive/      # Pointers to older projects (see below)
```

## Deploy (Hostinger)

1. Upload contents of this repo to `public_html/`
2. Ensure PHP 8+ and `curl` enabled
3. Edit `api/config.php` — set admin password + optional `OPENAI_API_KEY`
4. Optional: Hostinger **Git** deploy from `main` → `public_html`

## Features

- Bilingual EN/FR (`localStorage` + `lang-persist.js`)
- Dark / light theme toggle
- Institutions track + portfolio + blog
- Hybrid AI assistant (`api/ai-assistant.php` + OpenAI)
- Contact & newsletter endpoints

## Older Al-Falah repos (consolidate / delete)

These were separate mockup or legacy projects. Prefer **one** repo (this one). You can delete the others in GitHub → Settings → Delete repository:

| Repository | Role |
|------------|------|
| `Al-Falah-Marketing` (this) | **Canonical website** |
| `restaurant-agadir-kaloum-mockup` | Client mockup |
| `oklm-grill-kipe-mockup` | Client mockup |
| `zion-kitchen-laurel-mockup` | Client mockup |
| `crown-bakery-freetown-mockup` | Client mockup |
| `halal-brothers-silverspring-mockup` | Client mockup |
| `abioseh-bakery-freetown-mockup` | Client mockup |
| `restaurant-obureau-kobayah-mockup` | Client mockup |
| `kaki-restaurant-kipe-mockup` | Client mockup |
| `minaah-co-mockup` | Client mockup |
| Other `*-mockup` / Laravel experiments | Legacy |

Optional: move mockup HTML into `archive/client-mockups/<name>/` if you still need them in-git.

## License

Proprietary © Al-Falah Marketing. All rights reserved.
