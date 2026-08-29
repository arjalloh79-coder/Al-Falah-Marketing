# Al-Falah Marketing

Business context, brand reference, and automation configs for Al-Falah Marketing — kept here so lead handling, content, and site work stay consistent across sessions and tools.

## About

Al-Falah Marketing is a digital marketing agency helping SMBs and government institutions become competitive in the modern AI and tech landscape. Operating out of **Conakry / Coyah, Guinea** and **Freetown, Sierra Leone**, serving clients more broadly (site is bilingual EN/FR, HQ address listed in Laurel, MD, USA).

Site: https://www.al-falahmarketing.com

## Services

| Service | What it covers |
|---|---|
| Web Development | Custom web apps, e-commerce, CMS integration |
| Digital Marketing | SEO & SEM, social media ads, email marketing |
| Branding & Design | Logo & visual identity, UI/UX design, marketing collateral |
| AI & Automation | AI chatbots, CRM automation, workflow optimization |
| Content Creation | Video marketing, blog & copywriting, graphics production |
| IT Solutions | Cloud hosting, cyber security, tech support |

## Contact

- **Phone / WhatsApp:** +1 240-280-6137
- **Email:** info@al-falahmarketing.com
- **Office:** 8468 Winding Trail, Laurel, MD 20724, USA
- **Facebook:** https://www.facebook.com/profile.php?id=61573274222922
- **Instagram:** https://www.instagram.com/alfalahmarketinginc/
- **LinkedIn:** https://www.linkedin.com/company/al-falah-marketing-inc/
- **YouTube:** https://youtube.com/@al-falahmarketing-official

## Brand

- Colors: primary `#3B82F6` (blue), secondary `#10B981` (green), accent `#F59E0B` (amber), dark `#111827`
- Font: Outfit (Google Fonts)
- Languages: English / French, switchable site-wide

## Clients / portfolio referenced on site

Acile Coffee, Shawarma Sam, Labonet, E.I. Maloum, Metal Star Africa SARL, District Wildlife Solutions. FatimaVoyages is also an active client (separate repo: `arjalloh79-coder/fatimavoyages`), handled as a travel-industry account.

## What's in this repo

- `docs/site-source/` — a saved snapshot of the live homepage HTML, pulled 2026-08-29 (this session's network policy blocks direct access to al-falahmarketing.com, so this is the source of truth until a live connector is set up)
- `docs/whatsapp-sales-assistant.md` — the bilingual WhatsApp lead-qualification playbook already in use
- `docs/lead-and-automation-plan.md` — working notes on wiring up lead capture → CRM → booked calls via Zapier MCP

## Status / open items

- No CRM confirmed yet for storing leads — currently ad hoc
- Site backend platform not yet confirmed (contact/consultation forms POST to `/contact-submit` and `/consultation-store` with CSRF tokens, suggesting a server-rendered app, not a static site)
- Zapier MCP connections (Gmail, Calendar, etc.) are set up under arjalloh79@gmail.com — not yet mapped to Al-Falah-specific lead flow
