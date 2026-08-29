# Booking destination: Google Calendar

Status: **live**, connected under arjalloh79@gmail.com via Zapier MCP.

## How it works right now

1. A lead gets qualified (via the WhatsApp assistant playbook, a drafted email reply, or manual note).
2. When ready to book, I propose two concrete time slots (per the WhatsApp assistant's CTA step).
3. Once the lead confirms a slot, I create a Google Calendar event:
   - Title: `Al-Falah Marketing — Consultation: {lead name / business}`
   - Description: lead context (challenge, budget/timeline if known, source, contact method)
   - Attendee: the lead's email, if provided
   - Time: the confirmed slot
4. The lead row in the [Leads sheet](https://docs.google.com/spreadsheets/d/16khY9MvQdI80zZlJ8a5VmpXQjGsJfymbVD3H-f_0MI0/edit) gets its Status updated to "Booked" and Next Step filled in.

This only happens when I'm asked to book something in a chat session — it is not yet a standing background automation (see `lead-capture-setup.md` and `whatsapp-automation-setup.md` for what it would take to make the whole pipeline run without a chat session open).

## Open decision

Currently defaults to the primary Google Calendar on arjalloh79@gmail.com. If Al-Falah Marketing should have its own dedicated calendar (so it's not mixed with personal events), say so and I'll create one and switch the default.
