# producer/Dockerfile
FROM php:8.1-cli
RUN apt-get update && apt-get install -y librdkafka-dev
RUN pecl install rdkafka && docker-php-ext-enable rdkafka
COPY producer.php /app/producer.php
CMD ["php", "/app/producer.php"]
