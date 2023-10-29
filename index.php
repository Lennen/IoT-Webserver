<?php 
    $header = include './header.php';
    include './check_login.php';
?>

    	<?php
    	$userlogin = $userdata['user_login'];
    	$query = mysqli_query($link,"SELECT user_id FROM users WHERE user_login='$userlogin'");
        $user_id = mysqli_fetch_assoc($query);
        $user_id = $user_id['user_id'];
        $sensor_id = 1;
        //$user_id = 24;
        
        
        
    	$query1 = mysqli_query($link,"SELECT val, datetime FROM vals WHERE user_id='$user_id' AND sensor_id='$sensor_id'");
        while ($row = $query1->fetch_array(MYSQLI_ASSOC)) {
            foreach ($row as $key=>$value)
                $arr[$key][] = $value;
        }
        
        $sensor_id = 2;
        $query1 = mysqli_query($link,"SELECT val, datetime FROM vals WHERE user_id='$user_id' AND sensor_id='$sensor_id'");
        while ($row = $query1->fetch_array(MYSQLI_ASSOC)) {
            foreach ($row as $key=>$value)
                $arr2[$key][] = $value;
        }
        
        ?>
        
<style>
</style> 
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
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
    var dat1 = 0;
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(function() { drawChart(dat1);});
    </script>
    
    <script type="text/javascript">
    function drawChart(dat1) {  //LineChart
        var data = google.visualization.arrayToDataTable([
          ['<?=$title[$cl]?>', '<?=$sensorVal[$cl]?>'],
          <?php $cnt_all = count($arr['val']); $x = $cnt_all-10; while ($x++<$cnt_all-1): ?>
          ['<?=$x?>',  <?=$arr['val'][$x]?>],
          <?php endwhile ?>
          ['<?$cnt_all-1?>',  <?=$arr['val'][$cnt_all-1]?>]
        ]);

        var options = {
            title: '<?=$sensorVals[$cl]?>',
            //lineDashStyle: [4, 4],
            pointSize: 7,
            tooltip: {textStyle: {color: 'gray'}, showColorCode: true},
            hAxis: {
                title: '<?=$xAxisLabel[$cl]?>',
                ticks: [5,10,15,20],
                titleTextStyle: {color: 'gray'}
            },
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
    </script>
    
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {  //LineChart
        var data = google.visualization.arrayToDataTable([
          ['<?=$title[$cl]?>', '<?=$sensorVal[$cl]?>'],
          <?php $cnt_all = count($arr2['val']); $x = $cnt_all-10; while ($x++<$cnt_all-1): ?>
          ['<?=$x?>',  <?=$arr2['val'][$x]?>],
          <?php endwhile ?>
          ['<?$cnt_all-1?>',  <?=$arr2['val'][$cnt_all-1]?>]
        ]);

        var options = {
            title: '<?=$sensorVals[$cl]?>',
            //lineDashStyle: [4, 4],
            pointSize: 7,
            tooltip: {textStyle: {color: 'gray'}, showColorCode: true},
            hAxis: {
                title: '<?=$xAxisLabel[$cl]?>',
                ticks: [5,10,15,20],
                titleTextStyle: {color: 'gray'}
            },
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

        chart.draw(data, options);
    }
    </script>
    

<?php if ($login_success == 1): ?>                                  <!--Зашел как пользователь-->

  <script>
    $(document).ready(function() {
    var url = window.location.href;
  if (url.indexOf('?showmodal=1') != -1) {
    $("#modal-1").modal('show');
    window.history.pushState("object or string", "Title", "index.php"); 
  }
  if (url.indexOf('?showmodal=2') != -1) {
    $("#modal-2").modal('show');
  }
});
  </script>
  
  <!-- Модальное окно -->
<?php include('projectHelper1.php'); ?>

  
<head>
    <!-- Calendar -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="calendar/fonts/icomoon/style.css">
    <link rel="stylesheet" href="calendar/css/rome.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="calendar/css/style.css">
    

    
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

</head>
  
<body>
    <?php include './head_menu.php'?>

    <div class="container-fluid">
        <div class="row">
            
        <?php include './menu.php'?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">Панель управления</h1>
              <div class="btn-toolbar mb-2 mb-md-0">
                Сервис мониторинга устройств Умного дома и Интернета вещей
              </div>
            </div>
            
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#description">Главная</a>
                </li>
                 <a style = "margin-left: 20px; margin-top: 5px" href="index.php?showmodal=1#"><img src="assets/menu_icons/spravka.svg" style="margin-right:10px; width: 23px"></a>
            </ul>
           

<div class="tab-content">
    <div class="tab-pane fade show active" id="description">

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
        
    
    	<div id="curve_chart" class = "chart"></div>
    	<div id="curve_chart2" class = "chart"></div>
    	

    	<div id="curve_chart3" class = "chart"></div>
    	
    	
    	<div style = "display: flex; flex-wrap: wrap; justify-content: stretch;">
  
                <?php include 'instruction_items/videos.html'?>
               
            
	    </div>
  
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
        { name: 'Спальня шкафы', value: 1 },
        { name: 'Кухня плита', value: 1.5 },
        { name: 'Кухня возле стола', value: 1.8 },
        { name: 'Зал на диване', value: 0.1 },
        { name: 'Зал у шкафа', value: 0.9 },
        { name: 'Ванная', value: 2.2 },
        { name: 'Туалет', value: 0.5 }
    ];

    // Configure chart
    barChart
        .margin({left: 200})
        .isHorizontal(true)
        .height(400)
        .width(500);

    container.datum(barData).call(barChart);
</script>

<?php else: ?>                                                      <!--Зашел как гость-->
    <script type="text/javascript">
        document.location.replace("start.php");
    </script>
<?php endif; ?>
          
<?php $footer = include './footer.php';?>
