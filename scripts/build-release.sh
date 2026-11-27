#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."
archive="${1:-dist/joomshopping-begateway.zip}"
mkdir -p "$(dirname "$archive")"
archive="$(realpath "$archive")"
rm -f "$archive"
(cd plg_begateway && zip -qr "$archive" components update.sql -x '*/.git/*' '*/.DS_Store')
unzip -Z1 "$archive" | grep -x 'update.sql' >/dev/null
unzip -Z1 "$archive" | grep -x 'components/com_jshopping/payments/pm_begateway/vendor/autoload.php' >/dev/null
echo "$archive"
