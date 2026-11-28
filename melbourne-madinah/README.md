# Melbourne Madinah — Official Website

A production-ready, mobile-first website for **Melbourne Madinah** — a working masjid and community hub at **359 Exhibition Street, Melbourne CBD**. A Mercy Mission initiative.

Built as a fast, portable **static site** (semantic HTML5 + compiled Tailwind CSS + a little vanilla JS). No server or database required — it runs anywhere you can host files.

---

## ✨ What's inside

| Feature | Detail |
|--------|--------|
| **Sticky glassmorphic header** | Wordmark, navigation, live "next prayer" chip, Support CTA, mobile menu |
| **Editorial hero** | Arch-framed venue photography, Arabic greeting, live next-prayer countdown |
| **Live prayer timetable** | Athān (begins) times calculated **in the browser** for Melbourne each day (NOAA solar algorithm, DST-safe), with **Iqāmah** times from the Madinah's own board. The next prayer is highlighted automatically. |
| **Jumu'ah card** | First 1:10 PM · Second 2:00 PM · brothers downstairs, sisters upstairs |
| **About, Programs, Gallery** | Real content — Grounded youth program, Madinah Nights, classes, Zakat desk, Heritage Central |
| **Support & Sadaqah** | Men's Ablution Facilities appeal ($100,000 goal), giving tiers, bank details, Zakat/EFTPOS |
| **Plan Your Visit** | Address, Maps link, transit & parking, entrance photo cue, contact form |
| **SEO & accessibility** | Open Graph + Twitter tags, JSON-LD `Mosque` schema, semantic landmarks, ARIA labels, keyboard focus, reduced-motion support |

> **Prayer-time accuracy:** Athān times use the Muslim World League method (Fajr 18° / Isha 17°, standard Asr) and are validated against the NOAA solar algorithm (solar noon, sunrise and sunset match to within a minute). Iqāmah offsets are **Fajr +30, Dhuhr +10, Asr +10, Maghrib +5, Isha +10** minutes, taken from the Madinah's board. These are a guide — the on-site board is always the source of truth, especially in Ramadan.

---

## 📁 Structure

```
melbourne-madinah/
├── index.html              # The entire website (single page)
├── styles.css              # Compiled Tailwind + custom styles (committed — ready to deploy)
├── src/input.css           # Tailwind source (edit this, then rebuild)
├── tailwind.config.js      # Brand colours & fonts
├── package.json            # Build scripts
└── public/
    └── images/             # Venue photography (semantic filenames)
        ├── entrance-courtyard.jpg
        ├── entrance-laneway.jpg
        ├── interior-calligraphy.jpg
        ├── reception-welcome-desk.jpg
        └── interior-hallway.jpg
```

---

## 🚀 Preview locally

It's a static site — just open it:

```bash
open index.html
```

Or serve it (recommended, so relative paths behave exactly like production):

```bash
cd melbourne-madinah
python3 -m http.server 8080
# then visit http://localhost:8080
```

---

## 🎨 Customise

### Text & times
- **All copy** lives in `index.html`. Search for the section you want (e.g. `id="programs"`).
- **Jumu'ah times, iqāmah offsets, location** are near the bottom of `index.html` in the `<script>` block — see the `IQAMA`, `LAT`, `LNG` and the Jumu'ah card markup.

### Colours & fonts
Edit `tailwind.config.js`, then rebuild (below). The palette:

| Token | Hex | Use |
|-------|-----|-----|
| `canvas` | `#FAF8F5` | Page background |
| `stone` | `#F2EFE9` | Alt sections |
| `emerald` | `#14453D` | Primary accent |
| `brass` | `#C59B48` | Secondary accent |
| `charcoal` | `#1C1E1D` | Body text |
| `slate` | `#5A605D` | Metadata |

### Rebuilding the stylesheet
Only needed if you change Tailwind classes in the HTML or edit `src/input.css` / `tailwind.config.js`. The compiled `styles.css` is already committed, so **deployment needs no build step.**

```bash
npm install      # one time
npm run build    # regenerate styles.css
npm run watch    # auto-rebuild while editing
```

### Swapping / adding photos
Drop a web-optimised JPG (≈1400px long edge, under ~300 KB) into `public/images/` with a semantic name, then point the matching `<img src="public/images/…">` at it. Keep the `alt` text descriptive.

### Contact form
The form posts to a placeholder endpoint. To receive messages, create a free form at **[Formspree](https://formspree.io)** (or similar) and replace `https://formspree.io/f/your-form-id` in `index.html` with your endpoint. Or wire it to your own mail handler.

---

## 🌐 Deploy

Pick whichever is easiest — all work with these static files as-is:

- **Netlify / Vercel / Cloudflare Pages:** drag-and-drop the `melbourne-madinah` folder, or connect the repo.
- **Hostinger / cPanel:** upload the folder's contents to `public_html/`.
- **GitHub Pages:** serve from the folder on your chosen branch.

No PHP, Node runtime, or database is required at runtime.

---

## 📸 Photo slots ready for your images

Two curated slots in the **"Inside Melbourne Madinah"** gallery are styled and waiting for photos — the **prayer hall (musallā)** and the **sisters' prayer area**. Additional contextual spots can be added for the ablution facilities and the street entrance. See the handoff note from Al-Falah Marketing for exactly where each image drops in.

---

© Melbourne Madinah · A Mercy Mission initiative. All rights reserved.
Website crafted by **[Al-Falah Marketing](https://al-falahmarketing.com)**.
