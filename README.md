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

- **Phone / WhatsApp (US):** +1 240-280-6137
- **Phone / WhatsApp (Guinea):** +224 611 351 302
- **Phone / WhatsApp (Sierra Leone):** +232 74 321 916
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
- `docs/lead-and-automation-plan.md` — working notes and current status on the overall lead → booking pipeline
- `docs/booking-setup.md` — how Google Calendar is wired up as the booking destination (live)
- `docs/lead-capture-setup.md` — step-by-step to automate pulling leads from the site's contact/consultation forms into the tracker sheet
- `docs/whatsapp-automation-setup.md` — step-by-step to move WhatsApp from a plain phone app to an automatable Business API
- `content/batch-1/` — first content batch: blog post + video script (EN/FR) and social captions for Facebook/Instagram/LinkedIn/YouTube
- `.claude/skills/al-falah-lead-triage/` — active skill: classify inbound leads (genuine / cold-pitch / suspicious / spam), draft the right reply, and log to the tracker sheet

## Status / open items

- **Lead tracker:** live — [Al-Falah Marketing - Leads](https://docs.google.com/spreadsheets/d/16khY9MvQdI80zZlJ8a5VmpXQjGsJfymbVD3H-f_0MI0/edit) (Google Sheets, via Zapier MCP)
- **Booking:** live — Google Calendar connected, see `docs/booking-setup.md`
- **Automated lead capture from the site:** not yet built — needs a webhook added to the Laravel form handlers (see `docs/lead-capture-setup.md`); requires a paid Zapier plan for the Webhooks app
- **WhatsApp automation:** not yet built — the number is a plain phone app today, not a Business API; see `docs/whatsapp-automation-setup.md` for the path via Twilio
- Site backend platform confirmed: custom Laravel/PHP, no admin/API access currently available
- Zapier MCP connections (Gmail, Calendar, Sheets) are set up under arjalloh79@gmail.com
