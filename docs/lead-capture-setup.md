# Step-by-step: automate lead capture from the site

## Important context first

Everything I do in this chat (search Gmail, write to the Sheet, create Calendar events) runs **on request, inside a conversation** — I don't run in the background watching for new form submissions. A truly automatic pipeline ("someone fills the form → a row appears in the Sheet, with nobody opening a chat") has to be built as a standing **Zap** on zapier.com itself (Zapier's own trigger→action automation, separate from this MCP chat connection), or via changes to the site's backend. This guide covers building that.

Also: the two building blocks below (**Webhooks by Zapier**, and later **WhatsApp Business**) are marked "Premium" apps in Zapier's catalog — they require a paid Zapier plan, not the free tier. Check your plan before starting.

## Why this is the only real path

The site (al-falahmarketing.com) is a custom Laravel/PHP app. Its two lead forms POST to `/contact-submit` and `/consultation-store` with CSRF tokens — a server-rendered app with its own database, not a static site or a no-code builder. There's no admin panel or API access set up for it in this project, so nothing external (Zapier included) can "see" a new submission unless the app itself is told to announce it. That means one of:

- **(A) Recommended: add a webhook call in the form handlers.** A few lines of code, no new infrastructure, keeps the existing form/database logic untouched.
- **(B) Get read access to the leads table/export.** Heavier — means real backend/database credentials changing hands, which is worth avoiding unless (A) isn't possible.

This guide is for (A).

### Why (B) isn't currently viable anyway

Tested 2026-08-29: this Claude Code session's network policy blocks outbound access to both `al-falahmarketing.com`/`www.al-falahmarketing.com` and `hpanel.hostinger.com` entirely (org-level egress restriction on this environment — confirmed via direct `curl`, not a login/auth issue). So even with hPanel or backend admin credentials, this session has no path to reach either one. That's independent of whether sharing that kind of credential in chat would be a good idea (it isn't — see below); it's a structural block on top of that.

If backend access is ever pursued, prefer scoped, revocable credentials over a shared admin/hPanel login: an SFTP/SSH user scoped to just the site directory, or a read-only database user for the leads table specifically. And note this only becomes usable from a session/environment with open network access to begin with — not this one, in its current configuration.

## Step 1 — Build the receiving Zap (on zapier.com, not in this chat)

1. Log into zapier.com → **Create Zap**.
2. **Trigger:** app = "Webhooks by Zapier", event = "Catch Hook". Continue through setup — Zapier will generate a unique webhook URL like `https://hooks.zapier.com/hooks/catch/xxxxx/yyyyy/`. Copy it.
3. **Action:** app = "Google Sheets", event = "Create Spreadsheet Row".
   - Spreadsheet: **Al-Falah Marketing - Leads** (https://docs.google.com/spreadsheets/d/16khY9MvQdI80zZlJ8a5VmpXQjGsJfymbVD3H-f_0MI0/edit)
   - Worksheet: Sheet1
   - Map columns to the webhook payload fields (Zapier will show sample fields once you send a test payload in Step 3): Timestamp → `timestamp` (or use Zapier's built-in run time), Source → `source`, First Name → `first_name`, Last Name → `last_name`, Business → leave blank (not collected by current forms — see note below), Email → `email`, Phone → `phone`, Service Interest → `service_interest`, Message/Subject → `message` or `subject`, Status → set a fixed value like "New", Next Step, Notes → leave blank.
4. Turn the Zap **on**.

## Step 2 — Add the webhook call to the site (needs the developer / whoever maintains the Laravel code)

Send them the webhook URL from Step 1, plus something like this (adjust to the actual controller structure):

```php
// In the contact form controller, after existing save logic:
Http::async()->post('https://hooks.zapier.com/hooks/catch/xxxxx/yyyyy/', [
    'source' => 'contact_form',
    'first_name' => $request->first_name,
    'last_name' => $request->last_name,
    'email' => $request->email,
    'phone' => $request->phone,
    'service_interest' => $request->service_interest,
    'message' => $request->message,
    'timestamp' => now()->toIso8601String(),
]);
```

```php
// In the consultation form controller, after existing save logic:
Http::async()->post('https://hooks.zapier.com/hooks/catch/xxxxx/yyyyy/', [
    'source' => 'consultation_form',
    'name' => $request->name,
    'email' => $request->email,
    'meeting_date' => $request->meeting_date,
    'subject' => $request->subject,
    'timestamp' => now()->toIso8601String(),
]);
```

Key points to pass along:
- Use `Http::async()` (or queue the call) so a slow/failed webhook never blocks the form response to the visitor.
- Wrap in try/catch (or let the queue retry) so a webhook failure doesn't break form submission.
- Don't remove or change the existing save-to-database logic — this is additive.

**Note:** the current forms don't collect a "Business name" field, so that Sheet column will stay empty until the site adds one, or it gets filled in manually during qualification.

## Step 3 — Test end to end

1. Submit a real test entry on the live contact form (and separately the consultation form).
2. Check the Zap's task history on zapier.com — confirm it received the webhook and successfully created a row.
3. Check the [Leads sheet](https://docs.google.com/spreadsheets/d/16khY9MvQdI80zZlJ8a5VmpXQjGsJfymbVD3H-f_0MI0/edit) — confirm the row looks right.
4. If it fails, the Zap's task history shows the exact error — that's the fastest way to debug rather than guessing.

## Step 4 — Optional: get notified the moment a lead lands

Add a second action to the same Zap (or a second Zap watching the Sheet) that pings Slack, sends an email, or similar, so a new lead doesn't sit unnoticed in the Sheet. Ask when ready — I can add this once Slack or a preferred channel is confirmed.
