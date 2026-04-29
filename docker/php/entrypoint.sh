#!/bin/sh
set -e

STORAGE=/var/www/html/storage
CACHE=/var/www/html/bootstrap/cache

mkdir -p \
  "$STORAGE/app/public" \
  "$STORAGE/logs" \
  "$STORAGE/framework/cache/data" \
  "$STORAGE/framework/sessions" \
  "$STORAGE/framework/testing" \
  "$STORAGE/framework/views" \
  "$CACHE"

if [ "$(id -u)" = "0" ]; then
  chown -R www-data:www-data "$STORAGE" "$CACHE"
  chmod -R ug+rwX "$STORAGE" "$CACHE"
fi

# php-fpm must run its master as root; the pool uses user/group www-data for workers.
# Starting the master as www-data (e.g. via gosu) breaks error_log=/proc/self/fd/2 and FPM exits.
exec docker-php-entrypoint "$@"
