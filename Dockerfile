FROM php:8.2-apache

# 1. 安裝 mysqli
RUN docker-php-ext-install mysqli

# 2. 將專案檔案複製到 Apache 預設路徑
COPY . /var/www/html/

# 3. 確保權限正確
RUN chown -R www-data:www-data /var/www/html/

# 4. 這裡不需要 EXPOSE 或額外的啟動指令，使用 Base Image 的預設即可
