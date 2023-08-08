# interview-php
## Installation

1.😀 Склонировать данный репозиторий
2.Перейти в папку .docker
```sh
cd .docker
``` 
3.Для начала сборки сервисов, описанных в конфигурационных файлах, нужно запустить в консоли внутри папки .docker команду
```sh
docker compose build
``` 
4.Для запуска собранных сервисов из конфигурационного файла нужно ввести в консоли внутри папки .docker команду
```sh
docker compose up
``` 
5.Для выполнения всех миграций нужно запустить в консоли внутри контейнера php-fpm команду 
```sh
php bin/console doctrine:migrations:migrate
```
6.Для загрузки fixtures в БД запустить в консоли внутри контейнера php-fpm команду 
```sh
php bin/console doctrine:fixtures:load
```
7.Перейти по в браузерен на адрес http://localhost:1234/find_range
```sh
http://localhost:1234/find_range
```