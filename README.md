
<H3>Выполнение:</H3>
<h5>При выполнении ТЗ использовалось:</h5>
- Laravel 10,
- PHP 8.1,
- React 18,
- Material UI - библиотека для фронта
- MySQL

<h5>Развернуть проект локально:</h5>

cp .env.example .env (создаём локально БД и прописываем свои данные, указываем QUEUE_CONNECTION=database) <br>
php artisan key:generate<br>
php artisan storage:link<br>
composer install --ignore-platform-reqs<br>
php artisan serve<br>
php artisan migrate<br>
php artisan queue:work - для запуска очередей<br>
npm install -force (node version 14.19.3)<br>
npm run dev<br>

<h5>Описание:</h5>

Применён паттерн <b>Repository-Service Pattern</b>

На главной странице необходимо зарегистрироваться, после чего выполнится редирект на домашнюю страницу
На домашней странице кнопка CHOOSE FILE https://i.imgur.com/V14jUSF.png

Нажимаем, выбираем наш тестовый файл, нажимаем SAVE https://i.imgur.com/BgvGXq3.png

Клиентская часть реализована в компоненте React resources/js/components/ExportFile.jsx

валидация выполнена в Http/Requests/FileRequest.php

запрос на создание и парсинга файла направляется в контроллер Http/Controllers/ParseFileController.php <br>
В нем вызывается сервис и job на обработку

Логика находится в Services/ParseFileService.php<br>

Также с React компонента вызывается метод по получению списка пользователей с группировкой по дате. Результат отображается в консоли<br>

Все действия доступны только для зарегистрированных пользователей<br>

Весь код работает, ошибок и предупреждений в консоли нет<br>
