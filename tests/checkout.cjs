// Run against an isolated shop configured with the README test credentials.
// npm install --no-save playwright (outside the module directory), then:
// SHOP_URL=https://your-tunnel.example PRODUCT_ID=1 CATEGORY_ID=1 node tests/checkout.cjs
const { chromium } = require('playwright');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const base = process.env.SHOP_URL;
assert(base?.startsWith('https://'), 'SHOP_URL must be the public HTTPS tunnel URL');
const artifacts = process.env.ARTIFACT_DIR || '/tmp/begateway-e2e';
fs.mkdirSync(artifacts, { recursive: true });
const url = (controller, task, extra = '') => `${base}/index.php?option=com_jshopping&controller=${controller}&task=${task}${extra}`;
(async () => {
  const browser = await chromium.launch({ args: ['--no-sandbox'] });
  const results = [];
  try {
    for (const [scenario, card, expected] of [
      ['success', '4200000000000000', 'Success'],
      ['decline', '4005550000000019', 'Error'],
    ]) {
      const context = await browser.newContext();
      const page = await context.newPage();
      page.setDefaultTimeout(60000);
      try {
        await page.goto(url('product', 'view', `&category_id=${process.env.CATEGORY_ID || 1}&product_id=${process.env.PRODUCT_ID || 1}`));
        await page.locator('input[value="Add to cart"]').click();
        await page.getByRole('link', { name: 'Checkout', exact: true }).click();
        await page.getByRole('link', { name: 'Guest checkout' }).click();
        await page.locator('[name=title]').selectOption({ label: 'Mr.' });
        for (const [name, value] of Object.entries({ f_name: 'John', l_name: 'Doe', email: 'test@example.com', street: '1 Test Street', zip: '10115', city: 'Berlin', phone: '491234567890' })) {
          await page.locator(`[name=${name}]`).fill(value);
        }
        await page.locator('[name=country]').selectOption({ label: 'Germany' });
        await page.locator('[name=next]').click();
        await page.locator('[name=payment_method][value=pm_begateway]').check();
        await page.locator('[name=payment_submit]').click();
        await page.locator('[name=agb]').check();
        await page.locator('[name=finish_registration]').click();
        await page.waitForURL('https://checkout.begateway.com/**');
        const frame = page.frameLocator('iframe');
        await frame.locator('[autocomplete=cc-number]').fill(card);
        await frame.locator('[autocomplete=cc-exp]').fill('01/30');
        await frame.locator('[autocomplete=cc-csc]').fill('123');
        await frame.locator('[autocomplete=cc-name]').fill('JOHN DOE');
        await frame.getByRole('button', { name: /^Pay / }).click();
        // The hosted result is separate from the module's callback; verify both.
        await frame.getByText(expected, { exact: true }).waitFor();
        const resultText = await frame.locator('body').innerText();
        assert(resultText.includes('TEST MODE'), 'Payment must stay in test mode');
        if (scenario === 'decline') assert(resultText.includes('Transaction declined'), 'Expected a card decline');
        await page.locator('iframe').waitFor({ state: 'visible' });
        await page.waitForTimeout(1000); // Allow the hosted result transition to finish before capturing it.
        await page.screenshot({ path: `${artifacts}/${scenario}.png`, fullPage: true });
        const orderNumber = resultText.match(/Order number\s+(\d+)/)?.[1];
        const uid = resultText.match(/[a-f0-9]{8}-(?:[a-f0-9]{4}-){3}[a-f0-9]{12}/)?.[0];
        await frame.getByRole('button', { name: scenario === 'success' ? 'Continue' : 'Cancel', exact: true }).click();
        await page.waitForURL(`${base}/**`);
        const returnText = await page.locator('body').innerText();
        await page.screenshot({ path: `${artifacts}/${scenario}-return.png`, fullPage: true });
        results.push({ scenario, orderNumber, uid, resultText, returnUrl: page.url(), returnText });
        fs.writeFileSync(`${artifacts}/results.json`, JSON.stringify(results, null, 2));
        console.log(JSON.stringify({ scenario, orderNumber, uid, returnUrl: page.url() }));
      } catch (error) {
        await page.screenshot({ path: `${artifacts}/${scenario}-error.png`, fullPage: true });
        console.error('Failed at', page.url());
        for (const f of page.frames()) console.error(f.url(), (await f.locator('body').innerText()).slice(-2000));
        throw error;
      } finally { await context.close(); }
    }
  } finally { await browser.close(); }
})().catch(error => { console.error(error); process.exit(1); });
