# Payment method flows

Live in `backend/`, tested end-to-end locally (see test log below). Checkout lives at `/order/{service_id}` on the backend once deployed.

## The model: "pay externally, submit proof"

None of Orange Money, MTN Money, Moov Money, or Wave are connected via a live payment API — that requires a business agreement with each provider (or an aggregator like a PSP), which isn't in place. Instead, the flow matches how most SMBs in Guinea/Sierra Leone actually take mobile money today:

1. Customer picks a service and a payment method on `/order/{service}`.
2. The page shows the business's receiving account/number for that method, pulled from config (see below) — **not hardcoded**, so it's editable without a code change.
3. Customer sends the money externally, via their own mobile money app, then enters the number they paid from and the transaction reference from their confirmation SMS.
4. The order is created with **status `pending`**.
5. In the admin dashboard, the receiving account owner checks their own mobile money account for a matching transaction, then flips the order to `confirmed` (or `cancelled` if it doesn't check out).

**Bank transfer** works the same way, minus the "paid-from number" (banks don't have that concept) — just a transfer reference.

**Card** is different: if a Stripe key is configured (see below), it's a real, automatic Stripe Checkout — no manual verification needed, order is created as `confirmed` directly once Stripe confirms payment. Without a key, card is disabled on checkout with a clear message, and no order gets created if someone tries to submit it (tested — see below).

## Configuration — `backend/config/payment_methods.php` + `.env`

Each method's receiving account and instructions live in `config/payment_methods.php`, sourced from `.env`:

```
PAYMENT_ORANGE_MONEY_NUMBER=
PAYMENT_MTN_MONEY_NUMBER=
PAYMENT_MOOV_MONEY_NUMBER=
PAYMENT_WAVE_NUMBER=
PAYMENT_BANK_DETAILS=
```

**These are all blank right now** — the checkout page will show `[SET THIS UP]` for each until real account numbers/details are added. Needed before this can go live:

- Orange Money, MTN Money, Moov Money, Wave: the actual receiving phone numbers for each (may be the same number across all, or different per provider — whichever accounts the business actually holds).
- Bank transfer: bank name, account name, account number — whatever's needed for someone to actually send a transfer.

## Card (Stripe) — optional

```
STRIPE_SECRET_KEY=
STRIPE_PUBLISHABLE_KEY=
```

Leave blank to keep card disabled (default, current state). Set both to enable it — no code change needed. Uses Stripe Checkout (hosted, redirect-based), confirmed via the success-URL session lookup rather than a webhook (simpler to run on shared hosting; a webhook could be added later if orders are ever missed because a customer closes the tab before returning).

## What was actually tested (not just written)

Ran against a local sqlite DB with the dev server:
- Checkout page renders all 6 methods, shows `[SET THIS UP]` placeholders correctly.
- Orange Money: submission missing `transaction_id` correctly rejected (redirected back, no order created); complete submission created an order with `status: pending` and both `payment_number` and `transaction_id` stored correctly.
- Bank transfer: submission with only `transaction_id` (no `payment_number`, correctly not required for this method) succeeded.
- Card with no Stripe key configured: submission correctly rejected with an on-page message, **no order created**.
- Admin dashboard: order detail page shows "Customer paid from" and "Transaction / reference ID" as distinct fields (not merged/ambiguous); confirming an order via the admin status dropdown correctly updates its status in the database.
- Full Laravel test suite (25 tests) still passes.

## Open items

- Real receiving account numbers/bank details needed (see Configuration above) before this is usable with real customers.
- No webhook fallback for Stripe yet — fine at low volume, worth revisiting if "customer paid but order never appeared" becomes a real support issue.
- Deployment is still blocked the same way as the rest of `backend/` — this session cannot reach Hostinger. See `custom-backend-plan.md` and `backend/README.md`.
