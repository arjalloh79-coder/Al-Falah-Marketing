# Lead & Automation Plan (working notes)

Goal: get from "lead comes in" to "appointment booked" running through Zapier MCP + the WhatsApp assistant, with minimal manual work and clear human checkpoints on anything involving money or commitments.

## Current state (as of 2026-08-29)

- Zapier MCP connected under arjalloh79@gmail.com, with Gmail and Google Calendar enabled and authenticated.
- The `alfalah-whatsapp-sales-assistant` skill exists and is usable for drafting/simulating WhatsApp replies, but is not wired into an actual WhatsApp automation yet — messages are pasted in manually.
- Site has two lead-capture forms:
  - General contact form → POSTs to `/contact-submit` (fields: first/last name, email, phone, service interest, message)
  - "Free Consultation" booking form → POSTs to `/consultation-store` (fields: name, email, preferred meeting date, subject)
  - Both use Laravel-style CSRF tokens, implying a server-rendered backend (not static hosting) — likely has its own database of submissions.
- No CRM confirmed. No payment processor confirmed.

## Open questions to unblock full automation

1. **Site backend access.** Is there an admin panel, database export, or webhook/API for new contact-submit and consultation-store entries? Without this, leads submitted through the site can't be pulled into Zapier automatically.
2. **WhatsApp channel.** Is the WhatsApp number (+1 240-280-6137) on a business API (Twilio, 360dialog, Meta Cloud API) or just a phone with the WhatsApp app? Automating replies requires an API-connected number — Zapier has WhatsApp Business integrations, but not for a plain personal/business app number.
3. **CRM.** Where should qualified leads land — Google Sheets as a lightweight start, or a real CRM (HubSpot is available as a Zapier app)?
4. **Booking.** Should "book a free session" go straight to Google Calendar (already connected), or through a scheduling tool (Calendly etc.)?
5. **Who reviews before send.** Confirm autonomy level: draft-and-approve vs. auto-send for routine replies (recommended: draft-and-approve until the flow is proven).

## Proposed pipeline (once above is answered)

1. **Capture** — lead comes in via site form, WhatsApp, or email.
2. **Log** — new lead written to a sheet/CRM automatically (Zapier).
3. **Qualify** — WhatsApp assistant (or an email equivalent) drafts a qualifying reply; human approves initially.
4. **Book** — once qualified, propose 2 time slots and create a Google Calendar event on confirmation.
5. **Notify** — Slack/email ping to the human rep with the lead card (name, business, challenge, budget/timeline, slot booked).

## Explicitly out of scope for automation (for now)

- Actual service delivery (design, dev, campaign execution) — human-led.
- Payments / invoicing — no processor confirmed yet; do not build this until one is chosen.
- Anything requiring the site's admin credentials — handle via a scoped integration or the site owner directly, not by sharing admin login in chat.
