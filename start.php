<?php
include './check_login.php';
?>
<html lang="en">
    <head>
        <? include 'header_bootstrap.php' ?>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">Сервис Интернета вещей (IoT)</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Меню
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Интернет-вещи</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#fastStart">Начало</a></li>
                        <?php if ($login_success == 1): ?> 
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php">Панели</a></li>
                        <?php endif; ?>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#api">API</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#contact">Github</a></li>
                        <?php if ($login_success == 1): ?>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php"><?=$userdata['user_login']?></a></li>
                        <?php else:?>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="login.php">Войти</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image-->
                <img class="masthead-avatar mb-5" src="assets/img/esp32.png" alt="..." />
                <!-- Masthead Heading-->
                <h6 class="masthead-heading mb-0">Создавайте системы Умного дома и Интернета вещей на базе популярных плат типа Wemos ESP32</h6>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-cloud"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">Наш сервис позволяет подключать все, что может иметь значение: датчик, сервопривод, дисплей. Сервис позволяет хранить значения устройств и целых систем, связывать их между собой, а изменять их можно с помощью простых запросов на этот сервер</p>
            </div>
        </header>
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Готовые интерфейсы Интернет-вещей</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-area-chart"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">
                    <!-- Portfolio Item 1-->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/done_interfaces/polyvator.png" alt="..." />
                        </div>
                    </div>
                    <!-- Portfolio Item 2-->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal2">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/done_interfaces/sensorBox.png" alt="..." />
                        </div>
                    </div>
                    <!-- Portfolio Item 3-->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal3">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/done_interfaces/robocat.jpeg" alt="..." />
                        </div>
                    </div>
                    <!-- Portfolio Item 4-->
                    <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal4">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/done_interfaces/telepresence.png" alt="..." />
                        </div>
                    </div>
                    <!-- Portfolio Item 5-->
                    <div class="col-md-6 col-lg-4 mb-5 mb-md-0">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal5">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/done_interfaces/rieltor.png" alt="..." />
                        </div>
                    </div>
                    <!-- Portfolio Item 6-->
                    <div class="col-md-6 col-lg-4">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal6">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/submarine.png" alt="..." />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Section-->
        <section class="page-section bg-primary text-white mb-0" id="fastStart">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">Быстрый старт в Arduino IDE</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-adjust"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
                    <div class="col-lg-4 ms-auto"><p class="lead">1. Настройте среду для работы с вашей платой. Нужно выбрать правильную плату, например "Wemos ESP32", порт, чтобы загрузить скетч на втором шаге. Плата будет отправлять запросы на этот сервер. 
                    </p>
                    <a class="btn btn-xl btn-outline-light" href="https://wiki.iarduino.ru/page/esp32-windows/#:~:text=%D0%97%D0%B0%D0%BF%D1%83%D1%81%D1%82%D0%B8%D1%82%D0%B5%20%C2%AB%D0%9C%D0%B5%D0%BD%D0%B5%D0%B4%D0%B6%D0%B5%D1%80%20%D0%BF%D0%BB%D0%B0%D1%82%C2%BB%20%D0%B2%D1%8B%D0%B1%D1%80%D0%B0%D0%B2%20%D0%BF%D1%83%D0%BD%D0%BA%D1%82,%D0%94%D0%BE%D0%B6%D0%B4%D0%B8%D1%82%D0%B5%D1%81%D1%8C%20%D0%BE%D0%BA%D0%BE%D0%BD%D1%87%D0%B0%D0%BD%D0%B8%D1%8F%20%D1%83%D1%81%D1%82%D0%B0%D0%BD%D0%BE%D0%B2%D0%BA%D0%B8%20%D1%81%D0%B1%D0%BE%D1%80%D0%BA%D0%B8.">
                        <i class="fas fa-download me-2"></i>
                        Перейти к инструкции
                    </a>
                    </div>
                    <div class="col-lg-4 me-auto"><p class="lead">2. Скачайте Hello World код для Интернета вещей. Давайте будем передавать значение всего с одного датчика на Ваш аккаунт на данном портале. В коде укажите SSID и Пароль домашнего WiFi</p>
                    <a class="btn btn-xl btn-outline-light" href="arduino/GET_request_ESP32.ino">
                        <i class="fas fa-download me-2"></i>
                        Код GET-запроса с Ардуино
                    </a>
                    </div>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="col-lg-4 ms-auto"><p class="lead">3. В Get-запросе поменяйте переменные <b>login</b> и <b>secret</b>. login - Ваш логин на этом сервере, secret надо сгенерировать в личном кабинете. Отправляется значение val на датчик / модуль с идентификатором sensor_id. Загрузите полученный код в плату.
                    </p>
                    <a class="btn btn-xl btn-outline-light" href="lk.php">
                        <i class="fas fa-download me-2"></i>
                        Сгенерировать секрет
                    </a>
                    </div>
                    
                    <div class="col-lg-4 me-auto"><p class="lead">4. Значение на сервере смотрится также, как и записывается, только val передавать не надо. Вы регистрировались на 3 шаге, чтобы получить secret. Посмотреть значение на сервере можно по ссылке, в ней надо подставить свой username.</p>
                    <a class="btn btn-xl btn-outline-light" href="sensorData.php?login=kras&sensor_id=1&secret=12345678">
                        <i class="fas fa-download me-2"></i>
                        GET-запрос с браузера
                    </a>
                    </div>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="col-lg-4 ms-auto"><p class="lead">5. Получите переменную со значением датчика. 
                    Вы отправляете GET-запрос, но ответ от сервера Вам важен – из него вы берете значение с конкретного датчика для дальнейшего анализа.
                    </p>
                    <a class="btn btn-xl btn-outline-light" href="arduino/GET_json_value.ino">
                        <i class="fas fa-download me-2"></i>
                        Код чтения JSON в Ардуино
                    </a>
                    </div>
                    <div class="col-lg-4 me-auto">
                    </div>
                </div>
                
                
                <!-- About Section Button-->
                <div class="text-center mt-4">
                    В итоге Вы передаете данные с платы, они сохраняются на сервере, а через браузер Вы можете видеть все значения, переданные микроконтроллерной платой!
                </div>
            </div>
        </section>
        
        <!-- API Section-->
        <section class="page-section bg-secondary text-white mb-0" id="api">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">Команды API</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-adjust"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <style>
                    .api_settings{
                        margin-bottom: 30px; margin-right: 20px;
                    }
                    .links_break{
                        word-break:break-all;
                    }
                </style>
                <!-- About Section Content-->
                <div class="row api_settings">
                    <div class="col-lg-4 ms-auto"><p class="lead">1. Значения считываются микроконтроллером в режиме JSON.</p></div>
                    <div class="col-lg-4 me-auto">
                        <p class="lead">Задайте в Get-запросе дополнительный параметр json. json=1. Полный вариант GET-запроса: 
                            <a class="links_break" href="sensorData.php?login=kras&sensor_id=1&secret=12345678&json=1">http://tfeya.ru/iot/sensorData.php?login=kras&sensor_id=1&secret=12345678&json=1</a>
                        </p>
                    </div>
                </div>
                <div class="row api_settings">
                    <div class="col-lg-4 ms-auto"><p class="lead">2. В режиме JSON можно менять данные.</p></div>
                    <div class="col-lg-4 me-auto">
                        <p class="lead">Задайте в Get-запросе дополнительный параметр json. json=1. При этом используйте val для задания произвольного значения на датчик (частный случай val = 3). Полный вариант GET-запроса: 
                            <a class="links_break" href="sensorData.php?login=kras&sensor_id=1&secret=12345678&json=1&val=3">http://tfeya.ru/iot/sensorData.php?login=kras&sensor_id=1&secret=12345678&json=1&val=3</a>
                        </p>
                    </div>
                </div>
                <div class="row api_settings">
                    <div class="col-lg-4 ms-auto"><p class="lead">3. Данные можно менять и в графическом режиме.</p></div>
                    <div class="col-lg-4 me-auto">
                        <p class="lead">Задайте в Get-запросе дополнительный параметр val = 3. Задайте id сенсора sensor_id = 1. Полный вариант GET-запроса: 
                            <a class="links_break" href="sensorData.php?login=kras&sensor_id=1&secret=12345678&val=3&sensor_id=1">http://tfeya.ru/iot/sensorData.php?login=kras&sensor_id=1&secret=12345678&json=1&val=3&sensor_id=1</a>
                        </p>
                    </div>
                </div>
                <div class="row api_settings">
                    <div class="col-lg-4 ms-auto"><p class="lead">4. Датчик можно называть и переименовывать.</p></div>
                    <div class="col-lg-4 me-auto">
                        <p class="lead">Задайте в Get-запросе дополнительный параметр sensor_name. sensor_name=sensor8. Полный вариант GET-запроса: 
                            <a class="links_break" href="sensorData.php?login=kras&sensor_id=1&secret=12345678&sensor_name=servo8">http://tfeya.ru/iot/sensorData.php?login=kras&sensor_id=1&secret=12345678&sensor_name=servo8</a>
                        </p>
                    </div>
                </div>
                <div class="row api_settings" style="margin-bottom: 0px;">
                    <div class="col-lg-4 ms-auto"><p class="lead">5. Датчику можно давать описание.</p></div>
                    <div class="col-lg-4 me-auto">
                        <p class="lead">Установите в Get-запросе дополнительный параметр sensor_desc. sensor_desc=датчик света. Полный вариант GET-запроса: 
                            <a class="links_break" href="sensorData.php?login=kras&sensor_id=1&secret=12345678&sensor_desc=датчик%20света">http://tfeya.ru/iot/sensorData.php?login=kras&sensor_id=1&secret=12345678&sensor_desc=датчик%20света</a>
                        </p>
                    
                    </div>
                </div>
                <!-- About Section Button-->
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-outline-light" href="">
                        <i class="fas fa-file"></i>
                        Другие API-команды
                    </a>
                </div>
            </div>
        </section>
        
        <!-- Contact Section-->
        <section class="page-section text-white mb-0" id="sites" style="background: #057AB9">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white mb-0">Создавайте свои приложения</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-code"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <center>Вы можете использовать GET-запросы к серверу в любом приложении с любым языком программирования. Следовательно, если Вы, например, веб-разработчик JS, Вы можете написать любое приложение, используя данный сервер как бэкенд для Вашей красивой и кастомизированной веб-панели управления очередным Вашим устройством.
                        </center>
                    </div>
                        <img src="assets/img/user_interface_2_goGxnqRIkT.png" style="max-width:800px; margin-top:40px; margin-left: 20px; border-radius: 15px;"/>
                </div>
            </div>
        </section>
        
        <!-- Contact Section-->
        <section class="page-section" id="contact" >
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Связаться с нами</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-address-book"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">ФИО</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                <label for="phone">Номер телефона</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="У меня для вас есть интересное предложение..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Сообщение</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Технофея</h4>
                        <p class="lead mb-0">
                            Всероссийское сообщество разработчиков
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Мы в Интернете</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="http://vk.com/techfeya"><i class="fab fa-fw fa-vk"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="https://t.me/tfeya"><i class="fab fa-fw fa-telegram"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="https://www.youtube.com/c/Technofeya"><i class="fab fa-fw fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="http://tfeya.ru"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">О проекте</h4>
                        <p class="lead mb-0">
                            Мы разрабатываем много различных устройств: <a href="http://tfeya.ru/portfolio.php">Примеры работ</a>
                            В 2020 году мы поняли: почему бы не управлять ими из Интернета? Работу устройств можно также взаимосвязывать.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; Технофея 2022</small></div>
        </div>
        <!-- Portfolio Modals-->
        <!-- Portfolio Modal 1-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Поливатор</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/done_interfaces/polyvator.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Система для садоводов и сити-фермеров. Как для систем с гидропоникой, так и для умных теплиц вам необходимо устройство, которое включает циркулирующий насос с водой (с питательной смесью), контролирует температуру и влажность. Мы назвали такую систему "Поливатор". Это готовый интерфейс для управления таким устройством. Вы можете также создавать и свои шаблоны.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-star"></i>
                                        Перейти в интерфейс
                                    </button>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Закрыть окно
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 2-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" aria-labelledby="portfolioModal2" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Sensor box - Коробка с сенсорами</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/done_interfaces/sensorBox.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Многие старые устройства работают от пульта. Например, кондиционер. С коробки можно управлять такими приборами, а также эта коробочка измеряет параметры в квартире: температуру и влажность, содержание CO2</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-star"></i>
                                        Перейти в интерфейс
                                    </button>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Закрыть окно
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 3-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" aria-labelledby="portfolioModal3" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Робокот</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/done_interfaces/robocat.jpeg" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Устройство пока больше для забавы, но мы подключили его в сеть умных устройств. Это значит, что можно не только писать программы для него, например, чтобы он встречал хозяина по приходу домой, но делать это через Интернет. Запускать выполнение программы ровно в 19-00, через JS писать код, который управляет его моторами удаленно.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-star"></i>
                                        Перейти в интерфейс
                                    </button>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Закрыть окно
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 4-->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" aria-labelledby="portfolioModal4" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Робот телеприсутствия</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/done_interfaces/telepresence.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Робот телеприсутствия изначально создавался нами как первая версия для удаленного просмотра объектов недвижимости. Подключаешься к роботу и ездишь по квартире, анализируя, какое в ней состояние потолков, пола, стен.</p>
                                    <p class="mb-4">Часто при аренде или покупке квартиры, ведь, отпугивают неожиданные осыпания штукатурки на потолке в спальне, так зачем ехать в такую квартиру, когда ее можно посмотреть онлайн? Простейшего робота можно собрать на базе известных мобильных платформ, тогда как можно использовать робот-пылесос с поставленной на него камерой или купить нормальное большое шасси танка на Али.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-star"></i>
                                        Перейти в интерфейс
                                    </button>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Закрыть окно
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 5-->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" aria-labelledby="portfolioModal5" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Робот телеприсутствия Premium</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/done_interfaces/rieltor.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">На роботе, который работает по принципу робота-пылесоса, спокойно передвигаясь по квартире, установлена камера на штативе, что позволяет ездить по комнатам и в режиме онлайн просматривать их состояние</p>
                                    <? if($userdata['user_login']): ?>
                                        <button onclick="window.location.href='telepresence_robot.php?login=<?=$userdata['user_login']?>&sensor_id=1&secret=<?=$userdata['user_secret']?>';" class="btn btn-primary">
                                    <? else: ?>
                                         <button onclick="window.location.href='login.php';" class="btn btn-primary">
                                    <? endif; ?>
                                        <i class="fas fa-xmark fa-star"></i>
                                        Перейти в интерфейс
                                    </button>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Закрыть окно
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 6-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" aria-labelledby="portfolioModal6" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Submarine</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/submarine.png" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-star"></i>
                                        Перейти в интерфейс
                                    </button>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Закрыть окно
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
