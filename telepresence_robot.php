<?php 
    include './check_login.php';
    include("db_connect.php");
?>

<?php
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
        
        //И по следующему датчику тоже
        $sensor_id1=$sensor_id+1;
        $query1 = mysqli_query($link,"SELECT val, datetime FROM vals WHERE user_id='$user_id' AND sensor_id='$sensor_id1'");
        while ($row = $query1->fetch_array(MYSQLI_ASSOC)) {
            foreach ($row as $key=>$value)
                $arr1[$key][] = $value;
        }
        
        //И по левому колесу тоже
        $sensor_id2=$sensor_id+2;
        $query2 = mysqli_query($link,"SELECT val, datetime FROM vals WHERE user_id='$user_id' AND sensor_id='$sensor_id2'");
        while ($row = $query1->fetch_array(MYSQLI_ASSOC)) {
            foreach ($row as $key=>$value)
                $arr2[$key][] = $value;
        }
        
        //И по правому колесу тоже
        $sensor_id3=$sensor_id+3;
        $query3 = mysqli_query($link,"SELECT val, datetime FROM vals WHERE user_id='$user_id' AND sensor_id='$sensor_id3'");
        while ($row = $query1->fetch_array(MYSQLI_ASSOC)) {
            foreach ($row as $key=>$value)
                $arr3[$key][] = $value;
        }
        
    }
    
    //Получаем инфо по сенсору - название, описание, физ. величина и тп.
    $userid = $userdata['user_id'];
    $query = mysqli_query($link,"SELECT * FROM user_sensors WHERE user_id='$user_id' AND sensor_id='$sensor_id'");
    $sensor_data = mysqli_fetch_assoc($query);
    $sensor_name = $sensor_data['sensor_name'];
    $sensor_desc = $sensor_data['sensor_desc'];
    
    //Получаем инфо по следующему сенсору - название, описание, физ. величина и тп.
    $query = mysqli_query($link,"SELECT * FROM user_sensors WHERE user_id='$user_id' AND sensor_id='$sensor_id1'");
    $sensor_data1 = mysqli_fetch_assoc($query);
    $sensor_name1 = $sensor_data1['sensor_name'];
    $sensor_desc1 = $sensor_data1['sensor_desc'];
?>

<?php if(!$json):?>
<!--Рисуем html-страницу, если не приняли флаг JSON-->
<?php
    $header = include './header.php';
    include("_localization.php");
?>
<head>
    <!-- For Correct Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="calendar/fonts/icomoon/style.css">
    <link rel="stylesheet" href="calendar/css/rome.css">
    <link rel="stylesheet" href="calendar/css/style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    
    <script defer>
        (function(i, s, o, g, r, a, m) {
          i['GoogleAnalyticsObject'] = r;
          i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
          }, i[r].l = 1 * new Date();
          a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
          a.async = 1;
          a.src = g;
          m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    
        ga('create', 'UA-4481610-59', 'auto');
        ga('send', 'pageview');
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-selection/1.2.0/d3-selection.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/britecharts@2.10.0/dist/umd/donut.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/britecharts@2.10.0/dist/umd/legend.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-selection/1.2.0/d3-selection.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/britecharts@2.10.0/dist/umd/bar.min.js"
        type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/britecharts/dist/css/britecharts.min.css" type="text/css" />    

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>
    <?php include './head_menu.php'?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include './menu.php'?>
        
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  <h1 class="h2">Робот телеприсутствия</h1>
                  <div class="btn-toolbar mb-2 mb-md-0" style="margin: 5px 15px;">
                    Сервис мониторинга устройств Умного дома и Интернета вещей
                  </div>
                </div>
                
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#description">Интерфейс управления роботом</a>
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
                            <br/>
                            <!--График-->
                            <h2 style="margin-left: 30px;">Sensor_id = <?=$sensor_id?></h2>
                            <div id="curve_chart" class = "chart" style = "margin-top: 7px"></div>
                            <div id='sunrise' style = "margin-left:50px"></div>
                            <br/>
                            
                            <!--График-->
                            <h2 style="margin-left: 30px;">Sensor_id = <?=$sensor_id+1?></h2>
                            <div id="curve_chart1" class = "chart" style = "margin-top: 7px"></div>
                            <div id='sunrise1' style = "margin-left:50px"></div>
                            
                            <!--График-->
                            <h2 style="margin-left: 30px;">Sensor_id = <?=$sensor_id+2?></h2>
                            <div id="curve_chart2" class = "chart" style = "margin-top: 7px"></div>
                            <div id='sunrise2' style = "margin-left:50px"></div>
                            
                            <!--График-->
                            <h2 style="margin-left: 30px;">Sensor_id = <?=$sensor_id+3?></h2>
                            <div id="curve_chart3" class = "chart" style = "margin-top: 7px"></div>
                            <div id='sunrise3' style = "margin-left:50px"></div>
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

                        
                        
                        <br/>
                        
                        <style>
                            .controls{
                                margin: 20px 10px;
                            }
                        </style>
                        <div id="slider-plecho" class="controls" >
                            <h3>
                                Изменить значение угла поворота камеры влево / вправо
                            </h3>
                            <mark id="senval" style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0"><?=$val_min?></mark>
                            <input type="range" min="<?=$val_min?>" max="<?=$val_max?>" step="1" value="<?=end($arr['val'])?>" onchange="resend_get_via_slider(this.value, <?=$sensor_id?>,'sunrise', 'curve_chart', chart_vals, chart_datetime)">
                            <mark id="senval" style="margin-left: 0px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0"><?=$val_max?></mark>
                        </div>
                        
                        <div id="slider-lokot" class="controls" >
                            <h3>
                                Изменить значение угла поворота камеры вверх-вниз
                            </h3>
                            <mark id="senval" style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0"><?=$val_min?></mark>
                            <input type="range" min="<?=$val_min?>" max="<?=$val_max?>" step="1" value="<?=end($arr1['val'])?>" onchange="resend_get_via_slider(this.value, <?=$sensor_id1?>,'sunrise1', 'curve_chart1', chart_vals1, chart_datetime1)">
                            <mark id="senval" style="margin-left: 0px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0"><?=$val_max?></mark>
                        </div>
                        
                        <div id="slider-lokot" class="controls" >
                            <h3>
                                Изменить скорость левого колеса робота
                            </h3>
                            <mark id="senval" style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0">-255</mark>
                            <input type="range" min="-255" max="255" step="1" value="<?=end($arr2['val'])?>" onchange="resend_get_via_slider(this.value, <?=$sensor_id2?>,'sunrise2', 'curve_chart2', chart_vals2, chart_datetime2)">
                            <mark id="senval" style="margin-left: 0px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0">255</mark>
                        </div>
                        
                        <div id="slider-lokot" class="controls" >
                            <h3>
                                Изменить скорость правого колеса робота
                            </h3>
                            <mark id="senval" style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0">-255</mark>
                            <input type="range" min="-255" max="255" step="1" value="<?=end($arr3['val'])?>" onchange="resend_get_via_slider(this.value, <?=$sensor_id3?>,'sunrise3', 'curve_chart3', chart_vals3, chart_datetime3)">
                            <mark id="senval" style="margin-left: 0px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0">255</mark>
                        </div>
                        
                        <br/><br/>
                        <script>
                            function resend_get_via_slider(val_, sensor_id_, sunrise_, curve_chart_, chart_vals_, chart_datetime_) {
                                //sleep(60);
                                
                                //var senval = document.getElementById("senval").innerHTML;
                                let params = (new URL(document.location)).searchParams;
                                let login = params.get("login");
                                let secret = params.get("secret");
                                
                                
                                $.ajax({
                                    url: 'https://iot.tfeya.ru/telepresence_robot.php?login='+login+'&val='+val_+'&sensor_id='+sensor_id_+'&secret='+secret+'&json=0',         /* Куда отправить запрос */
                                    method: 'get',             /* Метод запроса (post или get) */
                                    dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
                                    data: {text: 'Текст'},     /* Данные передаваемые в массиве */
                                    success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
                                	     //alert(""); /* В переменной data содержится ответ от index.php. */
                                	     document.getElementById("senval").innerHTML = val_;
                                    }
                                });
                                
                                chart_vals_.push(val_);
                                //chart_datetime;
                                var currentdate = new Date(); 
                                var datetime_ =  currentdate.getDate() + "-"
                                                + (currentdate.getMonth()+1)  + "-" 
                                                + currentdate.getFullYear() + " "  
                                                + currentdate.getHours() + ":"  
                                                + currentdate.getMinutes() + ":" 
                                                + currentdate.getSeconds();
                                chart_datetime_.push(datetime_);
                                
                                console.log(chart_datetime_);
                                console.log(chart_vals_);
                                
                                drawChart111(sunrise_, curve_chart_, chart_vals_, chart_datetime_);
                            }
                            function sleep(millis) {
                                var t = (new Date()).getTime();
                                var i = 0;
                                while (((new Date()).getTime() - t) < millis) {
                                    i++;
                                }
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

<script>
    //Строим график в первый раз: получили данные с бека
    //И переводим их в JS-массивы
    <?
        $chart_vals = json_encode($arr['val']);
        $chart_datetime = json_encode($arr['datetime']);
        
        //И по следующему датчику
        $chart_vals1 = json_encode($arr1['val']);
        $chart_datetime1 = json_encode($arr1['datetime']);
        
        //И по следующему датчику
        $chart_vals2 = json_encode($arr2['val']);
        $chart_datetime2 = json_encode($arr2['datetime']);
        
        //И по следующему датчику
        $chart_vals3 = json_encode($arr3['val']);
        $chart_datetime3 = json_encode($arr3['datetime']);
    ?>
    
    let chart_vals = [];
    let chart_datetime = [];
    
    //И по следующему датчику
    let chart_vals1 = [];
    let chart_datetime1 = [];
    
    //И по следующему датчику
    let chart_vals2 = [];
    let chart_datetime2 = [];
    
    //И по следующему датчику
    let chart_vals3 = [];
    let chart_datetime3 = [];

///////////////// По первому датчику /////////////////    
    //Ось Y - Значения (если еще нет - нужно первое значение)
    if (!<?=$chart_vals?>){
        //chart_vals.push('0');
    } else{
        chart_vals=<?=$chart_vals?>;
    }
    
    //Ось Х - Временные метки (если еще нет - нужно первое значение)
    if (!<?=$chart_datetime?>){
        var currentdate1 = new Date(); 
        var datetime1 =  currentdate1.getDate() + "-"
                            + (currentdate1.getMonth()+1)  + "-" 
                            + currentdate1.getFullYear() + " "  
                            + currentdate1.getHours() + ":"  
                            + currentdate1.getMinutes() + ":" 
                            + currentdate1.getSeconds();
        //chart_datetime.push(datetime1);
    } else{
        chart_datetime=<?=$chart_datetime?>;
    }

////////////////// И по следующему датчику ////////////////////
    //Ось Y - Значения (если еще нет - нужно первое значение)
    if (!<?=$chart_vals1?>){
        //chart_vals.push('0');
    } else{
        chart_vals1=<?=$chart_vals1?>;
    }
    
    //Ось Х - Временные метки (если еще нет - нужно первое значение)
    if (!<?=$chart_datetime1?>){
        var currentdate11 = new Date(); 
        var datetime11 =  currentdate11.getDate() + "-"
                            + (currentdate11.getMonth()+1)  + "-" 
                            + currentdate11.getFullYear() + " "  
                            + currentdate11.getHours() + ":"  
                            + currentdate11.getMinutes() + ":" 
                            + currentdate11.getSeconds();
        //chart_datetime.push(datetime1);
    } else{
        chart_datetime1=<?=$chart_datetime1?>;
    }

////////////////// И по левому ////////////////////
    //Ось Y - Значения (если еще нет - нужно первое значение)
    if (!<?=$chart_vals2?>){
        //chart_vals.push('0');
    } else{
        chart_vals1=<?=$chart_vals2?>;
    }
    
    //Ось Х - Временные метки (если еще нет - нужно первое значение)
    if (!<?=$chart_datetime2?>){
        var currentdate12 = new Date(); 
        var datetime12 =  currentdate12.getDate() + "-"
                            + (currentdate12.getMonth()+1)  + "-" 
                            + currentdate12.getFullYear() + " "  
                            + currentdate12.getHours() + ":"  
                            + currentdate12.getMinutes() + ":" 
                            + currentdate12.getSeconds();
        //chart_datetime.push(datetime1);
    } else{
        chart_datetime2=<?=$chart_datetime2?>;
    }

////////////////// И по правому колесу ////////////////////
    //Ось Y - Значения (если еще нет - нужно первое значение)
    if (!<?=$chart_vals3?>){
        //chart_vals.push('0');
    } else{
        chart_vals3=<?=$chart_vals3?>;
    }
    
    //Ось Х - Временные метки (если еще нет - нужно первое значение)
    if (!<?=$chart_datetime3?>){
        var currentdate13 = new Date(); 
        var datetime13 =  currentdate13.getDate() + "-"
                            + (currentdate13.getMonth()+1)  + "-" 
                            + currentdate13.getFullYear() + " "  
                            + currentdate13.getHours() + ":"  
                            + currentdate13.getMinutes() + ":" 
                            + currentdate13.getSeconds();
        //chart_datetime.push(datetime1);
    } else{
        chart_datetime3=<?=$chart_datetime3?>;
    }
    
    //В первый раз строим график на странице
    //Потом при перемещении ползунков график нужно будет перестраивать
    drawChart111('sunrise','curve_chart', chart_vals, chart_datetime);
    drawChart111('sunrise1','curve_chart1', chart_vals1, chart_datetime1);
    drawChart111('sunrise2','curve_chart2', chart_vals2, chart_datetime2);
    drawChart111('sunrise3','curve_chart3', chart_vals3, chart_datetime3);
    
    function drawChart111(notice_zone, chart_zone, chart_vals_, chart_datetime_) {
            //Chart for the sensorData.php to check the value added from the sensor
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
    
        /* Построит по годам 2 графика - Продажи и Затраты
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);
        */
        
        if(chart_vals_.length < 10){
            document.getElementById(notice_zone).innerHTML = "Для нормального отображения графика еще нужно значений: "+(10-chart_vals_.length);
        } else {
            document.getElementById(notice_zone).innerHTML = "";
        }
        
        let cnt_all = chart_vals_.length;
        let x = cnt_all-10;
        
        let putIt="google.visualization.arrayToDataTable([['<?=$title[$cl]?>', '<?=$sensorVal[$cl]?>'],";
        while (x++<cnt_all-2){
            putIt += "['"+chart_datetime_[x]+"',  "+parseInt(chart_vals_[x])+"],";
        }
        putIt += "['"+chart_datetime_[cnt_all-1]+"',  "+parseInt(chart_vals_[cnt_all-1])+"]]);";
        
        let chartTitle = "Значение угла поворота штатива влево / вправо";
        
        function drawChart() {  //LineChart
            //Данные
            var data = eval(putIt);

           //Опции графика 
            var options = {
                title: chartTitle,
                pointSize: 7,
                tooltip: {textStyle: {color: 'gray'}, showColorCode: true},
                //curveType: 'function',
                legend: { position: 'bottom' }
            };
    
            var chart = new google.visualization.LineChart(document.getElementById(chart_zone));
            chart.draw(data, options);
        }
    }
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

