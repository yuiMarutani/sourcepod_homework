FROM php:8.2-apache

# GDライブラリ（FreeType対応）＋日本語フォント
RUN apt-get update && \
    apt-get install -y libpng-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype && \
    docker-php-ext-install gd

# 日本語フォントとフォント管理ツール
RUN apt-get install -y fonts-ipafont fontconfig

# JpGraphのフォルダをコピー
COPY jpgraph/ /var/www/html/jpgraph/

# PHPファイルをコピー
COPY . /var/www/html/

# 権限設定（任意）
RUN chown -R www-data:www-data /var/www/html
