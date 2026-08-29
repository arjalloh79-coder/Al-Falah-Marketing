# Lead & Automation Plan (working notes)

Goal: get from "lead comes in" to "appointment booked" running through Zapier MCP + the WhatsApp assistant, with minimal manual work and clear human checkpoints on anything involving money or commitments.

## Current state (as of 2026-08-29)

- Zapier MCP connected under arjalloh79@gmail.com, with Gmail, Google Calendar, and Google Sheets enabled and authenticated.
- **Lead tracker sheet created:** [Al-Falah Marketing - Leads](https://docs.google.com/spreadsheets/d/16khY9MvQdI80zZlJ8a5VmpXQjGsJfymbVD3H-f_0MI0/edit) — columns: Timestamp, Source, First Name, Last Name, Business, Email, Phone, Service Interest, Message/Subject, Status, Next Step, Notes.
- The `alfalah-whatsapp-sales-assistant` skill exists and is usable for drafting/simulating WhatsApp replies, but is not wired into an actual WhatsApp automation yet — messages are pasted in manually.
- Site has two lead-capture forms:
  - General contact form → POSTs to `/contact-submit` (fields: first/last name, email, phone, service interest, message)
  - "Free Consultation" booking form → POSTs to `/consultation-store` (fields: name, email, preferred meeting date, subject)
  - Both use Laravel-style CSRF tokens, implying a server-rendered backend (not static hosting) — likely has its own database of submissions.
- Confirmed via clarifying questions (2026-08-29):
  - **Site backend:** custom-built Laravel/PHP — no admin panel or API access yet, so form submissions can't be pulled automatically without either backend access or the developer adding a webhook.
  - **WhatsApp:** the number (+1 240-280-6137) is just the app on a phone, not a Business API — replies can't be automated/sent programmatically; the WhatsApp assistant skill stays a paste-in/copy-out tool for now.
  - **CRM:** Google Sheets chosen as the lightweight starting point (done — see tracker link above).
- Checked whether `info@al-falahmarketing.com` (a Gmail inbox under arjalloh79@gmail.com) receives form-submission notifications — searched broadly, found none. Either no submissions have come in yet, or the site isn't configured to send a notification email at all. Unconfirmed either way — needs a real test submission to verify.
- No payment processor confirmed.

## Open questions to unblock full automation

1. **Site backend access.** Confirmed no admin/API access. Next step: either (a) get read access to the leads table/export, or (b) ask the developer to add a webhook call (e.g. to Zapier's "Webhooks by Zapier" catch-hook, or directly to a script that appends to the Sheet) inside the `/contact-submit` and `/consultation-store` handlers. Do NOT hand over admin credentials as a shortcut — see "explicitly out of scope" below.
2. **WhatsApp channel.** Confirmed: plain phone app, not a Business API. To automate WhatsApp replies for real, the number would need to move to a Business API provider (Twilio, 360dialog, Meta Cloud API) — a real decision with cost/setup implications, not something to do silently.
3. ~~**CRM.**~~ Resolved — Google Sheets tracker created.
4. ~~**Booking.**~~ Resolved — dedicated "Al-Falah Marketing" Google Calendar created, see `booking-setup.md`.
5. **Who reviews before send.** Confirm autonomy level: draft-and-approve vs. auto-send for routine replies (recommended: draft-and-approve until the flow is proven).
6. **Test submission needed** to confirm whether the site sends any notification at all when a form is submitted — this determines if the email-watching approach is viable.
7. **Network access confirmed blocked (2026-08-29).** This Claude Code session's environment blocks all outbound access to `al-falahmarketing.com` and `hpanel.hostinger.com` (org-level egress policy, confirmed via direct `curl` — not a login/credentials issue). This means direct backend/hPanel access isn't usable from this session regardless of what credentials are granted; it would need a differently-configured environment. Doesn't change the recommended approach — the webhook method in `lead-capture-setup.md` doesn't require this session to reach the site at all.

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
