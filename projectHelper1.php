<div class="modal fade bd-example-modal-lg" id="modal-1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="margin-top:70px; padding: 20px 25px">

        <center>
        <h5 class="modal-title" id="exampleModalLabel">О сервисе</h5></h5>
        <p>Разработка систем типа Умного дома и Интернета вещей</p>
        </center>
        
      <div class="modal-body">
   
      <center>
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
   
        <br/><br/>
        
        <p class = "descriptiontext" style="line-height: 1.9;">
            Устройства умного дома и Интернета вещей активно входят в нашу жизнь. Сейчас многие бытовые приборы
            управляются через веб-Интерфейс, а также мы можем сказать умному помощнику "Алиса, включи чайник|пылесос|телевизор|кофемашину"
            и расслабиться, пока за нас все делают современные технологии. Так давайте создадим еще больше устройств с помощью микроконтроллной платы ESP32,
            а данный веб-сервис нам в этом поможет.
        </p>
        
                <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip(); 
            });
        </script>
        
        <center>
            <a href="#" data-toggle="tooltip" title="
            Микроконтроллеры ESP32 впервые были представлены на рынке в 2016 году, после чего
            их активно стали использовать для разных проектах, где не было раньше смысла без
            WiFi-модуля и Bluetooth, тогда как в ESP32 эти модули уже встроены.
            ">
                Микроконтроллерная платформа ESP32
                <br/>
                <img src="assets/esp32photo.png" width = "250px"></img>
            </a>
            <br/><br/>
        </center>
        
       
        <p class = "descriptiontext" style="line-height: 1.9;">
            Мы выделили следующие основные элементы для своего интерфейса:
        </p>
        <br/><br/>
        <ol class="bullet" style = "width: 90%">
            <li>Кликабельные наглядные графики</li>
            <li>Выделение важного текста</li>
            <li>Подсказки, помогающие лучше понять текст</li>
            <li>Выделение ключевых показателей и цифр</li>
            <li>дизайн на основе личных предпочтений пользователя (цветовая гамма, размер шрифта, шрифты, выделяемые в тексте строки и слова)</li>
            <li>Современные дизайнерские готовые решения и обрамления, встроенные в наш продукт</li>
        </ol>
        <br/><br/>
        
        <style>
            .bullet {
            margin-left: 0;
            list-style: none;
            counter-reset: li;
            }
            .bullet li {
            position: relative;
            margin-bottom: 1.5em;
            border: 3px solid #CADFCF;
            padding: 0.6em;
            border-radius: 4px;
            background: #FEFEFE;
            color: #231F20;
            font-family: "Trebuchet MS", "Lucida Sans";
            }
            .bullet li:before {
            position: absolute;
            top: -0.7em;
            padding-left: 0.4em;
            padding-right: 0.4em;
            font-size: 16px;
            font-weight: bold;
            color: #DCC24B;
            background: #FEFEFE;
            border-radius: 50%;
            counter-increment: li;
            content: counter(li);
            }
        </style>
        
        <p class = "descriptiontext" style="line-height: 1.9;">С помощью данного решения Вы можете красиво и красочно 
        показать, например, среднее значение за день с ваших датчиков температуры, установленных по дому. Вот так может выглядеть график:</p>
        <div align="center" style="width: 100%; margin-top: 20px; margin-bottom: 20px" class="bar-container"></div> 
        <br/>
        <p class = "descriptiontext" style="line-height: 1.9;">При желании Вы можете предложить свой график на каждый день недели, а мы красиво его нарисуем. Вы можете создавать кастомные недели работы для Ваших сотрудников, планировать его активность на ближайшие недели и годы, а мы поможем Вам красиво оформить ваши планы и эффективно донести их до сотрудника.</p>
        <p class = "descriptiontext" style="line-height: 1.9;">Попробуйте! до 
            <mark style="margin-left: 3px; padding-left: 10px; padding-right: 10px; text-align: center; background: #7bdcc0">10</mark>
            <mark style="padding-left: 10px; padding-right: 10px; margin-right: 3px; text-align: center; color: white; background: gray">устройств</mark>
            вы можете подключить бесплатно.
        </p>

      </div>

    </div>
  </div>
</div>