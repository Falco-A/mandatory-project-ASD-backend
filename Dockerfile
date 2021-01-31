# This image contains Debian's Apache httpd in conjunction with PHP
FROM php:8.0.1-apache
# Install mysqli extension (plugin/library) for php
RUN docker-php-ext-install mysqli
