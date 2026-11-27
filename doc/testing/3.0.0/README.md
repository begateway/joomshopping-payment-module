# 3.0.0 local validation — BEP-33688

Validated on 2026-11-27 with Joomla **6.2.1**, JoomShopping **5.10.0**,
PHP **8.5.12**, MariaDB **10.11**, and Playwright **1.64.1**.
Joomla's `behaviour/compat6` plugin was disabled (database `enabled=0`).

The local instance was exposed using a Cloudflare quick tunnel. Both the browser
checkout and the gateway notification used the public HTTPS origin. The tunnel
was temporary and is not a deployed shop.

- Installed JoomShopping through Joomla's web extension installer.
- Installed the generated `joomshopping-begateway.zip` through JoomShopping's
  **Install & Update** upload form. No copy warnings after correcting local
  directory ownership left by the initial CLI component installation.
- Opened the payment editor and Config tab, saved settings, and published the method.
  No `JFactory` / `JModelLegacy` / other missing legacy-class errors.
- Reinstalled the final archive: exactly one `pm_begateway` payment method remained;
  its JSON configuration and published state were preserved.
- Ran `tests/checkout.cjs` with the README's test shop 361 and both README cards.
  Both scenarios passed, including browser return to the local shop.

| Scenario | Order | Gateway UID | Database status history |
| --- | --- | --- | --- |
| Success (card ending 0000) | 00000004 | 5f22efc8-bc71-4375-af1e-6b1ca9a3f7d9 | Pending (1) → Paid (6) |
| Decline (card ending 0019) | 00000005 | cba7016f-2c9f-4e71-b7ea-f5d8c7fd6533 | Pending (1) → Canceled (3) |

Independently queried `#__jshopping_orders` and `#__jshopping_order_history`:
statuses matched the table and `order_add_info` recorded each UID and the test
payment marker. Apache recorded authenticated gateway POST notifications to the
module's `step7&act=notify` endpoint. An unauthenticated forged success notification
for order 5 left status 3 and its UID unchanged.

Hosted results and shop return screenshots are alongside this report.
`results.json` contains the browser results; the payment token is removed from
the declined return URL. Failed cards display **Error / Transaction declined**
on the hosted page and return to order confirmation when canceled.

Additional checks passed:

- PHP 8.5 syntax checks: all **85** PHP files, including the bundled SDK.
- SDK payment-token construction under PHP 8.5 with `E_ALL`.
- `node --check tests/checkout.cjs`, `bash -n scripts/build-release.sh`.
- `docker compose config --quiet`.
- Built `docker/Dockerfile` successfully; resulting PHP **8.5.13** image includes
  cURL, GD, intl, mbstring, PDO MySQL and ZIP. Browser E2E used PHP 8.5.12 as above.
- Built and integrity-checked the release ZIP; confirmed root `update.sql`, module
  sources, `VERSION` = `3.0.0`, and bundled `vendor/autoload.php`.
- `git -c core.whitespace=cr-at-eol diff --check`.

The local test container does not include sendmail; order-email delivery was not
part of this validation. GitHub Actions runs after the commit/tag are pushed;
this local validation does not claim a published GitHub release.
