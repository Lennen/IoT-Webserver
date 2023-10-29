<?php 
    $header = include './header.php';
    include './check_login.php';
?>

<style>

    </style>
  
<body>
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
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/britecharts/dist/css/britecharts.min.css" type="text/css" />    

<script src="https://cdnjs.cloudflare.com/ajax/libs/d3-selection/1.2.0/d3-selection.js"></script>
<script src="https://cdn.jsdelivr.net/npm/britecharts@2.10.0/dist/umd/bar.min.js"
        type="text/javascript"></script>
    
    
    <script>
        if (window.location.hash == "#imprint") {
     $('#exampleModal').modal('show');
}
    </script>
    <?php include './head_menu.php'?>

    <div class="container-fluid">
        <div class="row">
            
        <?php include './menu.php'?>
        <script> 
            const element = document.querySelector('div.dolj_instructions').classList.add('active');
            const element1 = document.querySelector('.instructions').classList.add('active');
            </script>
    
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">Сгенерированные должностные инструкции</h1>
              

              
              <div class="btn-toolbar mb-2 mb-md-0">
                Сервис генерации одностраничников
              </div>
            </div>
            
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#description">Сгенерировать</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#characteristics">О сервисе</a>
                </li>
            </ul>
<div class="tab-content" style="margin: 15px 15px">
    <div class="tab-pane fade show active" id="description">
  
  
  
  <!-- Модальное окно -->
<div class="modal fade" id="modal-1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:70px; padding: 20px 5px">

        <center>
        <h5 class="modal-title" id="exampleModalLabel">Опубликовано</h5>
        <p>Страница доступна по ссылке</p>
        </center>
        
      <div class="modal-body">
        <table align = "center"><tr><td>
        <div style = "width: 300px; height: 40px; background-color: #EEEEEE; border-radius: 7px; padding: 10px 18px; margin-right: 5px">
            <a href="<?php echo ('page/'); echo $_GET['link']?>"><?php echo($_SERVER['SERVER_NAME']); echo("/page/"); echo $_GET['link']?></a>
        </div> 
        </td><td>
        <button type="button" class="btn btn-primary">Скопировать</button>
        </td></tr></table>
      </div>

    </div>
  </div>
</div>
  
  
  <script>
    $(document).ready(function() {
    var url = window.location.href;
  if (url.indexOf('?showmodal=1') != -1) {
    $("#modal-1").modal('show');
  }
  if (url.indexOf('?showmodal=2') != -1) {
    $("#modal-2").modal('show');
  }
});
  </script>




        
        <?php if ($login_success == 1): ?>                                  <!--Зашел как пользователь-->
        <p>Укажите необходимые данные для автоматической генерации "онлайн" документа</p>
        
        <form action="./newpage.php" method="post" enctype="multipart/form-data">
            
        <div style = "display: flex; flex-wrap: wrap; justify-content: stretch" align="center">
        
            <div class="inp">
                <label>Филиал</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            
            <div class="inp">
                <label>Укажите должность</label>
                <input type="text" class="form-control">
            </div>

            <div class="inp">
                <label>Укажите возрастную группу</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>До 20 лет</option>
                    <option>20-25 лет</option>
                    <option>25-30 лет</option>
                    <option>30-40</option>
                    <option>Более 50 лет</option>
                </select>
            </div>
            
            <div class="inp">
                <label>Разделы инструкции</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            
            <div class="inp">
                <label>Логотип</label>
                <input class="form-control" name = "logolink" id="exampleFormControlSelect1" value = "assets/logo.svg">
                </input>
            </div>
        
        </div>
        
        <div class="inp">
                <label>Файл инструкций</label>
                <div class="custom-file mb-3">
                    
                        <input type="file" class="custom-file-input" name="uploadfile" id="validatedCustomFile">
                        <label class="custom-file-label" for="validatedCustomFile">Выбрать файл...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                            <script>
                                $('#validatedCustomFile').on('change',function(){
                                //get the file name
                                var fileName = $(this).valueOf()[0].files[0].name;
                                //replace the "Choose a file" label
                                $(this).next('.custom-file-label').html(fileName);
                                })
                            </script>
                </div>
            </div>
            
            <input type="submit" class="btn btn-success btn-lg btn-block" style = "width:245px; height:44px; margin-bottom: 20px" value="Сгенерировать">
                    </form>
        
    
        <h2 class="my-3">Все инструкции</h2>

        <?php
            function listdir_by_date($path){
                $dir = opendir($path);
                $list = array();
                while($file = readdir($dir)){
                    if ($file != '.' && $file != '..' && $file[strlen($file)-1] != '~' ){
                        $ctime = filectime( $path . $file ) . ',' . $file;
                        $list[$ctime] = $file;
                    }
                }
                closedir($dir);
                krsort($list); // используя методы krsort и ksort можем влиять на порядок сортировки
                return $list;
            }
    
            $dir  = './page/';
            $files = listdir_by_date($dir);
    	?>
    	
    	<div style = "display: flex; flex-wrap: wrap; justify-content: stretch">	
    	    <?php if (count($files) > 0) : ?>
    	        <?php $cnt = 1; foreach ($files as $key=>$file) : ?>
    		        <?php if ($cnt == 1) : ?>
    			        <div style = "border: 4px solid #DAA520; width:187px; height: 193px; border-radius: 4px; margin-right:30px;">
    			    <?php endif ?>
    			    <?php if ($cnt != 1) : ?>
    			        <div class = "currentFile" style = "border: 3px solid #fff; margin-right:30px;">
    			    <?php endif ?>
    			
    			    <center>
    			        <div class = instructionelem>
    			            <div class="instructionpreview">
        			            <iframe src="page/<?=$file?>"  id="frame" scrolling=no></iframe>  
        			        </div>
    			            <div>
    			                №<?=$cnt?>:  
    			                <a target=blank href=./page/<?=$file?>><?=$file?></a>
    			            </div>
                            <div class = "instructionelemtitle">
                                <p style = "color: #828282; font-size: 12px; font-family: Montserrat">
                                    <img src="assets/vector.svg" style="width:28px"></img>
                                    <?=date ("F d Y H:i:s.", $key)?>
                                </p>
                            </div>
                        </div>
    			    <br/>
    			    </center>
    			    
    			        </div>
    			    <?php $cnt++; ?>
    		    <?php endforeach ?>
    		<?php endif; ?>
    	                </div>
    	</div>
    	
    	<?php else: ?>                                                      <!--Зашел как гость-->
    	    <br/>
    	    <h5>Пожалуйста, войдите как пользователь, чтобы увидеть свои должностные инструкции</h5>
    	<?php endif; ?>

  <div class="tab-pane fade" id="characteristics">
    <br/>
    <p class = "descriptiontext">
        Каждый день мы читаем десятки статей и материалов, профессиональной документации, получаем новые инструкции и задачи. 
    Несмотря на тренды автоматизировать человеческий труд, до сих пор все текстовые документы и их оформление создает человек. От него зависит, насколько материалы будет приятно читать,
    сколько там будет визуализированной информации, а сколько текстовой. Создатель хорошего контента, который приятно читать и который легко усваивать - это относительно сложная творческая профессия, требующая навыков в дизайне, психологии, управлении.
    </p>
    <p class = "descriptiontext">
    Например, на предприятии есть тысячи сотрудников по всей России. Им нужно проводить ежегодный инструктаж, напоминать о том, что делать на предприятии можно, а чего нельзя.
    Самый начальный документ - должностная инструкция, где написаны основные обязанности, права и распорядок дня сотрудника. На обучение одного своего профессионала сотрудники отдела кадров могут тратить до 40 рабочих часов. До 40000 часов уходит на обучение 1000-чи новых сотрудников кампании, что в денежном эквиваленте можно выразить, например, как число 40 млн рублей ежегодно. 
    Наше решение позволяет из скучной должностной инструкции в doc, pdf, rtf форматах получить одностраничный сайт с хорошим дизайном и предоставить ссылку на него новому сотруднику. По окончанию прочтения новый сотрудник выполняет тест, результаты которого автоматически передаются в компанию. После чего считается, что сотрудник прошел инструктаж.
    </p>
    
    <p class = "descriptiontext">
       
    Мы выделили следующие основные элементы:
        - графики;
        - выделение важного текста;
        - выделение ключевых показателей и цифр;
        - дизайн на основе личных предпочтений пользователя (цветовая гамма, размер шрифта, шрифты, выделяемые в тексте строки и слова).
    </p>
    <p class = "descriptiontext">С помощью данного решения Вы можете красиво и красочно описать, например, рабочий день Вашего сотрудника. Вот так он может выглядеть для воспитательницы в детском саду:</p>
    <div style="margin-left:240px" class="bar-container"></div> 
    <br/>
    <p class = "descriptiontext">При желании Вы можете предложить свой график на каждый день недели, а мы красиво его нарисуем. Вы можете создавать кастомные недели работы для Ваших сотрудников, планировать его активность на ближайшие недели и годы, а мы поможем Вам красиво оформить ваши планы и эффективно донести их до сотрудника.</p>
    <p class = "descriptiontext">Попробуйте! до 5 документов вы можете сгенерировать бесплатно.</p>
  </div>
</div>
            
  </div>
  </div>    		
</body>

<script>
    // Instantiate bar chart and container
    const barChart = britecharts.bar();
    const container = d3.select('.bar-container');

    // Create Dataset with proper shape
    const barData = [
        { name: 'Встретить детей', value: 1 },
        { name: 'Утренняя гимнастика', value: 1 },
        { name: 'Адаптация детей', value: 1 },
        { name: 'Завтрак', value: 1 },
        { name: 'Самостоятельные игры', value: 1 },
        { name: 'Второй завтрак', value: 1 },
        { name: 'Прогулка', value: 0.9 },
        { name: 'Обед', value: 1.5 },
        { name: 'Дневной сон', value: 1 },
        { name: 'Гигиенические процедуры', value: 1 },
        { name: 'Игра с детьми', value: 1.8 },
        { name: 'Планерка', value: 0.1 },
        { name: 'Уроки', value: 2.2 },
        { name: 'Отдать детей родителям', value: 0.5 }
    ];

    // Configure chart
    barChart
        .margin({left: 250})
        .isHorizontal(true)
        .height(400)
        .width(600);

    container.datum(barData).call(barChart);
</script>
          
<?php $footer = include './footer.php';?>