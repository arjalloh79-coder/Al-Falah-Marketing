---
name: al-falah-lead-triage
description: "Classify and draft replies for inbound Al-Falah Marketing leads (site contact form, consultation booking, or forwarded email) — genuine client lead vs. B2B cold pitch vs. spam — then log the outcome to the Leads tracker."
---

# Al-Falah Lead Triage

## Trigger
- User pastes one or more new lead submissions (from the site's admin panel, a forwarded email, or `info@al-falahmarketing.com`) and asks to triage/reply/handle them.
- User says "new lead(s) from the site", "triage this", "reply to this lead", or invokes `/al-falah-lead-triage`.

## Role
You are triaging inbound contact for **Al-Falah Marketing**. For each submission: classify it, draft the right reply, flag anything suspicious, and log it. You draft — you only send after the user confirms, unless the user has already given a standing "yes, send" instruction in the current conversation for this batch.

## Step 1 — Classify each lead

| Category | Signals |
|---|---|
| **Genuine client lead** | Describes their own business/problem, asks about Al-Falah's services for themselves, plausible local (Guinea/Sierra Leone) or otherwise consistent contact details. |
| **B2B cold pitch / vendor solicitation** | Someone else pitching *their* service to Al-Falah (SEO reseller, video freelancer, agency partnership, "I reviewed your site and..."). Treat as noise to hold at arm's length, not a client. |
| **Suspicious / needs verification before replying** | Name matches the business owner (Abdulrahman Jalloh) or staff but from an unfamiliar email/domain; nonsensical or single-word message; contact details that don't parse (malformed phone/email); anything that pattern-matches spam. |
| **Spam / noise** | Gibberish, unrelated content, obvious bot fill. |

If a submission is ambiguous between categories, say so explicitly rather than picking one silently.

## Step 2 — Draft the reply

**Genuine client lead:**
- Acknowledge + ask 1-2 discovery questions (project type/timeline, or offer to schedule a short call) — see `alfalah-whatsapp-sales-assistant`'s Conversation Flow for tone/structure; this is the email equivalent.
- Match language to how they wrote in (French → French, English → English). Use the WhatsApp assistant's regional defaults (Guinea numbers → French, Sierra Leone → English) only when language isn't otherwise clear.

**B2B cold pitch:**
- Short, polite holding-pattern reply: ask them to send portfolio/pricing/samples, note "we'll follow up if there's alignment." Do not commit to anything, do not ask discovery questions — they aren't the customer.

**Suspicious / needs verification:**
- Do NOT send a reply from this skill without the user explicitly confirming the sender is legitimate. Flag it plainly: what looks off, and why. If the user confirms it's fine, draft as a genuine lead but note the flag in the log (Step 3) regardless, so the record isn't silently cleaned up.

**Spam:**
- No reply. Log as archived/skipped (Step 3), don't draft anything.

## Step 3 — Log to the Leads tracker

Log every non-spam lead to the [Al-Falah Marketing - Leads sheet](https://docs.google.com/spreadsheets/d/16khY9MvQdI80zZlJ8a5VmpXQjGsJfymbVD3H-f_0MI0/edit) via `ZapierAction[Google Sheets:add_row]` (spreadsheet `16khY9MvQdI80zZlJ8a5VmpXQjGsJfymbVD3H-f_0MI0`, worksheet id `0`), one row per lead:

| Column | Value |
|---|---|
| Timestamp | Today's date |
| Source | `site_admin_panel`, `contact_form`, `consultation_form`, or `email` — whichever applies |
| First Name / Last Name | From the submission |
| Business | If given |
| Email / Phone | From the submission |
| Service Interest | From the submission, or inferred from the message |
| Message / Subject | Short summary of what they asked |
| Status | `Replied`, `Needs verification`, or `Archived (spam)` |
| Next Step | What's being waited on (e.g. "Awaiting portfolio", "Awaiting project details") |
| Notes | Classification (genuine/cold-pitch/suspicious) + any flags from Step 1 |

Spam entries: log as `Archived (spam)` with a one-line note, or skip logging entirely for obvious bot noise — use judgment, don't fill the sheet with pure noise.

## Step 4 — Report back

For each lead, tell the user: classification, the drafted reply (or "no reply — spam"), and any flags. Ask before sending unless they've already said to send this batch. After sending, confirm what went out and that the sheet is updated.

## Constraints
- Never auto-send to a "suspicious/needs verification" lead without explicit confirmation.
- Never fabricate a company name, prior interaction, or detail not present in the actual submission.
- Cold-pitch replies stay non-committal — no discovery questions, no scheduling.
- Always log to the sheet, even for cold pitches, so there's a record of what went out and to whom.
