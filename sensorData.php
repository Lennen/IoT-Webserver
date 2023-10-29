<?php 
    include './check_login.php';
    include("db_connect.php");
    include "header_includes.php";

    //Получаем ID-пользователя и его API-ключ
    $user1 = filter_var($_GET['login'],FILTER_SANITIZE_STRING);
    $password = filter_var($_GET['password'],FILTER_SANITIZE_STRING);
    
    //Выдавать результат в виде JSON или в виде html
    $json = filter_var($_GET['json'],FILTER_SANITIZE_STRING);
    
    $query = mysqli_query($link,"SELECT user_id, user_secret FROM users WHERE user_login='$user1'");
    $user_data = mysqli_fetch_assoc($query);
    
    //ID пользователя, которого указали в GET-запросе
    $user_id = $user_data['user_id'];
    $user_secret = $user_data['user_secret'];
    $logineduserid = $userdata['user_id'];

    //Если в GET запросе есть логин, проверяем секретную фразу
    if($user1!=''){
        $secret = filter_var($_GET['secret'],FILTER_SANITIZE_STRING);
        $get_user_id = filter_var($_GET['user_id'],FILTER_SANITIZE_STRING);
        $get_val = filter_var($_GET['val'],FILTER_SANITIZE_STRING);
        $sensor_id = filter_var($_GET['sensor_id'],FILTER_SANITIZE_STRING);
        $sensor_name = filter_var($_GET['sensor_name'],FILTER_SANITIZE_STRING);
        $sensor_desc = filter_var($_GET['sensor_desc'],FILTER_SANITIZE_STRING);
        $val_min = filter_var($_GET['val_min'],FILTER_SANITIZE_STRING);
        $val_max = filter_var($_GET['val_max'],FILTER_SANITIZE_STRING);
        
        if(!$val_min){
            $val_min = 0;
        }
        if(!$val_max){
            $val_max = 180;
        }
        
        //Если ключ совпадает и есть данные, записываем в базу данных
        if($_GET['val']!="" and $user_secret == $secret) {
            $result = mysqli_query($link,"INSERT INTO `vals`(`user_id`, `sensor_id`, `val`) VALUES ($user_id, $sensor_id, $get_val)");
        }
        
        if ($user_secret == $secret) {
            //Если было принято имя датчика, его надо обновить или добавить в таблицу
            if($sensor_name) {
                $result = mysqli_query($link,"SELECT `id` FROM `user_sensors` WHERE sensor_id = $sensor_id AND user_id = $user_id");
                if(mysqli_fetch_assoc($result)){
                    //echo('<br/>Имя датчика обновлено');
                    $result = mysqli_query($link,"UPDATE `user_sensors` SET `sensor_name` = '$sensor_name' WHERE sensor_id = $sensor_id AND user_id = $user_id");
                } else {
                    //echo('<br/>Имя датчика сохранено');
                    $result = mysqli_query($link,"INSERT INTO `user_sensors`(`sensor_id`, `user_id`, `sensor_name`) VALUES ($sensor_id, $user_id, '$sensor_name')");  
                }
            }
            //Если было принято описание датчика, его надо обновить или добавить в таблицу
            if($sensor_desc){
                $result = mysqli_query($link,"SELECT `id` FROM `user_sensors` WHERE sensor_id = $sensor_id AND user_id = $user_id");
                if(mysqli_fetch_assoc($result)){
                    //echo('<br/>Описание датчика обновлено');
                    $result = mysqli_query($link,"UPDATE `user_sensors` SET `sensor_desc` = '$sensor_desc' WHERE sensor_id = $sensor_id AND user_id = $user_id");
                } else {
                    //echo('<br/>Описание датчика сохранено');
                    $result = mysqli_query($link,"INSERT INTO `user_sensors`(`sensor_id`, `user_id`, `sensor_desc`) VALUES ($sensor_id, $user_id, '$sensor_desc')");  
                }
            }
        }
        
        //Anyway we should renew the chart data there
        $query1 = mysqli_query($link,"SELECT val, datetime FROM vals WHERE user_id='$user_id' AND sensor_id='$sensor_id'");
        while ($row = $query1->fetch_array(MYSQLI_ASSOC)) {
            foreach ($row as $key=>$value)
                $arr[$key][] = $value;
        }
        
    }
    
    //Получаем инфо по сенсору - название, описание, физ. величина и тп.
    $userid = $userdata['user_id'];
    $query = mysqli_query($link,"SELECT * FROM user_sensors WHERE user_id='$user_id' AND sensor_id='$sensor_id'");
    $sensor_data = mysqli_fetch_assoc($query);
    $sensor_name = $sensor_data['sensor_name'];
    $sensor_desc = $sensor_data['sensor_desc'];
?>

<?php if(!$json):?>
<!--Рисуем html-страницу, если не приняли флаг JSON-->
<?php
    $header = include './header.php';
    include("_localization.php");
?>
  
<body>
    <?php include './head_menu.php'?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include './menu.php'?>
        
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  <h1 class="h2">Датчик</h1>
                  <div class="btn-toolbar mb-2 mb-md-0" style="margin: 5px 15px;">
                    Сервис мониторинга устройств Умного дома и Интернета вещей
                  </div>
                </div>
                
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#description">Значения с датчика</a>
                    </li>
                </ul>
    
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="description">
                        <link rel="stylesheet" type="text/css" href="./styles/user_interface.css">
                        <div style = "margin-top:20px"></div>
                        <div class="left-menu2">
                            <p class = "descriptiontext">
                                <mark style="padding-left: 10px; padding-right: 10px; margin-right: 3px; text-align: center; color: white; background: gray">График для аккаунта</mark>
                                
                                    <?php if($user1):?>
                                    <mark style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0">
                                        <?=$user1;?>
                                    <?php else:?>
                                    <mark style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: pink">
                                        Логин не задан
                                    <?php endif?>
                                </mark>
                            </p>
                        </div>
                        
                        <div class="left-menu2">
                            <p class = "descriptiontext">
                                <mark style="padding-left: 10px; padding-right: 10px; margin-right: 3px; text-align: center; color: white; background: gray">Ключ API введен</mark>
                                
                                    <?php if($user_secret == $secret && $user1):?>
                                    <mark style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0">
                                        Верно
                                    <?php else:?>
                                        <mark style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: pink">
                                        Неверно
                                    <?php endif?>
                                </mark>
                            </p>
                        </div>
                        
                        <div class="left-menu2">
                            <p class = "descriptiontext" >
                                <mark style="padding-left: 10px; padding-right: 10px; margin-right: 3px; text-align: center; color: white; background: gray">ID датчика</mark>
                                <mark style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0">
                                    <?php if($sensor_id):?>
                                        <?=$sensor_id;?>
                                    <?php else:?>
                                        Не задан
                                    <?php endif?>
                                </mark>
                            </p>
                        </div>

                        <div class="left-menu2">
                            <p class = "descriptiontext" >
                                <mark style="padding-left: 10px; padding-right: 10px; margin-right: 3px; text-align: center; color: white; background: gray"><?=$lastReceivedValue[$cl]?></mark>
                                <mark id="senval" style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0">
                                    <?php if($arr['val']):?>
                                        <?php $cnt_all = count($arr['val']); ?>
                                        <?=$arr['val'][$cnt_all-1];?>
                                        
                                    <?php else:?>
                                        Не задано
                                    <?php endif?>
                                    <?php 
                                    $arrr = $arr['val'][0];
                                    echo "<script>console.log('Debug Objects: " . $cnt_all . "' );</script>";?>
                                </mark>
                            </p>
                        </div>
                
                        <br/>
                        <div class="left-menu2">
                            <p class = "descriptiontext" >
                                <mark style="padding-left: 10px; padding-right: 10px; margin-right: 3px; text-align: center; color: white; background: gray">Название датчика</mark>
                                <mark style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0">
                                    <?php if($sensor_name):?>
                                        <?=$sensor_name;?>
                                    <?php else:?>
                                        Не задано
                                    <?php endif?>
                                </mark>
                            </p>
                        </div>
                        
                        <div class="left-menu2">
                            <p class = "descriptiontext" >
                                <mark style="padding-left: 10px; padding-right: 10px; margin-right: 3px; text-align: center; color: white; background: gray">Описание датчика</mark>
                                <mark style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0">
                                    <?php if($sensor_desc):?>
                                        <?=$sensor_desc;?>
                                    <?php else:?>
                                        Не задано
                                    <?php endif?>
                                </mark>
                            </p>
                        </div>

                        <?php if($user_secret == $secret):?>
                            <div id="curve_chart" class = "chart" style = "margin-top: 37px"></div>
                        <?php else:?>
                            <div style = "margin-top: 37px; margin-left: 40px">
                                Запрос неверный. Пример правильного GET-запроса: <br/>
                                <a href = "sensorData.php?login=pepita4&sensor_id=1&val=100&secret=sdfsdfwe45">
                                    sensorData.php?login=pepita4&sensor_id=1&val=100&secret=sdfsdfwe45
                                </a>
                                <br/><br/>
                                    Запрос выше не для вашего датчика. Пример правильного GET-запроса для Вашего датчика, сюда нужно подставить свои данные: <br/>
                                <a href = "sensorData.php?login=<?=$user1?>&sensor_id=1&val=100&secret=xxxxxxx">
                                    sensorData.php?login=<?=$user1?>&sensor_id=1&val=100&secret=xxxxxxx
                                </a>
                                <br/><br/><br/>
                                    <h1>Давайте-ка разберемся</h1><br/>
                                    <b>1. login</b> - Ваш логин, используется для того, чтобы удостовериться, что точно вы отправляете значение на датчик.<br/>
                                    <b>2. sensor_id</b> - ID Вашего датчика. В системе у каждого датчика есть свой уникальный ID.<br/>
                                    <b>3. val</b> - значение с датчика, которое вы хотите сохранить.<br/>
                                    <b>4. secret</b> - ваш специальный пароль (API-ключ), который нужен, чтобы значения не мог записать случайно кто-то другой вместо вас.<br/>
                    
                                <br/>Api-ключ Вам нужно самостоятельно создать и использовать на этом сайте.
                                <br/>Ваш текущий API-ключ, он же secret, можно задать и скопировать из <a href="lk.php">Личного кабинета</a>.
                                <br/>GET-запрос, с которым мы с Вами сейчас разобрались, Вы всегда можете изменить в адресной строке Вашего браузера, подставив нужные вам значения.
                                <br/><br/>Хотите узнать подробнее про GET запросы и использование сервиса? Жмите: <a style = "margin-left: 5px; margin-top: 5px" href="sensorData.php?showmodal=1#"><img src="assets/menu_icons/spravka.svg" style="margin-right:10px; width: 23px"></a>
                                
                                <br/><br/>Если у Вас получилось занести на сервер новые значения с датчика и построить график - можно также задать имя датчику. Для этого не обязательно в GET-запросе передавать
                                val, однако нужно добавить параметр sensor_name, куда записать новое имя датчика:
                                <br/><br/><a href="http://esp32.tfeya.ru/sensorData.php?login=kras&sensor_id=1&secret=12345678&sensor_name=servo8">http://esp32.tfeya.ru/sensorData.php?login=kras&sensor_id=1&secret=12345678&sensor_name=sensor8</a>
                                <br/><br/>Для изменения описания датчика нужно использовать параметр sensor_desc в GET-запросе
                                <br/><br/><a href="http://esp32.tfeya.ru/sensorData.php?login=kras&sensor_id=1&secret=12345678&sensor_desc=Поворотная часть манипулятора в роботе с камерой, закрепленной на манипуляторе">http://esp32.tfeya.ru/sensorData.php?login=kras&sensor_id=1&secret=12345678&sensor_desc=Поворотная часть манипулятора в роботе с камерой, закрепленной на манипуляторе</a>
                                <br/><br/>
                            </div>
                        <?php endif ?>

                        <div id='sunrise' style = "margin-left:50px"></div>
                        <?php include("js/addSensorValChart.php");?>
                        
                        <br/>
                        <h3>
                            Изменить значение на датчике / модуле / двигателе с помощью слайдера
                        </h3>
                        <mark id="senval" style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0"><?=$val_min?></mark>
                        <input type="range" min="<?=$val_min?>" max="<?=$val_max?>" step="1" value="<?=end($arr['val'])?>" oninput="resend_get_via_slider(this.value, <?=$sensor_id?>)">
                        <mark id="senval" style="margin-left: 0px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0"><?=$val_max?></mark>
                        <script>
                            function resend_get_via_slider(val, sensor_id) {
                                let params = (new URL(document.location)).searchParams;
                                let login = params.get("login");
                                let secret = params.get("secret");
                                //console.log(senval);
                                $.ajax({
                                    url: 'https://iot.tfeya.ru/sensorData.php?login='+login+'&val='+val+'&sensor_id='+sensor_id+'&secret='+secret+'&json=0',         /* Куда отправить запрос */
                                    method: 'get',             /* Метод запроса (post или get) */
                                    dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
                                    data: {text: 'Текст'},     /* Данные передаваемые в массиве */
                                    success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
                                	     //alert(); /* В переменной data содержится ответ от index.php. */
                                	     document.getElementById("senval").innerHTML = val;
                                    }
                                });
                            }
                        </script>
                	</div>
                </div>	
    	
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        var url = window.location.href;
        if (url.indexOf('?showmodal=1') != -1) {
            $("#modal-1").modal('show');
            window.history.pushState("object or string", "Title", "sensorData.php"); 
        }
        if (url.indexOf('?showmodal=2') != -1) {
            $("#modal-2").modal('show');
        }
    });
</script>
  
<!-- Модальное окно -->
<?php include('projectHelper2.php'); ?>

<?php $footer = include './footer.php';?>


<!--Выдаем ответ API в JSON-формате, если получен соответствующий флаг-->
<?php elseif($json):?>

    <?php
        $last_val = end($arr['val']);
        $last_datetime = end($arr['datetime']);
        $arr_json = array('val' => $last_val, 'SensorName' => $sensor_name, 'SensorDesc' => $sensor_desc, 'datetime' => $last_datetime);
        $json_string = json_encode($arr_json, JSON_PRETTY_PRINT);
        echo($json_string);
    ?>
<?php endif;?>
