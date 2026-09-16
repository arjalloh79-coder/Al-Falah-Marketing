# Order & backend service notifications

## What changed (2026-09-16)

Since the initial lead-capture work in August, a real backend appeared: **Al-Falah Services**, a Base44 app connected via MCP (`mcp__Al-Falah_Services__*` tools). This is direct, live, queryable/writable access to:

- **Services** — the 6 real service listings (Web Development $499, Digital Marketing $299/mo, Branding & Design $199, AI & Automation $399, Content Creation $149, IT Solutions $199/mo), matching the site.
- **Orders** — real customer orders with West-Africa-appropriate payment methods baked in: Orange Money, MTN Money, Wave, Moov Money, bank transfer, card.

This is meaningfully better than the August situation (no backend/API access at all, network egress blocked). Whether this Base44 backend is the actual site's backend, or a separate ordering layer connected to it, wasn't confirmed — worth clarifying with whoever set it up.

As of 2026-09-16, **zero orders** had been placed through it.

## Order tracker sheet

**Al-Falah Marketing - Orders**: https://docs.google.com/spreadsheets/d/1CtZT6rMKl0Ffhost9SNXPdLyhxTAjn1hliQVWGOZSbE/edit

Columns: Order ID, Timestamp, Customer Name, Company, Email, Phone, Service, Amount, Currency, Payment Method, Payment Number, Transaction ID, Status, Project Details, Notified.

## Notification mechanism

A scheduled Routine ("Al-Falah new order watch", hourly, `0 * * * *`) fires into this Claude Code session and:

1. Queries `mcp__Al-Falah_Services__query_order` (sorted newest-first).
2. Compares against Order IDs already logged in the Orders sheet.
3. For any new order: appends a row to the sheet, and emails arjalloh79@gmail.com with the order summary.
4. If nothing new, it does nothing silently — no notification spam.

This is polling, not a true push webhook — up to a ~1 hour delay between an order landing and being noticed. If faster notice matters once real order volume shows up, ask about tightening the interval or checking whether Base44 supports outbound webhooks directly (would need Base44 admin access to configure, not available from here).

## Open follow-ups

- Confirm whether Al-Falah Services (Base44) is the live site's actual backend, replacing the Laravel `/contact-submit` and `/consultation-store` forms documented in `lead-capture-setup.md`, or a separate system running alongside it. If it replaces the Laravel forms, `lead-capture-setup.md`'s webhook plan may be unnecessary — leads would already be reachable directly the way orders are.
- The `al-falah-lead-triage` skill (`.claude/skills/al-falah-lead-triage/`) currently only knows about the Leads sheet — worth extending it to also check/log against the Orders sheet once there's real order volume to triage.
