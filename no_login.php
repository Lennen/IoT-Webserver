<?
//Файл необходим непосредственно для того, чтобы ESP32 могла передавать данные без использования COOKIES. 
//Файл является альтернативой файлу check.php, где обязательно пользователь должен быть зарегистрирован.
//Здесь же необходимо только значение с датчика и id пользователя или его login.

include("db_connect.php");
include("_localization.php");

$user1 = filter_var($_GET['login'],FILTER_SANITIZE_STRING);
$password = filter_var($_GET['password'],FILTER_SANITIZE_STRING);

$query = mysqli_query($link,"SELECT user_id FROM users WHERE user_login='$user1'");
$user_id = mysqli_fetch_assoc($query);
$user_id = $user_id['user_id'];

if($user1!='')
{
    if($_GET['val']!="") {
        $get_user_id = filter_var($_GET['user_id'],FILTER_SANITIZE_STRING);
        $get_val = filter_var($_GET['val'],FILTER_SANITIZE_STRING);
        echo($get_user_id);
        $result = mysqli_query($link,"INSERT INTO `vals`(`user_id`, `val`) VALUES ($user_id,$get_val)");
    }
        
        
    $query1 = mysqli_query($link,"SELECT val, datetime FROM vals WHERE user_id='$user_id'");
    while ($row = $query1->fetch_array(MYSQLI_ASSOC)) {
        foreach ($row as $key=>$value)
            $arr[$key][] = $value;
    }
?>
     

<html>
    <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {  //LineChart
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
    
    </head>
    <body>
        <link rel="stylesheet" type="text/css" href="./styles/user_interface.css">
        
        <div class="left-menu">
            <H1><?=$hello[$cl]?>, <?=$user1?> (id = <?=$user_id?>), <?=$allworks[$cl]?>!</H1>
        </div>
        
        <div class="left-menu2">
            <H1><?=$lastReceivedValue[$cl]?>: <?=$arr['val'][$cnt_all-1];?></H1>
        </div>
        
        <div id="curve_chart" class = "chart"></div>
    </body>
</html>
<?
}     
?>