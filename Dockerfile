# PHP 8.2.0 imajını kullanalım
FROM php:8.2.0-fpm

# Gerekli bağımlılıkları yükleyin
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git

# PHP eklentilerini yükleyin
RUN docker-php-ext-configure zip --with-zip && docker-php-ext-install zip pdo pdo_mysql

# Composer'ı yükleyin
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Çalışma dizinini belirleyin
WORKDIR /var/www

# Projenizi çalışma dizinine kopyalayın
COPY . .

# Gerekirse proje bağımlılıklarını yükleyin
RUN composer install

# Uygulamayı ayağa kaldırın
CMD php artisan serve --host=0.0.0.0 --port=8000
