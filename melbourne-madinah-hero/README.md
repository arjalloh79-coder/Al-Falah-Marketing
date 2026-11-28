# Melbourne Madinah — Animated Hero Concepts

Three complete, standalone animated hero sections for the Melbourne Madinah
homepage. Open the chooser, compare the feel, and pick one.

Built with **plain HTML + CSS + vanilla JS + inline SVG**. No frameworks, no
build step, no npm install. Just open the files.

---

## 1. How to run (local preview)

From **this folder** (`melbourne-madinah-hero/`), start any static server:

```bash
python3 -m http.server 8080
```

or

```bash
npx serve -l 8080
```

Then open:

- `http://localhost:8080/` — chooser (3 preview cards)
- `http://localhost:8080/option-1/` — Geometric Awakening
- `http://localhost:8080/option-2/` — Dawn Over Melbourne
- `http://localhost:8080/option-3/` — Arch of Light

> You can also just double-click `index.html`, but a server is recommended so
> the shared CSS/JS and relative links resolve exactly like production.

---

## 2. The three options

| # | Name | Mood | Best for | Trade-off |
|---|------|------|----------|-----------|
| 1 | **Geometric Awakening** | Calm, elegant, minimal | A timeless, text-first first impression | Least "wow" on first load |
| 2 | **Dawn Over Melbourne** | Warm, local, grounded | Showing the mosque *in* Melbourne | Busiest scene; most to art-direct |
| 3 | **Arch of Light** | Cinematic, premium, spiritual | Maximum emotional impact | Boldest; content sits over artwork |

All three:
- Full-viewport hero with a slim sticky header + mobile menu
- Headline, subheadline, two CTAs (**Prayer Times**, **Visit Us**)
- A strip with **next prayer time** + **address** (placeholders)
- A static, equally-polished version when `prefers-reduced-motion` is on
- Work at 360px, 768px and 1440px wide

---

## 3. How to pick an option

1. Preview all three full-screen on desktop **and** on your phone.
2. Decide the feeling you want visitors to have in the first 2 seconds:
   *settled* (1), *at home in Melbourne* (2), or *moved / invited in* (3).
3. Once chosen, that option's folder becomes your homepage hero — the header,
   buttons and info strip are already production-ready.

---

## 4. How to edit the text (non-technical)

Each option keeps **all hero copy in one clearly-marked block**. Open the
option's `index.html` and look for:

```
<!-- ====== EDIT ALL HERO TEXT IN THIS BLOCK ONLY ====== -->
...headline, subheadline, buttons, prayer + address...
<!-- ===================== END HERO TEXT ===================== -->
```

Change the words between those comments. Placeholders to replace are wrapped so
they are easy to spot on the page (gold dashed underline), e.g.
`[PRAYER NAME]`, `[PRAYER TIME]`, `[ADDRESS]`.

### Change colours / fonts globally
Edit the tokens at the top of **`assets/css/shared.css`** (the `:root` block):

```css
--emerald: #0B3D2E;
--gold:    #C9A24B;
--ivory:   #F7F3E8;
--midnight:#0A1A2F;
```

Changing them updates all pages at once.

---

## 5. Placeholders you must replace before going live

- `[PRAYER NAME]` and `[PRAYER TIME]` — the next prayer label + time
- `[ADDRESS]` — full street address
- `[PHONE]` — phone number (in the SEO schema at the bottom of each file)
- `[WEBSITE URL]` — the live site URL (SEO schema)
- `assets/og-placeholder.jpg` — a social-share preview image (1200×630)

> **Cultural note:** the designs use **only** geometry, architecture, light and
> stars — no people, animals or faces. No Quran verses, hadith, prayer times or
> donation details have been invented. If you later add any Arabic text (e.g.
> *Bismillah*), please have the mosque committee verify the exact spelling first.

---

## 6. Deploy (publish for the committee / phone)

This is a static site — drag-and-drop anywhere.

- **Netlify:** drag the `melbourne-madinah-hero` folder onto
  [app.netlify.com/drop](https://app.netlify.com/drop)
- **Vercel CLI:** `vercel --prod` from this folder
- **Surge:** `surge . your-name.surge.sh`
- **Hostinger / cPanel:** upload the folder's contents via File Manager / FTP

---

## 7. Accessibility & performance (already handled)

- Semantic HTML, keyboard-navigable nav, visible gold focus rings
- `prefers-reduced-motion` respected (static fallback on every page)
- Animations use only `transform` / `opacity` for smooth 60fps
- Each option is **~25–30KB** of HTML/CSS/JS (well under 300KB, fonts excluded)
- SEO: title, meta description, Open Graph tags, and `PlaceOfWorship` schema

---

_Hero concepts built by Al-Falah Marketing for Melbourne Madinah._
