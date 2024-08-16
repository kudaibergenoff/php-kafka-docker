# consumer/Dockerfile
FROM php:8.1-cli
RUN apt-get update && apt-get install -y librdkafka-dev
RUN pecl install rdkafka && docker-php-ext-enable rdkafka
COPY consumer.php /app/consumer.php
CMD ["php", "/app/consumer.php"]
