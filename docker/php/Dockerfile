#syntax=docker/dockerfile:1.4
FROM spiralscout/roadrunner:2024.2 AS roadrunner
FROM php:8.4-cli

ARG UID
ARG GID

RUN <<EOF
  groupmod --gid=${GID} www-data
  usermod --uid=${UID} --gid=${GID} www-data
  chown -R www-data:www-data /var/www
EOF

RUN mkdir /root/history
RUN apt update \
    && apt install -y --no-install-recommends  \
      patch \
      bash \
    && apt clean \
    && rm -rf /var/lib/apt/lists/*
COPY --link php.ini $PHP_INI_DIR/conf.d/
RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY --from=roadrunner /usr/bin/rr /usr/bin/rr
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions
RUN install-php-extensions @composer && \
    ln -s composer /usr/local/bin/c
RUN install-php-extensions opcache intl sockets
WORKDIR /var/www/html
CMD rr serve -d -c .rr.dev.yaml
USER www-data
