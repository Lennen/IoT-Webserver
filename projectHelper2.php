<div class="modal fade bd-example-modal-lg" id="modal-1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="margin-top:70px; padding: 20px 25px">

        <center>
        <h5 class="modal-title" id="exampleModalLabel">Об использовании сервиса</h5></h5>
        <p>Разработка систем типа Умного дома и Интернета вещей</p>
        </center>
        
      <div class="modal-body">
   
        <center style="margin-bottom: 35px;">
            <div style = "display: flex; flex-wrap: wrap; align-items: stretch; align-content: space-between; justify-content: center">
                    <div style = "background-color: #EEEEEE; border-radius: 7px; padding: 10px 18px; margin-right: 2px; margin-bottom: 15px">
                        <a style="font-size: 13px;" id = "inputText" href="<?php echo("/sensorData.php?login=pepita4&sensor_id=1&val=5000&secret=sdfsdfwe45"); ?>"><div id="div1"><?php echo($_SERVER['SERVER_NAME']); echo("/sensorData.php?login=pepita4&sensor_id=1&val=5000&secret=sdfsdfwe45"); ?> </div></a>
                    </div> 
                    <div>
                        <button id = "copyText" type="button" class="btn btn-primary" onclick="CopyToClipboard('div1')">Скопировать</button>
                    </div>
                <script type="text/javascript" src="js/copyToClipboard.js" ></script>
            </div>
        </center>
        
        <p class = "descriptiontext" style="line-height: 1.9;">
            Для подключения любого устройства вам необходимо знать только то, что сервер принимает значения val, записанные в переменную
            Get-запроса, представленного выше. Прежде, чем подключать микроконтроллер ESP32 к веб-серверу, или даже целые устройства и системы,
            убедитесь, что Вы можете отправить значение на сервер через Ваш браузер с использованием Get-запроса.
        </p>
        
        <center><img src="assets/img/espserver_about/request-responce.png" width = "70%"></img></center>
        
        <p class = "descriptiontext" style="line-height: 1.9;">
            Значение val может быть, например, напряжение с датчика газа или сигнала в моменте времени, идущий
            с датчика расстояния или присутствия. На основе датчиков можно принимать разные решения, такие как
            включение света, бытовых приборов, устройств полива растений и так далее. По одиночным значениям мы можем
            построить целый график, демонстрирующий, например, как менялась освещенность за письменным столом в зале
            Вашего дома в течение дня.
        </p>
        
        <p class = "descriptiontext" style="line-height: 1.9;">
            Ваш браузер отправляет запрос на веб-сервер и получает ответ, который в браузере будет выглядеть как обычная веб-страница.
            На этой странице Вы можете увидеть сначала рекоммендации, как увидеть те значения, которые вы отправили на сервер.
            А затем увидите такой график:
        </p>
        
        <center><img src="assets/img/espserver_about/sensorDataChart.png" width = "100%"></img></center>
        
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip(); 
            });
        </script>
        
        <center>
            <a href="#" data-toggle="tooltip" title="
            Микроконтроллеры ESP32 выполняют роль микрокомпьютера (и браузера компьютера), который считывает значения с разных датчиков
            и отправляет их куда это необходимо по WIFI в сети Интернет.
            ">
                <img style = "margin-top:30px;margin-bottom:30px" src="assets/esp32photo.png" width = "250px"></img>
            </a>
        </center>

        <p class = "descriptiontext" style="line-height: 1.9;">
            Чтобы отправлять значения с датчика, используя ESP32, Вам нужно разобраться, как отправить такой же запрос,
            какой вы можете сформировать из своего браузера, с платы ESP32. Вы можете найти информацию на сайте:
            <a href="http://online.robofeya.ru">Онлайн-школа</a>
        </p>
        
        <br/>
        <img src="assets/img/espserver_about/webserver.jpg" width = "100%"></img>
        <br/><br/>

      </div>

    </div>
  </div>
</div>