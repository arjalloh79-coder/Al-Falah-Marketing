# Step-by-step: connect WhatsApp to a real API

## The core fact to plan around

`+1 240-280-6137` currently runs the regular WhatsApp consumer/business **app** on a phone — there is no API behind it, so nothing (Zapier, me, anything) can programmatically read or send messages on it today. Automating WhatsApp requires moving to the **WhatsApp Business Platform (Cloud API)**, either directly via Meta or through a Business Solution Provider (BSP) like Twilio. This is a real infrastructure change, not a config toggle — budget time for business verification and testing.

**Strong recommendation: do this on a new/secondary number first.** Migrating the existing number to the Business API can disrupt how it currently works as a normal WhatsApp account. Test the whole flow on a spare number, then cut over once it's proven.

## Provider choice: Meta directly vs. Twilio

| | Meta Cloud API (direct) | Twilio |
|---|---|---|
| Cost | Free tier for messaging (Meta's conversation-based pricing still applies) | Twilio's own fees on top of Meta's, but much smoother setup |
| Setup complexity | Higher — direct Meta Business verification, manual API config | Lower — Twilio's console walks through WhatsApp Sender approval |
| Zapier support | Via the "WhatsApp Business" app in Zapier's catalog (Premium) | Via the "Twilio" app in Zapier's catalog (standard tier, not Premium) |

**Recommendation: start with Twilio.** It's a proven, well-documented path for WhatsApp Business API access, has solid Zapier support without needing a Premium-tier app, and its console reduces a lot of the Meta-side complexity. Reassess Meta-direct later if message volume makes Twilio's markup meaningful.

## Step 1 — Set up Twilio + WhatsApp Sender

1. Create a Twilio account (twilio.com) if you don't have one.
2. In the Twilio Console, go to Messaging → Try WhatsApp → follow the guided WhatsApp Sender setup.
3. This requires a **Meta Business verification** (Twilio walks you through connecting/creating a Meta Business Manager account and verifying Al-Falah Marketing as a business). This step can take from hours to a few days for Meta's review.
4. Once approved, Twilio gives you a WhatsApp-enabled number (start with a new number for testing, per the recommendation above) and API credentials (Account SID, Auth Token).

## Step 2 — Set up message templates

WhatsApp Business API requires **pre-approved templates** for any message you send first (i.e., not a reply within 24 hours of the customer's last message). Submit a small set for approval early, since Meta's review can take a day or two:
- A greeting/opener template (for outbound-initiated contact, if you ever message leads first)
- A booking-confirmation template
- A follow-up/no-response template

Free-form replies (like the qualifying conversation the WhatsApp assistant playbook runs) are fine as long as they're within 24 hours of the customer's last message — which covers the normal lead-qualification flow.

## Step 3 — Connect Twilio in Zapier

1. In Zapier MCP, enable the Twilio app (I can do this here once you have credentials — say the word).
2. Connect it with the Account SID / Auth Token from Twilio.

## Step 4 — Build the automation, in stages (don't jump straight to full auto-send)

**Stage 1 — Notify only (safest starting point).**
Zap: Twilio "New/Incoming Message" trigger → notify you (Slack/email/whatever's easiest) with the message text and sender. You paste it to me here, I draft a reply per the WhatsApp assistant playbook, you copy it back into Twilio's console (or a Zap step) to send. Nothing sends without you seeing it first.

**Stage 2 — Draft automatically, still approve before send.**
Add an "AI by Zapier" (or similar) step between the trigger and the notification, pre-loaded with the WhatsApp assistant's playbook as its instructions, so the draft reply is generated automatically and included in the notification you get — you just approve/edit and the Zap sends it (e.g., via a follow-up "approve" step, or a Slack approval button if your plan supports it).

**Stage 3 — Fully automatic (only after Stage 2 has run cleanly for a while).**
Same as Stage 2, but the Zap sends the drafted reply directly via Twilio's "Send WhatsApp Message" action with no human step. Reserve this for routine, low-stakes replies (the playbook's Discovery/Value/Qualification steps); keep the Fallback-rule cases (pricing, complaints, complex asks) routed to a human notification regardless of stage.

## What I can do once credentials exist

Once Twilio is connected with real API keys, I can:
- Draft/refine the exact Zap steps and template wording with you
- Test message flows in this chat before they go live
- Update the lead tracker automatically as part of the same Zap (Twilio trigger → Google Sheets row, same pattern as the site's contact form)

I can't sign up for Twilio, complete Meta's business verification, or approve message templates myself — those require you (as the business owner) to complete identity/business verification steps directly.
