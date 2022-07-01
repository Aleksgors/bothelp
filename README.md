# bothelp

Test task for Bot Help
Тестовое задание

## Установка:

### 1. Клонирование репозитория:
- > git clone https://github.com/Aleksgors/bothelp.git

### 2. Запуск контейнеров Docker:
- > cd ./docker
- > docker-compose up -d --build

### 3. Установка библиотек:
- > docker-compose exec bothelp.php-service php composer.phar update

### 4. Конфигурация:  
Конфиг с настройкой количества событий, генерируемых за 1 раз, общее количество событий и количество параллельных обработчиков находится в:
> src/Options/Application.php
### 5. Запуск скриптов:  

Генерация событий:
- > docker-compose exec bothelp.php-service php public/index.php events_generate

Обработка событий:
- > docker-compose exec bothelp.php-service php public/index.php consume
