# Booking destination: Google Calendar

Status: **live** — a dedicated secondary calendar, **"Al-Falah Marketing"**, under the arjalloh79@gmail.com Google account (connected via Zapier MCP).

Calendar: https://calendar.google.com/calendar/embed?src=be6c32e7ec669d03d659818ae0bf901bebc5dadf8d7b3b72ee2a70e3c00cf3d4@group.calendar.google.com
Calendar ID: `be6c32e7ec669d03d659818ae0bf901bebc5dadf8d7b3b72ee2a70e3c00cf3d4@group.calendar.google.com`

## Why a secondary calendar, not the primary one

The original ask was to have booking invites show as sent from `info@al-falahmarketing.com`. That's not actually possible: Google Calendar always sends invites from the real authenticated account, not a Gmail "Send as" alias (unlike Gmail's compose window) — `info@al-falahmarketing.com` is an alias that forwards into arjalloh79@gmail.com, not a separately-loginable Google account, so there's no real calendar behind it to switch to.

The practical compromise: a dedicated **"Al-Falah Marketing"** calendar. Invites from it show "Al-Falah Marketing" as the organizer name (rather than a personal name), and it keeps business bookings cleanly separated from personal events — even though the underlying account/email is still arjalloh79@gmail.com. A genuine `info@al-falahmarketing.com` sender address would require a real, separately-loginable Google account for that address (e.g. Google Workspace) with its own calendar — not set up currently.

## How it works right now

1. A lead gets qualified (via the WhatsApp assistant playbook, a drafted email reply, or manual note).
2. When ready to book, I propose two concrete time slots (per the WhatsApp assistant's CTA step).
3. Once the lead confirms a slot, I create an event on the **Al-Falah Marketing** calendar:
   - Title: `Al-Falah Marketing — Consultation: {lead name / business}`
   - Description: lead context (challenge, budget/timeline if known, source, contact method)
   - Attendee: the lead's email, if provided
   - Time: the confirmed slot
4. The lead row in the [Leads sheet](https://docs.google.com/spreadsheets/d/16khY9MvQdI80zZlJ8a5VmpXQjGsJfymbVD3H-f_0MI0/edit) gets its Status updated to "Booked" and Next Step filled in.

This only happens when I'm asked to book something in a chat session — it is not yet a standing background automation (see `lead-capture-setup.md` and `whatsapp-automation-setup.md` for what it would take to make the whole pipeline run without a chat session open).
