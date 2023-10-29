<script>
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
        
        if(<?php echo(9-count($arr['val']));?> > 0){
            document.getElementById('sunrise').innerHTML = "Для отображения графика еще нужно значений: "+<?php echo(9-count($arr['val']));?>;
        }
        function drawChart() {  //LineChart
            
            //Данные
            var data = google.visualization.arrayToDataTable([
              ['<?=$title[$cl]?>', '<?=$sensorVal[$cl]?>'],
                <?php 
                    $cnt_all = count($arr['val']); 
                    $x = $cnt_all-10; 
                    while ($x++<$cnt_all-2): 
                ?>
                    ['<?=$arr['datetime'][$x]?>',  <?=$arr['val'][$x]?>],
                <?php endwhile ?>
                    ['<?=$arr['datetime'][$cnt_all-1]?>',  <?=$arr['val'][$cnt_all-1]?>]
            ]);
            

           //Опции графика 
            var options = {
                title: '<?=$sensorVals[$cl]?>',
                pointSize: 7,
                tooltip: {textStyle: {color: 'gray'}, showColorCode: true},
                //curveType: 'function',
                legend: { position: 'bottom' }
            };
    
            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            chart.draw(data, options);
        }
</script>

