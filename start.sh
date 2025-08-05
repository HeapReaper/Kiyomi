#!/bin/sh

supervisord -c /etc/supervisor/conf.d/supervisord.conf &

sleep 3

curl -X PUT --data-binary @/docker-entrypoint.d/config.json --unix-socket /var/run/control.unit.sock http://localhost/config

php /var/www/html/artisan view:clear

tail -f /dev/null
