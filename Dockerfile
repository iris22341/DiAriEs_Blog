FROM php:8.2-apache

# 安裝 mysqli 擴充功能
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# 將專案檔案複製到伺服器
COPY . /var/www/html/

# 設定權限
RUN chown -R www-data:www-data /var/www/html/

# 暴露 80 埠 (Apache 預設)
EXPOSE 80
