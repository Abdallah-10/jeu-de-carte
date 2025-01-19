# Utiliser l'image PHP 8.2
FROM php:8.2-apache

# Installer les dépendances nécessaires pour les extensions PHP et autres utilitaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    zlib1g-dev \
    git \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd intl zip pdo pdo_mysql \
    && a2enmod rewrite

# Copier le code source du projet dans le conteneur
COPY . /var/www/html/

# Définir le répertoire de travail
WORKDIR /var/www/html/

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Exposer le port 80
EXPOSE 80
