<?php
    // Указываем кодировку
    header('Content-Type: text/html; charset=utf-8');

    $server = "localhost"; /* имя хоста (уточняется у провайдера), если работаем на локальном сервере, то указываем localhost */
    $username = "имя_пользователя_бд"; /* Имя пользователя БД */
    $password = "пароль_пользователя_бд"; /* Пароль пользователя БД, если у пользователя нет пароля то, оставляем пустым */
    $database = "имя_базы_данных"; /* Имя базы данных, которую создали */
 
    // Подключение к базе данных через MySQLi
    //$mysqli = new mysqli($server, $username, $password, $database);
    $mysqli = new mysqli("localhost", "a0193693_esp32_advanced", "981010", "a0193693_esp32_advanced");
    // Проверяем, успешность соединения. 
    if (mysqli_connect_errno()) { 
        echo "<p><strong>Ошибка подключения к БД</strong>. Описание ошибки: ".mysqli_connect_error()."</p>";
        exit(); 
    }

    // Устанавливаем кодировку подключения
    $mysqli->set_charset('utf8');

    //Для удобства, добавим здесь переменную, которая будет содержать название нашего сайта
    $address_site = "http://pagesgen.tfeya.ru/prjnoback/recovery_password/change_password/";

    //Почтовый адрес администратора сайта
    $email_admin = "eu@tfeya.ru";
?>