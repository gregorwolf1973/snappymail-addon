ARG BUILD_FROM
FROM ${BUILD_FROM}

# Labels
LABEL \
    io.hass.name="SnappyMail" \
    io.hass.description="Simple, modern & fast web-based email client" \
    io.hass.type="addon" \
    io.hass.version="1.0.0"

# Environment
ENV \
    SNAPPYMAIL_VERSION="2.38.2" \
    UPLOAD_MAX_SIZE="25M" \
    MEMORY_LIMIT="128M" \
    LOG_TO_STDOUT="false"

# Install dependencies
RUN apk add --no-cache \
    nginx \
    php84 \
    php84-fpm \
    php84-curl \
    php84-dom \
    php84-iconv \
    php84-json \
    php84-mbstring \
    php84-openssl \
    php84-pdo \
    php84-pdo_mysql \
    php84-session \
    php84-simplexml \
    php84-xml \
    php84-zip \
    php84-zlib \
    php84-ctype \
    php84-fileinfo \
    php84-intl \
    curl \
    tar \
    bash

# Create snappymail user
RUN addgroup -S snappymail && adduser -S -G snappymail snappymail

# Download and install SnappyMail
RUN mkdir -p /var/www/snappymail && \
    curl -L "https://github.com/the-djmaze/snappymail/releases/download/v${SNAPPYMAIL_VERSION}/snappymail-${SNAPPYMAIL_VERSION}.tar.gz" \
    -o /tmp/snappymail.tar.gz && \
    tar -xzf /tmp/snappymail.tar.gz -C /var/www/snappymail && \
    rm /tmp/snappymail.tar.gz && \
    mkdir -p /var/www/snappymail/data && \
    chown -R snappymail:snappymail /var/www/snappymail

# Copy configuration files
COPY rootfs /

# Set permissions
RUN chmod +x /etc/s6-overlay/s6-rc.d/snappymail-init/run && \
    chmod +x /etc/s6-overlay/s6-rc.d/nginx/run && \
    chmod +x /etc/s6-overlay/s6-rc.d/php-fpm/run

EXPOSE 8888
