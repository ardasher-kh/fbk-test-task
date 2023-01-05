FROM php:8.0-fpm
RUN mkdir -p /usr/share/man/man1
RUN apt-get update \
  && apt-get install -y \
     apt-utils \
     git \
     nano \
     man \
     curl \
     pkg-config \
     icu-devtools \
     libicu-dev \
     libcurl4 \
     libcurl4-gnutls-dev \
     libfreetype6-dev \
     libjpeg62-turbo-dev \
     libpng-dev \
     libbz2-dev \
     libssl-dev \
     libgmp-dev \
     libtidy-dev \
     libxml2-dev \
     libxslt1-dev \
     libzip-dev \
     libonig-dev \
     libpq-dev \
     pdftk-java \
     libmp3lame-dev \
    cron \
  &&  ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h

RUN docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip \
    && docker-php-ext-install bz2 \
    && docker-php-ext-install calendar \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install exif \
    && docker-php-ext-install gettext \
    && docker-php-ext-install gmp \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install shmop \
    && docker-php-ext-install sockets \
    && docker-php-ext-install sysvmsg \
    && docker-php-ext-install sysvsem \
    && docker-php-ext-install sysvshm \
    && docker-php-ext-install tidy \
    && docker-php-ext-install xsl \
    && docker-php-source delete

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd \
  && pecl install redis \
  && docker-php-ext-enable redis.so \
  && docker-php-source delete

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY php/php.ini /usr/local/etc/php/php.ini

# Copy laravel-cron file to the cron.d directory
COPY cron/laravel-cron /etc/cron.d/laravel-cron
 
# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/laravel-cron

# Apply cron job
RUN crontab /etc/cron.d/laravel-cron
 
# Create the log file to be able to run tail
RUN touch /var/log/cron.log

WORKDIR /app
