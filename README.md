# Nginx Log Parser
Простой проект на Yii2 для загрузки и парсинга логов Nginx

## Что делает
Загружает лог-файл через форму.
Парсит IP, дату/время, URL, User-Agent, ОС, архитектуру и браузер.
Сохраняет данные в БД MySQL

# Как запустить
1. Склонировать репозиторий
 git clone https://github.com/CotikCommunist/test-zadanie.git
2. Установить зависимости через composer
   composer install
3. Настроить БД(config/db.php)
4. Применить миграции
   php yii migrate
5. Запустить сервер
   php yii serve
6. Открыть в браузере http://localhost:(вставь свой порт)

# Замечания
Если будут ошибки с загрузкой больших файлов, надо исправить настройки PHP(upload_max_filesize и post_max_size). (А то сам столкнулся с этой ошибкой)
