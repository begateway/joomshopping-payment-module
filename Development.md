# Local Joomla 6 / PHP 8.5 development

The Dockerfile builds Joomla 6.2.1 on PHP 8.5 with the required PHP extensions.

```sh
docker compose build
docker compose up -d
```

Open http://localhost:8080 and install Joomla. Database host: `db`, database:
`joomla_db`, user: `joomla`, password: the `JOOMLA_DB_PASSWORD` in
`docker-compose.yml`. These credentials are for local development only.

Download [JoomShopping 5.10.0](https://www.webdesigner-profi.de/joomla-webdesign/joomla-shop/downloads/JoomShopping-5.10.0.zip.html?lang=en)
and install it through Joomla's extension installer. Disable **Behaviour - Backward
Compatibility 6** to ensure the payment module works without legacy aliases.

## Install and configure the module

```sh
scripts/build-release.sh
```

Upload `dist/joomshopping-begateway.zip` through **JoomShopping → Install & Update**.
The ZIP must contain `update.sql` and `components/` at its root. Do not install the
repository's Source code ZIP. Bundled dependencies are included; merchants do not
need Composer. Reinstalling preserves the payment method and its saved settings.

Open **JoomShopping → Options → Payments → Credit or debit card → Config**,
configure the README's test shop, save, and publish the method. Version 3.0.0
requires JoomShopping 5.10.x (JSON payment configuration); older installations
should use a 2.x module release.

## End-to-end test

Create a published category and a published EUR 1.00 product with stock. Enable
guest checkout and disable shipping for this test. Set completed/pending/failed
payment statuses to Paid (6) / Pending (1) / Canceled (3).

Expose the local server using a tunnel, for example:

```sh
cloudflared tunnel --url http://localhost:8080
```

Use the public HTTPS URL throughout checkout so the gateway can deliver its
notification to the same instance. The development Apache configuration honors
`X-Forwarded-Proto` from the local tunnel. Do not expose this development stack
as a production deployment.

Install Playwright in a separate test directory and make it available to Node
(e.g. via `NODE_PATH`). No test dependency is shipped in the payment archive.

```sh
SHOP_URL=https://your-tunnel.trycloudflare.com PRODUCT_ID=1 CATEGORY_ID=1 \
  node tests/checkout.cjs
```

The test uses both cards from the README and checks the hosted success/decline
result and the return to the shop. Screenshots and results are saved under
`/tmp/begateway-e2e` (override with `ARTIFACT_DIR`). Independently check the local
order database: successful notification must set status 6, declined notification
status 3, and both must record the gateway UID. A browser return alone does not
prove callback handling. Do not configure production credentials for this test.

## Release

Run PHP syntax checks and the end-to-end checks before tagging. Run
`scripts/build-release.sh` to produce the same installer archive as CI. Tag
`3.0.0` and push the tag to trigger `.github/workflows/release.yml`, which
publishes `joomshopping-begateway.zip` as a GitHub release asset. GitHub Actions
requires repository `contents: write` permission (declared in the workflow).
